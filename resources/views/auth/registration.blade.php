<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | Ojas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      rel="stylesheet"
    />

    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              saffron: {
                100: "#ffeedb",
                500: "#f97316",
                600: "#ea580c",
                900: "#7c2d12",
              },
            },
          },
        },
      };
    </script>

    <style>
      body {
        background-color: #fcfbf9;
      }

      .glass-panel {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow:
          0 4px 6px -1px rgba(0, 0, 0, 0.05),
          0 2px 4px -1px rgba(0, 0, 0, 0.03);
      }

      .om-symbol {
        position: absolute;
        font-size: 220px;
        color: rgba(249, 115, 22, 0.05);
        animation: rotateOm 50s linear infinite;
        pointer-events: none;
      }

      @keyframes rotateOm {
        from {
          transform: rotate(0deg);
        }
        to {
          transform: rotate(360deg);
        }
      }

      .hide-scrollbar::-webkit-scrollbar {
        display: none;
      }
      .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
      }
    </style>
  </head>

  <body class="min-h-screen flex items-center justify-center px-6 relative">
    <!-- Background OM -->
    <div class="om-symbol">ॐ</div>

    <!-- Card -->
    <div class="glass-panel w-full max-w-md rounded-3xl p-10 relative z-10">
      <!-- Header -->
      <div class="text-center mb-8">
        <div
          class="w-14 h-14 bg-saffron-100 rounded-3xl flex items-center justify-center mx-auto text-saffron-600 mb-4"
        >
          <i class="fa-solid fa-seedling text-xl"></i>
        </div>
        <h1 class="text-2xl font-bold text-saffron-900 tracking-tight">
          Begin Your Journey
        </h1>
        <p class="text-gray-500 text-sm mt-2">
          Create your sacred discipline account
        </p>
      </div>

      <!-- Form -->
      <form class="space-y-6">
        <!-- Name -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2"
            >Name</label
          >
          <div class="relative">
            <i
              class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"
            ></i>
            <input
              type="text"
              placeholder="Enter your full name"
              class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-saffron-500 focus:border-saffron-500 outline-none transition"
            />
          </div>
        </div>

        <!-- Username -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2"
            >Username</label
          >
          <div class="relative">
            <i
              class="fa-solid fa-at absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"
            ></i>
            <input
              type="text"
              placeholder="Choose a username"
              class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-saffron-500 focus:border-saffron-500 outline-none transition"
            />
          </div>
        </div>

        <!-- Gender -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-3"
            >Gender</label
          >

          <div class="flex gap-3">
            <label class="flex-1 cursor-pointer">
              <input
                type="radio"
                name="gender"
                value="male"
                class="hidden peer"
              />
              <div
                class="py-3 flex items-center justify-center gap-2 rounded-xl border border-gray-200 peer-checked:bg-saffron-600 peer-checked:text-white peer-checked:border-saffron-600 transition"
              >
                <i class="fa-solid fa-mars text-lg"></i> Male
              </div>
            </label>

            <label class="flex-1 cursor-pointer">
              <input
                type="radio"
                name="gender"
                value="female"
                class="hidden peer"
              />
              <div
                class="py-3 flex items-center justify-center gap-2 rounded-xl border border-gray-200 peer-checked:bg-saffron-600 peer-checked:text-white peer-checked:border-saffron-600 transition"
              >
                <i class="fa-solid fa-venus text-lg"></i> Female
              </div>
            </label>
          </div>
        </div>

        <!-- Age -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2"
            >Age</label
          >
          <div class="relative w-full rounded-2xl border border-gray-100 bg-white/50 px-1">
            <!-- Fade overlays for sides -->
            <div class="absolute left-0 top-0 bottom-0 w-6 bg-gradient-to-r from-white to-transparent pointer-events-none rounded-l-2xl z-10"></div>
            <div class="absolute right-0 top-0 bottom-0 w-6 bg-gradient-to-l from-white to-transparent pointer-events-none rounded-r-2xl z-10"></div>
            
            <div class="flex overflow-x-auto hide-scrollbar py-4 px-4 gap-3 snap-x snap-mandatory relative z-0">
              @for($i = 16; $i <= 40; $i++)
              <label class="relative flex-none cursor-pointer snap-center group">
                <input type="radio" name="age" value="{{ $i }}" class="hidden peer" {{ $i == 20 ? 'checked' : '' }} />
                <div class="w-14 h-14 flex items-center justify-center text-xl text-gray-500 font-medium rounded-2xl peer-checked:bg-saffron-600 peer-checked:text-white peer-checked:shadow-lg peer-checked:shadow-saffron-200 transition-all duration-300">
                  {{ $i }}
                </div>
                <!-- Indicators -->
                <div class="absolute -bottom-3 left-0 w-full flex justify-center items-center h-4">
                  <div class="w-1 h-1 rounded-full bg-gray-300 peer-checked:hidden transition-all duration-300"></div>
                  <div class="hidden peer-checked:block w-0 h-0 border-l-[6px] border-l-transparent border-r-[6px] border-r-transparent border-b-[8px] border-b-saffron-600"></div>
                </div>
              </label>
              @endfor
            </div>
          </div>
        </div>

        <!-- Password -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2"
            >Password</label
          >
          <div class="relative">
            <i
              class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"
            ></i>
            <input
              type="password"
              placeholder="Create a password"
              class="w-full pl-10 pr-10 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-saffron-500 focus:border-saffron-500 outline-none transition"
            />
            <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
              <i class="fa-solid fa-eye-slash text-sm"></i>
            </button>
          </div>
        </div>

        <!-- Confirm Password -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2"
            >Confirm Password</label
          >
          <div class="relative">
            <i
              class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"
            ></i>
            <input
              type="password"
              placeholder="Confirm your password"
              class="w-full pl-10 pr-10 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-saffron-500 focus:border-saffron-500 outline-none transition"
            />
            <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
              <i class="fa-solid fa-eye-slash text-sm"></i>
            </button>
          </div>
        </div>

        <!-- Button -->
        <button
          type="submit"
          class="w-full bg-saffron-600 text-white font-semibold py-3 rounded-xl hover:bg-saffron-700 transition shadow-lg shadow-saffron-200 mt-2"
        >
          Register
        </button>

        <!-- Login Link -->
        <div class="text-center mt-6">
          <p class="text-gray-500 text-sm">
            Already have an account? <a href="{{ route('login') ?? '#' }}" class="text-saffron-600 font-semibold hover:underline">Log in</a>
          </p>
        </div>
      </form>

      <!-- Footer -->
      <p class="text-xs text-gray-400 text-center mt-8">
        Power is built through daily discipline.
      </p>
    </div>
  </body>
</html>
