<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehiclePlate;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\IOFactory;

class VehiclePlatesController extends Controller
{
    public function index(Request $request)
    {
        $query = VehiclePlate::query();

        if ($request->has('search') && $request->search !== '') {
            $search = str_replace(' ', '', strtoupper($request->search)); // Normalize: "ABC 1234" → "ABC1234"

            $query->whereRaw("UPPER(CONCAT(letters, numbers)) LIKE ?", ["%{$search}%"]);
        }

        $vehicles = $query->paginate(10); // or whatever pagination you prefer

        return view('vehicles.index', compact('vehicles'));
    }

    public function search(Request $request) {
        $query = VehiclePlate::query();

        $search = str_replace(' ', '', strtoupper($request->search));

        $query->whereRaw("UPPER(CONCAT(letters, numbers)) LIKE ?", ["%{$search}%"]);

        $vehicles = $query->paginate(10);

        return view("welcome", compact("vehicles", "search"));
    }

    public function store(Request $request) {
        $request->validate([
            'plate_number' => ['required', 'regex:/^[A-Z]{3}\s?\d{4}$/'],
        ]);
        // Remove any whitespace just in case
        $plate = str_replace(' ', '', $request->input('plate_number'));

        // Split into letters and numbers
        $letters = substr($plate, 0, 3);   // First 3 are letters
        $numbers = substr($plate, 3);      // Remaining 4 are numbers

        VehiclePlate::create([
            'letters' => $letters,
            'numbers' => $numbers,
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle added successfully!');
    }

    // not used for now - show
    public function show($id) {
        $plate = VehiclePlate::find($id);
    }

    public function edit($id) {
        $vehiclePlate = VehiclePlate::find($id);

        return view('vehicles.edit', ['vehicle'=> $vehiclePlate]);
    }

    public function update(Request $request) {
        $request->validate([
            'plate_number' => ['required', 'regex:/^[A-Z]{3}\s?\d{4}$/'],
        ]);

        // Remove any whitespace just in case
        $plate = str_replace(' ', '', $request->input('plate_number'));

        // Split into letters and numbers
        $letters = substr($plate, 0, 3);   // First 3 are letters
        $numbers = substr($plate, 3);      // Remaining 4 are numbers

        $is_settled = $request->input('is_settled');

        VehiclePlate::find($request->input('plate_id'))->update([
            'numbers'=> $numbers,
            'letters'=> $letters,
            'is_settled' => $is_settled
            ]);

        return redirect()->route('vehicles.index')->with('success','Vehicle plate edited successfully');
    }

    public function destroy($id) {
        VehiclePlate::find($id)->delete();
        return redirect()->route('vehicles.index')->with('success','Record successfully deleted');
    }

    public function upload() {
        return view('vehicles.upload');
    }

    public function bulk_upload(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        $path = $request->file('excel_file')->getRealPath();

        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $imported = 0;
        $skipped_invalid_format = 0;
        $skipped_duplicates = 0;

        foreach ($rows as $row) {
            foreach ($row as $cell) {
                if (!$cell) continue;

                // Normalize plate: trim, remove spaces, uppercase
                $plate = strtoupper(str_replace(' ', '', trim($cell)));

                // Match plate in format: ABC1234
                if (preg_match('/^([A-Z]+)([0-9]+)$/', $plate, $matches)) {
                    $letters = $matches[1];
                    $numbers = $matches[2];

                    // Check if already exists
                    $exists = VehiclePlate::where('letters', $letters)
                        ->where('numbers', $numbers)
                        ->exists();

                    if (!$exists) {
                        VehiclePlate::create([
                            'letters' => $letters,
                            'numbers' => $numbers,
                            'is_settled' => 0,
                        ]);
                        $imported++;
                    } else {
                        $skipped_duplicates++;
                    }
                } else {
                    $skipped_invalid_format++;
                }
            }
        }

        return back()->with('status', "Imported: $imported, Duplicates: $skipped_duplicates, Invalid Format: $skipped_invalid_format");
    }


}
