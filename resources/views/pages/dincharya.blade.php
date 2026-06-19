@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('frontend-assets/dincharyacss.css')}}">
@endpush

@section('content')
    <!-- Header -->
      <section
        class="glass-panel rounded-3xl p-6 flex justify-between items-center"
      >
        <div>
          <h2 class="text-xl font-bold text-saffron-900">Dincharya</h2>
          <p class="text-sm text-gray-500">Daily Discipline & Sankalp</p>
        </div>
        <i class="fa-solid fa-book-open text-saffron-500 text-lg"></i>
      </section>

      <!-- Active Sankalp Card -->
      <section class="glass-panel rounded-3xl p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Active Sankalp</h3>

        <p class="text-gray-600 text-sm mb-3">No distraction after 10 PM</p>

        <div class="flex justify-between text-xs text-gray-400 mb-4">
          <span>Day 5 of 30</span>
          <span>Ends: 12 March 2026</span>
        </div>

        <!-- Progress Bar -->
        <div class="w-full bg-gray-100 rounded-full h-2">
          <div class="bg-saffron-500 h-2 rounded-full" style="width: 20%"></div>
        </div>
      </section>

      <!-- Create Sankalp Button -->
      <button
        onclick="openSankalp()"
        class="bg-saffron-600 text-white py-3 rounded-2xl font-semibold shadow-lg shadow-saffron-200 hover:bg-saffron-700 transition"
      >
        + Create Your Sankalp
      </button>

      <!-- Daily Check-in Section -->
      <section class="glass-panel rounded-3xl p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">Daily Check-in</h3>

        <div class="grid grid-cols-7 gap-3 text-center text-sm">
          <label class="cursor-pointer">
            <input type="checkbox" class="hidden peer" />
            <div
              class="py-3 rounded-xl bg-gray-100 peer-checked:bg-saffron-500 peer-checked:text-white transition"
            >
              1
            </div>
          </label>

          <label class="cursor-pointer">
            <input type="checkbox" class="hidden peer" />
            <div
              class="py-3 rounded-xl bg-gray-100 peer-checked:bg-saffron-500 peer-checked:text-white transition"
            >
              2
            </div>
          </label>

          <!-- continue dynamically -->
        </div>
      </section>

      <!-- Sankalp Analytics -->
      <section class="glass-panel rounded-3xl p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
          Sankalp Analysis
        </h3>

        <div class="flex justify-between text-sm text-gray-600">
          <div>
            <p class="text-gray-400">Completion Rate</p>
            <p class="text-xl font-bold text-saffron-600">80%</p>
          </div>

          <div>
            <p class="text-gray-400">Missed Days</p>
            <p class="text-xl font-bold text-red-500">2</p>
          </div>

          <div>
            <p class="text-gray-400">Consistency</p>
            <p class="text-xl font-bold text-saffron-600">Strong</p>
          </div>
        </div>
      </section>

      <!-- Reminder Time -->
      <section class="glass-panel rounded-3xl p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Daily Reminder</h3>

        <input
          type="time"
          class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-saffron-500 focus:border-saffron-500 outline-none"
        />

        <p class="text-xs text-gray-400 mt-2">
          You will receive check-in notification at selected time.
        </p>
      </section>
@endsection

    <!-- Settings / Reset Modal -->
    <div
      id="settingsModal"
      class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex-col items-center justify-center hidden opacity-0 transition-opacity duration-300"
    >
      <div
        class="bg-white rounded-3xl p-8 w-full max-w-sm mx-4 shadow-2xl transform scale-95 transition-transform duration-300"
        id="settingsContent"
      >
        <div class="flex justify-between items-center mb-6">
          <h3 class="text-xl font-bold text-gray-800">Journey Settings</h3>
          <button
            onclick="closeSettings()"
            class="text-gray-400 hover:text-gray-700"
          >
            <i class="fa-solid fa-xmark text-xl"></i>
          </button>
        </div>

        <div class="space-y-6">
          <div class="pt-6 border-t border-gray-100">

            <a href="{{ route('login') }}"
            class="w-full block text-center bg-white text-red-600 border border-red-200 font-semibold py-3 rounded-xl hover:bg-red-50 transition">
                Login
            </a>
            <a href="{{ route('registration') }}"
            class="w-full block text-center bg-white text-red-600 border border-red-200 font-semibold py-3 rounded-xl hover:bg-red-50 transition mt-3">
                Registration
            </a>

            <p class="text-xs text-gray-400 text-center mt-3">
              Do not be discouraged. A relapse is just a stumble on the path.
            </p>
          </div>
        </div>
      </div>
    </div>

