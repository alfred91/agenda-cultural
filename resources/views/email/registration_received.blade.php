<!DOCTYPE html>
<html>
<head>
    <title>Inscripción recibida</title>
</head>
<body>
    <h1>Inscripción recibida<< /h1>
            <p>Hola {{ $user->name }},</p>
            <p>Gracias por registrarte en el evento: "{{ $event->name }}". Tienes {{ $num_tickets }} tickets.</p>
            <p>Saludos,</p>
            <p>Alfredo - Agenda Cultural</p>
</body>
</html>
