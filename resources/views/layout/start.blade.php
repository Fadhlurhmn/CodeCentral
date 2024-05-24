<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
  
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
  <!-- Styles -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
  <!-- Alpine -->
  <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
  <script nomodule src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>
  <!-- AOS -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  {{-- image --}}
  <link rel="shortcut icon" href="{{ asset('img/fav.png') }}" type="image/x-icon">  
  {{-- Font Awesome --}}
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
  @vite('resources/css/app.sass')

  {{-- replace Admin for $title to change the title each page --}}
  <title>SIRW | Admin</title>
</head>
<body class="bg-gray-100">