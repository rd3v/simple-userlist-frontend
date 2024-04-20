<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Simple User List CRUD</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 15%;
        }
    </style>
</head>
<body>
    <div id="app">
        <h2>Simple User List CRUD</h2>
        <header-component></header-component>
        <router-view></router-view>
        <footer-component></footer-component>
    </div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>