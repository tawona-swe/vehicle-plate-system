<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EnquiryController extends Controller
{
    public function index() {
        return view('users.enquiry');
    }

    public function send(Request $request)
    {
        $request->validate([
            'plate_number' => 'required|regex:/^[A-Z]{3}\s?\d{4}$/i',
            'email' => 'required|email',
            'message' => 'required|string|max:1000',
        ]);

        $data = [
            'plate_number' => strtoupper(str_replace(' ', '', $request->plate_number)),
            'email' => $request->email,
            'message_body' => $request->message,
        ];

        // Send the email to admin
        Mail::send('emails.enquiry', $data, function ($message) use ($data) {
            $message->to('tnrwatida@gmail.com')
                    ->subject('Vehicle Plate Enquiry: ' . $data['plate_number']);
        });

        return back()->with('success', 'Enquiry sent successfully. We will review your request shortly.');
    }
}