@push('scripts')
<script>
 // --- State Management (In-Memory for session) ---
      let selectedSankalp = "";
      let selectedDays = 0;

// --- API Configuration ---
      const API_BASE_URL = "{{ config('services.central_server.url') }}/api";

      async function syncWithServer() {
        // Generate or get a unique device ID for this browser
        let deviceUuid = localStorage.getItem("device_uuid");
        if (!deviceUuid) {
            deviceUuid = "web-" + Math.random().toString(36).substring(2, 15);
            localStorage.setItem("device_uuid", deviceUuid);
        }

        const sankalpData = JSON.parse(localStorage.getItem("ojas_sankalp") || "{}");
        const todayDate = new Date().toISOString().split('T')[0];

        try {
            const response = await fetch(`${API_BASE_URL}/sync`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    uuid: deviceUuid,
                    date: todayDate,
                    device_info: "Browser testing - " + navigator.platform,
                    sync_data: {
                        active_sankalp: sankalpData,
                        last_sync_time: new Date().toISOString()
                    }
                })
            });
            const data = await response.json();
            console.log("Successfully synced with main server:", data);
        } catch (error) {
            console.error("Sync failed (Server might be unreachable):", error);
        }
      }

        function closeSettings() {
        const modal = document.getElementById("settingsModal");
        const content = document.getElementById("settingsContent");
        modal.style.opacity = "0";
        content.style.transform = "scale(0.95)";
        setTimeout(() => {
          modal.style.display = "none";
        }, 300);
      }

      function switchTab(el, page, e) {
        const items = document.querySelectorAll(".nav-item");

        items.forEach((btn) => {
          btn.classList.remove("text-saffron-600");
          btn.classList.add("text-gray-400");
        });

        el.classList.remove("text-gray-400");
        el.classList.add("text-saffron-600");

        const index = Array.from(items).indexOf(el);

        moveGlow(index);

        triggerRipple(e, el);

        if (navigator.vibrate) navigator.vibrate(30);

        fadePage(page);
      }
      function moveGlow(index) {
        const glow = document.getElementById("navGlow");
        const totalTabs = document.querySelectorAll(".nav-item").length;

        const widthPercent = 100 / totalTabs;
        glow.style.width = widthPercent + "%";
        glow.style.left = widthPercent * index + "%";
      }
      function triggerRipple(event, el) {
        const circle = document.createElement("span");
        circle.classList.add("ripple");

        const rect = el.getBoundingClientRect();
        circle.style.left = `${event.clientX - rect.left}px`;
        circle.style.top = `${event.clientY - rect.top}px`;

        el.appendChild(circle);

        setTimeout(() => circle.remove(), 600);
      }
      function fadePage(page) {
        const main = document.querySelector(".page-content");

        main.classList.add("page-hidden");

        setTimeout(() => {
          // Here you can swap sections in future
          main.classList.remove("page-hidden");
        }, 250);
      }

   window.addEventListener("load", () => {

    const items = document.querySelectorAll(".nav-item");
    const glow = document.getElementById("navGlow");

    let activeIndex = 0;

    items.forEach((item, index) => {
        if (item.classList.contains("text-saffron-600")) {
            activeIndex = index;
        }
    });

    moveGlow(activeIndex);
});

      function openSankalp() {
        const modal = document.getElementById("sankalpModal");
        const content = document.getElementById("sankalpContent");
        modal.style.display = "flex";
        setTimeout(() => {
          modal.style.opacity = "1";
          content.style.transform = "scale(1)";
        }, 10);
      }

      function closeSankalp() {
        const modal = document.getElementById("sankalpModal");
        const content = document.getElementById("sankalpContent");
        modal.style.opacity = "0";
        content.style.transform = "scale(0.95)";
        setTimeout(() => {
          modal.style.display = "none";
        }, 300);
      }

      function selectSankalp(el) {
        document.querySelectorAll(".sankalp-option").forEach((btn) => {
          btn.classList.remove("selected");
        });
        el.classList.add("selected");
        selectedSankalp = el.innerText;
        document.getElementById("customSankalp").value = "";
      }

      function selectDuration(el, days) {
        document.querySelectorAll(".duration-btn").forEach((btn) => {
          btn.classList.remove("active");
        });
        el.classList.add("active");
        selectedDays = days;
      }

      function sealSankalp() {
        const custom = document.getElementById("customSankalp").value;
        const finalSankalp = custom || selectedSankalp;

        if (!finalSankalp || selectedDays === 0) {
          alert("Please select a sankalp and duration.");
          return;
        }

        localStorage.setItem(
          "ojas_sankalp",
          JSON.stringify({
            title: finalSankalp,
            days: selectedDays,
            start: new Date(),
          }),
        );

        // Sync data to the central server
        syncWithServer();

        closeSankalp();
      }
