<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- FontAwesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        <style>
            #css-splash {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background-color: white;
                z-index: 99999;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                transition: opacity 0.3s ease-out, transform 0.3s ease-out;
            }
            #css-splash.fade-out {
                opacity: 0;
                transform: scale(1.05);
                pointer-events: none;
            }
            .splash-logo {
                width: 100px;
                height: auto;
                margin-bottom: 24px;
                /* Vibrant saffron orange filter from black */
                /* Assuming icon.png has the saffron Om, it will display normally */
            }
            .splash-title {
                color: #000;
                font-family: 'Figtree', sans-serif;
                font-size: 28px;
                font-weight: 700;
                margin: 0;
                letter-spacing: -0.5px;
            }
            .splash-subtitle {
                color: #333;
                font-family: 'Figtree', sans-serif;
                font-size: 16px;
                margin-top: 12px;
                font-weight: 500;
            }
        </style>

        <div id="css-splash">
            <!-- We can use the true icon.png since we converted it earlier -->
            <img src="/icon.png" class="splash-logo" alt="Om Logo">
            <h1 class="splash-title">Sanatan Brahmacharya</h1>
            <p class="splash-subtitle">ब्रह्मचर्य ही जीवन है</p>
        </div>

        @inertia
    </body>
</html>
