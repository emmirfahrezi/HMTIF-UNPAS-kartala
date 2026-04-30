@props([
    'title' => config('app.name', 'HMTIF UNPAS'),
    'description' => 'Website Resmi HMTIF UNPAS. Teknik Informatika Progresif.',
    'keywords' => 'HMTIF, UNPAS, Kartala, Informatika, Universitas Pasundan, Himpunan Mahasiswa',
    'image' => asset('images/og-image.jpg'), // Default OG Image
    'isSeo' => true, // Matikan ini untuk Dashboard/Error
])

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />

{{-- 1. Browser Hints & Security --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

<meta name="referrer" content="no-referrer-when-downgrade">
<meta name="format-detection" content="telephone=no">

{{-- 2. Indexing Control --}}
@if (!$isSeo)
    <meta name="robots" content="noindex, nofollow, noarchive">
    <meta name="googlebot" content="noindex, nofollow">
@else
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
@endif

{{-- 3. Primary Meta Tags --}}
<title>{{ $title }}</title>
<meta name="title" content="{{ $title }}">
<meta name="description" content="{{ $description }}">
<meta name="author" content="HMTIF UNPAS">

@if ($isSeo)
    <meta name="keywords" content="{{ $keywords }}">

    {{-- 4. Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ $image }}">

    {{-- 5. Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $title }}">
    <meta property="twitter:description" content="{{ $description }}">
    <meta property="twitter:image" content="{{ $image }}">
@endif

{{-- 6. Favicons & Icons --}}
<link rel="icon" type="image/png" href="{{ config('app.logo_url') }}">
<link rel="apple-touch-icon" href="{{ config('app.logo_url') }}">

