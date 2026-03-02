<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Ojas | Brahmacharya Journey')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              saffron: {
                50: "#fff8f1",
                100: "#ffeedb",
                500: "#f97316",
                600: "#ea580c",
                700: "#c2410c",
                900: "#7c2d12",
              },
              sage: {
                50: "#f4f5f4",
                500: "#789b7b",
                900: "#2d3b2e",
              },
            },
            fontFamily: {
              sans: ["Inter", "system-ui", "sans-serif"],
              serif: ["Merriweather", "Georgia", "serif"],
            },
            animation: {
              breathe: "breathe 8s infinite ease-in-out",
            },
            keyframes: {
              breathe: {
                "0%, 100%": { transform: "scale(1)" },
                "50%": { transform: "scale(1.5)" },
              },
            },
          },
        },
      };
    </script>

    @stack('styles')
</head>

<body class="antialiased font-sans min-h-screen flex flex-col items-center pb-20 bg-[#fcfbf9]">

    {{-- Top Header --}}
    @include('partials.header')

    {{-- Page Content --}}
    <main class="page-content w-full max-w-2xl px-4 flex flex-col gap-8 mt-4">
        @yield('content')
    </main>

    {{-- Bottom Navigation --}}
    @include('partials.bottom-nav')

    @stack('scripts')

</body>
</html>