<!DOCTYPE html>
<html>
<head>
    <title>Registration Received</title>
</head>
<body>
    <h1>Registration Received</h1>
    <p>Hello {{ $user->name }},</p>
    <p>Thank you for registering for the event "{{ $event->name }}". You have registered for {{ $num_tickets }} tickets.</p>
    <p>Best regards,</p>
    <p>Your Event Organizer</p>
</body>
</html>
