<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        p {
            font-size: 12px;
        }

        .message {
            border: 1px solid #222222;
            padding: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div>
        <p>Hey {{ config('app.name') }},</p>
        <p>A new complaint has been registered through website.</p>
        <div class="message">
            <p><strong>Name:</strong> {{ $name }}</p>
            <p><strong>Phone:</strong> {{ $phone }}</p>
            <p><strong>Complaint Message:</strong> {{ $content }}</p>
        </div>
        <p>
            <span>Thanks,</span><br>
            <strong>{{ config('app.name') }} Website</strong>
        </p>
    </div>
</body>

</html>
