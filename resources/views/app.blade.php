<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SCRUM API</title>
    @vite('resources/css/app.css')
</head>
<body>
@extends('auth.dashboard')
@vite('resources/js/app.js')
</body>
</html>