</script>

    <!-- Sankalp Modal -->
    <div
      id="sankalpModal"
      class="fixed inset-0 bg-black/40 backdrop-blur-md z-50 hidden opacity-0 transition-opacity duration-300 flex items-center justify-center px-6"
    >
      <div
        id="sankalpContent"
        class="glass-panel rounded-3xl w-full max-w-md p-8 relative transform scale-95 transition-all duration-300"
      >
        <!-- Close -->
        <button
          onclick="closeSankalp()"
          class="absolute top-4 right-4 text-gray-400 hover:text-saffron-600 transition"
        >
          <i class="fa-solid fa-xmark text-lg"></i>
        </button>

        <!-- Header -->
        <div class="text-center mb-8">
          <div
            class="w-14 h-14 bg-saffron-100 rounded-3xl flex items-center justify-center mx-auto mb-4 text-saffron-600"
          >
            <i class="fa-solid fa-scroll text-lg"></i>
          </div>
          <h2 class="text-xl font-bold text-gray-800">Take a Sankalp</h2>
          <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">
            Intentional Discipline
          </p>
        </div>

        <!-- Predefined Options -->
        <div class="space-y-3 mb-6">
          <button
            onclick="selectSankalp(this)"
            class="sankalp-option w-full text-left px-4 py-3 rounded-2xl glass-panel text-gray-700 hover:border-saffron-500 border border-transparent transition"
          >
            📿 Naam Jap (108 times)
          </button>

          <button
            onclick="selectSankalp(this)"
            class="sankalp-option w-full text-left px-4 py-3 rounded-2xl glass-panel text-gray-700 hover:border-saffron-500 border border-transparent transition"
          >
            🌅 Wake in Brahma Muhurta
          </button>

          <button
            onclick="selectSankalp(this)"
            class="sankalp-option w-full text-left px-4 py-3 rounded-2xl glass-panel text-gray-700 hover:border-saffron-500 border border-transparent transition"
          >
            📵 Digital Fast After 8 PM
          </button>
        </div>

        <!-- Custom Input -->
        <div class="mb-6">
          <input
            type="text"
            id="customSankalp"
            placeholder="Or write your own sankalp..."
            class="w-full border-b border-gray-300 focus:border-saffron-500 outline-none py-2 text-gray-800 bg-transparent"
          />
        </div>

        <!-- Duration -->
        <div class="mb-6">
          <h4 class="text-xs uppercase tracking-widest text-gray-400 mb-3">
            Duration
          </h4>

          <div class="grid grid-cols-4 gap-2">
            <button
              onclick="selectDuration(this, 7)"
              class="duration-btn glass-panel py-2 rounded-xl text-sm"
            >
              7D
            </button>
            <button
              onclick="selectDuration(this, 21)"
              class="duration-btn glass-panel py-2 rounded-xl text-sm"
            >
              21D
            </button>
            <button
              onclick="selectDuration(this, 40)"
              class="duration-btn glass-panel py-2 rounded-xl text-sm"
            >
              40D
            </button>
            <button
              onclick="selectDuration(this, 90)"
              class="duration-btn glass-panel py-2 rounded-xl text-sm"
            >
              90D
            </button>
          </div>
        </div>

        <!-- Seal Button -->
        <button
          onclick="sealSankalp()"
          class="w-full bg-saffron-600 text-white font-semibold py-3 rounded-2xl shadow-lg shadow-saffron-200 hover:bg-saffron-700 transition"
        >
          Seal My Sankalp
        </button>
      </div>
    </div>
@endpush