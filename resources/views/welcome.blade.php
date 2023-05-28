<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

  @vite('resources/admin/sass/main.scss')
</head>

<body>
  <h1 class="text-3xl font-bold text-red-500">
    Hello world!
  </h1>
  {{-- <script src="{{ Vite::asset('resources/admin/js/main.js') }}"></script> --}}
  @vite('resources/admin/js/main.js')
</body>

</html>
