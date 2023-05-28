<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- <title>{{ $general->siteName($pageTitle ?? '') }}</title> --}}
  <title>{{ $pageTitle ?? 'Admin Panel' }} | @lang($general->sitename ?? 'Simple CMS Laravel')</title>

  <link rel="shortcut icon" type="image/png" href="{{ Vite::asset('resources/images/favicon.png') }}">

   @stack('style-lib')

  @vite('resources/admin/sass/main.scss')

  @stack('style')
</head>

<body>
  @yield('content')

  @stack('script-lib')

  <script>
    const BASE_URL = '{{ url('/') }}/';
  </script>

  @vite('resources/admin/js/main.js')

  @stack('script')
</body>

</html>
