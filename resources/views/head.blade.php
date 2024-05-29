<!DOCTYPE html>

@use('Illuminate\Support\Facades\Auth')

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Auth::check() && Auth::user()->is_admin ? 'Pengelolaan Tan Aquatic' : 'Tan Aquatic | Ikan Hias, Perlengkapan Akuarium, Aquascape' }}</title>
    <meta name="keywords" content="tan aquatic jual beli ikan hias tanjung enim palembang sumatra">
    <meta name="description" content="Tan Aquatic adalah toko ikan hias air tawar yang dimiliki oleh Muhammad Ferdiansyah Tandianus, seorang pemuda asli Tanjung Enim. Selain ikan hias air tawar, Tan Aquatic juga menjual perlengkapan aquarium dan aquascape.">
@if(str_contains($_SERVER["REQUEST_URI"], 'admin'))
    <meta name="robots" content="noindex">
@endif
@stack('head_scripts')
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    @vite(["resources/css/app.css", 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="/fontawesome/css/fontawesome.min.css"/>
    <link rel="stylesheet" href="/fontawesome/css/solid.min.css"/>
    <link rel="stylesheet" href="/fontawesome/css/brands.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
    <style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
    </style>
    @stack('head-styles')

</head>
