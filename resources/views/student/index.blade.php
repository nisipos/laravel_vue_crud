<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-dark bg-dark mb-3">
            <a href="#" class="navbar-brand">Navbar</a>
        </nav>
        <div class="container">
            <student-component :student="{{ $student }}" />
        </div>
    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</html>
