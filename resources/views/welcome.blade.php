<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Simple CMS</title>

  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" /> --}}
  @vite('resources/admin/sass/main.scss')
</head>

<body>
  @include('layout')
  {{-- <script src="{{ Vite::asset('resources/admin/js/main.js') }}"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
  @vite('resources/admin/js/main.js')
</body>

</html>
