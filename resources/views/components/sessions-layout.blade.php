<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @vite('resources/css/app.css')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
        {{-- firago --}}
        <link href="https://free.bboxtype.com/embedfonts/?family=FiraGO:400,500,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="/index.css">
        
        <title>Laravel</title>

    </head>
    @php
        $font = app()->getLocale() == 'en' ? 'font-inter' : 'font-firago'
    @endphp
    <body {{ $attributes->merge(['class' => 'antialiased '.$font]) }}>
        {{ $slot }}
    </body>
</html>
