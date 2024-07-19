<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error 400</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Error 400: Bad Request</h1>
        <p>{{ $exception->getMessage() }}</p>
        <a href="{{ url()->previous() }}">Go Back</a>
    </div>
</body>
</html>
