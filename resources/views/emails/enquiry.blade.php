<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vehicle Plate Enquiry</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px; color: #212529;">
    <div style="max-width: 600px; margin: auto; background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h2 style="color: #0d6efd;">🚗 Vehicle Plate Enquiry</h2>

        <p><strong>Plate Number:</strong> <span style="color: #000;">{{ $plate_number }}</span></p>
        <p><strong>Sender Email:</strong> <a href="mailto:{{ $email }}">{{ $email }}</a></p>

        <hr style="margin: 20px 0;">

        <p><strong>Message:</strong></p>
        <p style="background: #f1f1f1; padding: 15px; border-radius: 4px;">
            {{ $message_body }}
        </p>

        <hr style="margin: 30px 0;">

        <p style="font-size: 0.9em; color: #6c757d;">This message was sent from the Vehicle Offender System platform.</p>
    </div>
</body>
</html>
