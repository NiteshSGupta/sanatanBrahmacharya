<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ojas | Brahmacharya Journey</title>
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
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Merriweather:ital,wght@0,300;0,400;1,300&display=swap");

      body {
        background-color: #fcfbf9;
        color: #1a1a1a;
      }

      .glass-panel {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow:
          0 4px 6px -1px rgba(0, 0, 0, 0.05),
          0 2px 4px -1px rgba(0, 0, 0, 0.03);
      }

      /* Circular Progress */
      .progress-ring__circle {
        transition: stroke-dashoffset 0.35s;
        transform: rotate(-90deg);
        transform-origin: 50% 50%;
      }

      /* Hide scrollbar for clean UI */
      ::-webkit-scrollbar {
        display: none;
      }

      .aura {
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: radial-gradient(
          circle,
          rgba(249, 115, 22, 0.4) 0%,
          rgba(249, 115, 22, 0.15) 40%,
          transparent 70%
        );
        animation: auraSpread 4s infinite ease-out;
        opacity: 0;
      }

      .aura-1 {
        animation-delay: 0s;
      }
      .aura-2 {
        animation-delay: 1.3s;
      }
      .aura-3 {
        animation-delay: 2.6s;
      }

      @keyframes auraSpread {
        0% {
          transform: scale(0.8);
          opacity: 0.6;
        }
        60% {
          opacity: 0.3;
        }
        100% {
          transform: scale(1.8);
          opacity: 0;
        }
      }

      #circleWrapper .aura {
        display: none;
      }

      #circleWrapper.aura-active .aura {
        display: block;
      }
      .particles {
        position: absolute;
        width: 200px;
        height: 200px;
        pointer-events: none;
      }

      .particles span {
        position: absolute;
        width: 6px;
        height: 6px;
        background: rgba(249, 180, 80, 0.6);
        border-radius: 50%;
        animation: floatParticle 12s infinite ease-in-out;
      }

      .particles span:nth-child(1) {
        top: 20%;
        left: 30%;
        animation-delay: 0s;
      }
      .particles span:nth-child(2) {
        top: 70%;
        left: 60%;
        animation-delay: 3s;
      }
      .particles span:nth-child(3) {
        top: 40%;
        left: 80%;
        animation-delay: 6s;
      }
      .particles span:nth-child(4) {
        top: 80%;
        left: 20%;
        animation-delay: 9s;
      }

      @keyframes floatParticle {
        0% {
          transform: translateY(0px);
          opacity: 0.5;
        }
        50% {
          transform: translateY(-15px);
          opacity: 0.9;
        }
        100% {
          transform: translateY(0px);
          opacity: 0.5;
        }
      }

      .om-symbol {
        position: absolute;
        font-size: 140px;
        font-weight: 600;
        color: rgba(249, 115, 22, 0.05);
        animation: rotateOm 40s linear infinite;
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

      .milestone-glow {
        animation: divineGlow 3s ease-out;
      }

      @keyframes divineGlow {
        0% {
          box-shadow: 0 0 0px rgba(249, 115, 22, 0);
        }
        50% {
          box-shadow: 0 0 40px rgba(249, 115, 22, 0.5);
        }
        100% {
          box-shadow: 0 0 0px rgba(249, 115, 22, 0);
        }
      }
      #circleWrapper:not(.aura-active) .particles,
      #circleWrapper:not(.aura-active) .om-symbol {
        opacity: 0.3;
      }

      /* Ripple Effect */
      .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(249, 115, 22, 0.3);
        transform: scale(0);
        animation: ripple-animation 600ms linear;
        pointer-events: none;
      }

      @keyframes ripple-animation {
        to {
          transform: scale(4);
          opacity: 0;
        }
      }

      /* Page Fade */
      .page-content {
        transition: opacity 0.3s ease;
      }

      .page-hidden {
        opacity: 0;
      }
    </style>
  </head>

  <body
    class="antialiased font-sans min-h-screen flex flex-col items-center pb-20"
  >
    <!-- Top Navigation -->
    <nav
      class="w-full max-w-2xl px-6 pt-[env(safe-area-inset-top)] py-4 flex justify-between items-center z-10 sticky top-0 bg-[#fcfbf9]/90 backdrop-blur-md mt-2"
    >
      <div class="flex items-center gap-2">
        <!-- <i class="fa-solid fa-leaf text-saffron-600 text-xl"></i> -->
        <div
          class="w-12 h-12 bg-saffron-100 rounded-3xl flex items-center justify-center text-saffron-600"
        >
          <i class="fa-solid fa-om text-xl"></i>
        </div>
        <h1 class="text-xl font-bold tracking-tight text-saffron-900">
          Brahmacharya
        </h1>
      </div>
      <!-- <button
        class="w-10 h-10 rounded-2xl glass-panel 
        flex items-center justify-center 
        text-saffron-600">
            <i id="themeIcon" class="fa-solid fa-sun text-sm"></i>
        </button>
        <button
        class="w-10 h-10 rounded-2xl glass-panel 
        flex items-center justify-center" style="color:#111827;">
            <i id="themeIcon" class="fa-solid fa-moon text-sm"></i>
        </button> -->
      <button
        onclick="openSettings()"
        class="text-gray-500 hover:text-saffron-700 transition"
      >
        <i class="fa-solid fa-gear text-lg"></i>
      </button>
    </nav>

    <!-- Main Content -->
    <main class="page-content w-full max-w-2xl px-4 flex flex-col gap-8 mt-4">
      <!-- Hero: Streak Counter -->
      <section
        class="glass-panel rounded-3xl p-8 flex flex-col items-center relative overflow-hidden"
      >
        <div
          class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-saffron-400 to-amber-300"
        ></div>

        <h2
          class="text-sm font-medium text-gray-500 uppercase tracking-widest mb-6"
        >
          Current Streak
        </h2>

        <!-- Circular Timer Display -->
        <div
          class="relative w-64 h-64 flex items-center justify-center"
          id="circleWrapper"
        >
          <div class="particles">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
          </div>
          <div class="om-symbol">ॐ</div>
          <div class="aura aura-1"></div>
          <div class="aura aura-2"></div>
          <div class="aura aura-3"></div>

          <svg class="absolute inset-0 w-full h-full" viewBox="0 0 120 120">
            <circle
              class="text-gray-100 stroke-current"
              stroke-width="4"
              cx="60"
              cy="60"
              r="54"
              fill="transparent"
            ></circle>
            <circle
              id="progressRing"
              class="text-saffron-500 stroke-current progress-ring__circle"
              stroke-width="4"
              stroke-linecap="round"
              cx="60"
              cy="60"
              r="54"
              fill="transparent"
              stroke-dasharray="339.292"
              stroke-dashoffset="339.292"
            ></circle>
          </svg>

          <div
            class="text-center z-10 flex flex-col items-center justify-center"
          >
            <div
              class="text-6xl font-bold tracking-tighter text-gray-800"
              id="daysCount"
            >
              0
            </div>
            <div class="text-sm font-medium text-gray-500 mt-1" id="daysText">
              Days
            </div>
          </div>
        </div>

        <!-- Detailed Time -->
        <div
          class="grid grid-cols-3 gap-6 mt-8 w-full max-w-sm text-center"
          id="timer_id"
        >
          <div>
            <div class="text-2xl font-semibold text-gray-700" id="hoursCount">
              00
            </div>
            <div class="text-xs text-gray-400 uppercase tracking-wider">
              Hours
            </div>
          </div>
          <div>
            <div class="text-2xl font-semibold text-gray-700" id="minutesCount">
              00
            </div>
            <div class="text-xs text-gray-400 uppercase tracking-wider">
              Minutes
            </div>
          </div>
          <div>
            <div class="text-2xl font-semibold text-gray-700" id="secondsCount">
              00
            </div>
            <div class="text-xs text-gray-400 uppercase tracking-wider">
              Seconds
            </div>
          </div>
        </div>

        <div class="w-full mt-8 flex justify-center gap-4">
          <button
            onclick="openUrgeSurfer()"
            class="flex-1 bg-red-50 text-red-600 hover:bg-red-100 font-semibold py-3 px-6 rounded-2xl transition flex justify-center items-center gap-2 border border-red-200 shadow-sm"
          >
            <i class="fa-solid fa-fire text-red-500"></i> Emergency
          </button>
          <button
            onclick="openReport()"
            class="flex-1 bg-red-50 text-red-600 hover:bg-red-100 font-semibold py-3 px-6 rounded-2xl transition flex justify-center items-center gap-2 border border-red-200 shadow-sm"
          >
            <i class="fa-regular fa-calendar"></i>
            Report
          </button>
        </div>
        <div class="w-full mt-8 flex justify-center gap-4" id="relapse_id">
          <button
            onclick="resetStreak()"
            class="flex-1 bg-red-50 text-red-600 hover:bg-red-100 font-semibold py-3 px-6 rounded-2xl transition flex justify-center items-center gap-2 border border-red-200 shadow-sm"
          >
            <!-- <i class="fa-solid fa-fire text-red-500"></i> -->
            <i class="fa-solid fa-clock-rotate-left"></i>
            I Relapsed (Reset to Now)
          </button>
        </div>
      </section>

      <!-- Daily Wisdom (Quotes) -->
      <section class="glass-panel rounded-3xl p-8 relative">
        <i
          class="fa-solid fa-quote-left text-3xl text-saffron-200 absolute top-6 left-6"
        ></i>
        <div class="pl-8">
          <p
            id="dailyQuote"
            class="font-serif text-lg text-gray-800 leading-relaxed italic mb-4"
          >
            "The chaste brain has tremendous energy and gigantic willpower.
            Without chastity there can be no spiritual strength."
          </p>
          <p
            id="quoteAuthor"
            class="text-sm font-semibold text-saffron-700 uppercase tracking-wide"
          >
            — Swami Vivekananda
          </p>
        </div>
        <button
          onclick="newQuote()"
          class="absolute bottom-6 right-6 text-gray-400 hover:text-saffron-600 transition"
        >
          <i class="fa-solid fa-rotate-right"></i>
        </button>
      </section>

      <!-- Milestones Timeline -->
      <section class="mb-8">
        <h3
          class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2"
        >
          <i class="fa-solid fa-seedling text-sage-500"></i> Journey of the Seed
        </h3>
        <div
          class="space-y-6 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-saffron-400 before:to-sage-200"
        >
          <!-- Milestone 1 -->
          <div
            class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active"
            id="ms-7"
          >
            <div
              class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-saffron-500 text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10 transition-colors duration-300"
            >
              <i class="fa-solid fa-check text-sm"></i>
            </div>
            <div
              class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] glass-panel p-4 rounded-2xl"
            >
              <div class="flex items-center justify-between mb-1">
                <h4 class="font-bold text-gray-800">
                  Day 7: Testosterone Spike
                </h4>
              </div>
              <p class="text-sm text-gray-600">
                Physical energy increases. Brain fog begins to lift as androgen
                receptors reset.
              </p>
            </div>
          </div>

          <!-- Milestone 2 -->
          <div
            class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group"
            id="ms-30"
          >
            <div
              class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-gray-200 text-gray-400 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10 transition-colors duration-300"
            >
              <i class="fa-solid fa-lock text-sm"></i>
            </div>
            <div
              class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] glass-panel p-4 rounded-2xl opacity-70"
            >
              <div class="flex items-center justify-between mb-1">
                <h4 class="font-bold text-gray-800">Day 30: Mental Clarity</h4>
              </div>
              <p class="text-sm text-gray-600">
                Dopamine baseline stabilizes. Increased confidence, better eye
                contact, and emotional control.
              </p>
            </div>
          </div>

          <!-- Milestone 3 -->
          <div
            class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group"
            id="ms-90"
          >
            <div
              class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-gray-200 text-gray-400 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10 transition-colors duration-300"
            >
              <i class="fa-solid fa-star text-sm"></i>
            </div>
            <div
              class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] glass-panel p-4 rounded-2xl opacity-70"
            >
              <div class="flex items-center justify-between mb-1">
                <h4 class="font-bold text-gray-800">
                  Day 90: Ojas Cultivation
                </h4>
              </div>
              <p class="text-sm text-gray-600">
                The seed transforms into Ojas (vital spiritual energy). Profound
                inner peace, magnetism, and willpower.
              </p>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!-- Urge Surfer Modal (Emergency) -->
    <div
      id="urgeModal"
      class="fixed inset-0 bg-gray-900/95 backdrop-blur-xl z-50 flex-col items-center justify-center hidden opacity-0 transition-opacity duration-300"
    >
      <button
        onclick="closeUrgeSurfer()"
        class="absolute top-6 right-6 text-gray-400 hover:text-white text-2xl"
      >
        <i class="fa-solid fa-xmark"></i>
      </button>

      <div class="text-center px-6 max-w-md mx-auto flex flex-col items-center">
        <h2 class="text-3xl font-bold text-white mb-2 font-serif">
          Ride the Wave
        </h2>
        <p class="text-gray-400 mb-12">
          An urge is just a sensation passing through. Do not fight it; observe
          it. Breathe with the circle.
        </p>

        <!-- Breathing Animation -->
        <div class="relative w-48 h-48 flex items-center justify-center mb-12">
          <div
            class="absolute w-32 h-32 bg-saffron-500/30 rounded-full animate-breathe blur-xl"
          ></div>
          <div
            class="absolute w-24 h-24 bg-saffron-500 rounded-full shadow-[0_0_40px_rgba(249,115,22,0.5)] flex items-center justify-center z-10"
          >
            <span id="breatheText" class="text-white font-medium"
              >Breathe In</span
            >
          </div>
        </div>

        <p class="text-gray-300 italic">
          "You are not your thoughts. You are the consciousness observing them."
        </p>
      </div>
    </div>

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
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2"
              >Set Start Date & Time</label
            >
            <input
              type="datetime-local"
              id="startDateInput"
              class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-saffron-500 focus:border-saffron-500 outline-none"
            />
          </div>

          <button
            onclick="saveSettings()"
            class="w-full bg-saffron-600 text-white font-semibold py-3 rounded-xl hover:bg-saffron-700 transition shadow-lg shadow-saffron-200"
          >
            Save Journey
          </button>

          <div class="pt-6 border-t border-gray-100">
            <button
              onclick="resetStreak()"
              class="w-full bg-white text-red-600 border border-red-200 font-semibold py-3 rounded-xl hover:bg-red-50 transition"
            >
              I Relapsed (Reset to Now)
            </button>
            <p class="text-xs text-gray-400 text-center mt-3">
              Do not be discouraged. A relapse is just a stumble on the path.
            </p>
          </div>
        </div>
      </div>
    </div>

    <script>
      // --- State Management (In-Memory for session) ---
      let journeyStart = null;
      let isJourneyStarted = false;
      let achievedMilestones = new Set();

      // Check if user already started
      const savedStart = localStorage.getItem("ojas_journey_start");

      if (savedStart) {
        journeyStart = new Date(savedStart);
        isJourneyStarted = true;
      }

      const goalDays = 90; // 90 day reboot goal

      const quotes = [
        {
          text: "The chaste brain has tremendous energy and gigantic willpower. Without chastity there can be no spiritual strength.",
          author: "Swami Vivekananda",
        },
        {
          text: "By the establishment of continence, energy is gained.",
          author: "Patanjali, Yoga Sutras",
        },
        {
          text: "He who is regulated in his habits of eating, sleeping, recreation and work can mitigate all material pains by practicing the yoga system.",
          author: "Bhagavad Gita",
        },
        {
          text: "Sensual pleasures are like scratching an itch. It feels good temporarily, but leaves the skin bleeding.",
          author: "Buddhist Proverb",
        },
        {
          text: "Through the practice of Brahmacharya, one attains longevity, physical and mental health, and the highest knowledge.",
          author: "Ayurvedic Wisdom",
        },
        {
          text: "Do not say, 'It is too hard.' You are the master of your senses, not their slave.",
          author: "Sivananda",
        },
        {
          text: "Celibacy is the first step to the realization of the Divine.",
          author: "Mahatma Gandhi",
        },
      ];

      // --- Core Logic: Timer & UI ---
      function activateStartMode() {
        const circle = document.getElementById("progressRing");
        const daysEl = document.getElementById("daysCount");
        const daysText = document.getElementById("daysText");
        const relapseId = document.getElementById("relapse_id");
        const timerId = document.getElementById("timer_id");

        const detailGrid = document.querySelector(".grid.grid-cols-3");
        const wrapper = document.getElementById("circleWrapper");
        wrapper.classList.add("aura-active");

        const radius = circle.r.baseVal.value;
        const circumference = radius * 2 * Math.PI;

        circle.style.strokeDasharray = `${circumference}`;
        circle.style.strokeDashoffset = 0; // FULL circle
        circle.classList.add("animate-pulse");
        circle.style.cursor = "pointer";

        daysEl.innerText = "Get back Control of your Life";
        daysText.classList.add("hidden");
        relapseId.classList.add("hidden");
        timerId.classList.add("hidden");
        daysEl.classList.remove("text-6xl");
        // daysText.remove("hidden");
        daysEl.classList.add(
          "text-2xl",
          "leading-snug",
          "px-6", // horizontal padding
          "text-center",
          "max-w-[180px]", // prevent touching circle edge
        );

        daysEl.classList.add("text-saffron-600");

        detailGrid.style.opacity = "0";
        detailGrid.style.pointerEvents = "none";

        document.querySelector(".relative.w-64").onclick = startJourney;
      }
      function startJourney() {
        journeyStart = new Date();
        playSacredTone();
        localStorage.setItem("ojas_journey_start", journeyStart);

        const daysEl = document.getElementById("daysCount");

        daysEl.classList.remove(
          "text-2xl",
          "leading-snug",
          "px-6",
          "max-w-[180px]",
        );

        daysEl.classList.add("text-6xl");
        isJourneyStarted = true;
        const daysText = document.getElementById("daysText");
        const relapseId = document.getElementById("relapse_id");
        const timerId = document.getElementById("timer_id");
        document
          .getElementById("progressRing")
          .classList.remove("animate-pulse");
        document
          .getElementById("daysCount")
          .classList.remove("text-saffron-600");
        document
          .getElementById("circleWrapper")
          .classList.remove("aura-active");

        document.querySelector(".grid.grid-cols-3").style.opacity = "1";

        daysText.classList.remove("hidden");
        relapseId.classList.remove("hidden");
        timerId.classList.remove("hidden");

        updateTimer();
      }
      function playSacredTone() {
        const audioCtx = new (
          window.AudioContext || window.webkitAudioContext
        )();
        const oscillator = audioCtx.createOscillator();
        const gainNode = audioCtx.createGain();

        oscillator.type = "sine";
        oscillator.frequency.setValueAtTime(432, audioCtx.currentTime); // 432Hz calm frequency

        gainNode.gain.setValueAtTime(0.001, audioCtx.currentTime);
        gainNode.gain.exponentialRampToValueAtTime(
          0.05,
          audioCtx.currentTime + 0.1,
        );
        gainNode.gain.exponentialRampToValueAtTime(
          0.001,
          audioCtx.currentTime + 0.6,
        );

        oscillator.connect(gainNode);
        gainNode.connect(audioCtx.destination);

        oscillator.start();
        oscillator.stop(audioCtx.currentTime + 0.6);
      }
      function updateTimer() {
        if (!isJourneyStarted) {
          activateStartMode();
          return;
        }

        const now = new Date();
        const diff = now - journeyStart;

        if (diff < 0) return; // Future date edge case

        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
        const minutes = Math.floor((diff / 1000 / 60) % 60);
        const seconds = Math.floor((diff / 1000) % 60);

        document.getElementById("daysCount").innerText = days;
        document.getElementById("hoursCount").innerText = hours
          .toString()
          .padStart(2, "0");
        document.getElementById("minutesCount").innerText = minutes
          .toString()
          .padStart(2, "0");
        document.getElementById("secondsCount").innerText = seconds
          .toString()
          .padStart(2, "0");

        updateProgressRing(days);
        updateMilestones(days);
      }

      function updateProgressRing(days) {
        const circle = document.getElementById("progressRing");
        const radius = circle.r.baseVal.value;
        const circumference = radius * 2 * Math.PI;

        circle.style.strokeDasharray = `${circumference} ${circumference}`;

        // Calculate percentage based on 90-day goal
        const percent = Math.min((days / goalDays) * 100, 100);
        const offset = circumference - (percent / 100) * circumference;
        circle.style.strokeDashoffset = offset;
      }


      function updateMilestones(days) {
        const milestones = [
          { id: "ms-7", req: 7 },
          { id: "ms-30", req: 30 },
          { id: "ms-90", req: 90 },
        ];

        milestones.forEach((ms) => {
          const el = document.getElementById(ms.id);
          const iconContainer = el.querySelector("div:first-child");
          const icon = iconContainer.querySelector("i");
          const content = el.querySelector("div:nth-child(2)");

          if (days >= ms.req) {
            // 🔥 Trigger glow ONLY first time
            if (!achievedMilestones.has(ms.req)) {
              achievedMilestones.add(ms.req);

              const wrapper = document.getElementById("circleWrapper");
              wrapper.classList.add("milestone-glow");

              setTimeout(() => {
                wrapper.classList.remove("milestone-glow");
              }, 3000);
            }

            iconContainer.classList.remove("bg-gray-200", "text-gray-400");
            iconContainer.classList.add("bg-saffron-500", "text-white");
            icon.className = "fa-solid fa-check text-sm";
            content.classList.remove("opacity-70");
          } else {
            iconContainer.classList.add("bg-gray-200", "text-gray-400");
            iconContainer.classList.remove("bg-saffron-500", "text-white");

            if (ms.req === 30) icon.className = "fa-solid fa-lock text-sm";
            if (ms.req === 90) icon.className = "fa-solid fa-star text-sm";
            content.classList.add("opacity-70");
          }
        });
      }

      function newQuote() {
        const quoteEl = document.getElementById("dailyQuote");
        const authorEl = document.getElementById("quoteAuthor");

        // Fade out
        quoteEl.style.opacity = 0;
        authorEl.style.opacity = 0;

        setTimeout(() => {
          const random = quotes[Math.floor(Math.random() * quotes.length)];
          quoteEl.innerText = `"${random.text}"`;
          authorEl.innerText = `— ${random.author}`;
          // Fade in
          quoteEl.style.transition = "opacity 0.5s ease";
          authorEl.style.transition = "opacity 0.5s ease";
          quoteEl.style.opacity = 1;
          authorEl.style.opacity = 1;
        }, 300);
      }

      // --- Modals & Interactions ---
      let breatheInterval;

      function openUrgeSurfer() {
        const modal = document.getElementById("urgeModal");
        modal.style.display = "flex";
        // Slight delay for fade transition
        setTimeout(() => {
          modal.style.opacity = "1";
        }, 10);

        const breatheText = document.getElementById("breatheText");
        let cycle = 0;

        breatheInterval = setInterval(() => {
          cycle = (cycle + 1) % 2;
          if (cycle === 0) {
            breatheText.innerText = "Breathe In";
          } else {
            breatheText.innerText = "Breathe Out";
          }
        }, 4000); // 4 seconds in, 4 seconds out
      }

      function monthlyReport() {
        const modal = document.getElementById("urgeModal");
        modal.style.display = "flex";
        // Slight delay for fade transition
        setTimeout(() => {
          modal.style.opacity = "1";
        }, 10);

        const breatheText = document.getElementById("breatheText");
        let cycle = 0;

        breatheInterval = setInterval(() => {
          cycle = (cycle + 1) % 2;
          if (cycle === 0) {
            breatheText.innerText = "Breathe In";
          } else {
            breatheText.innerText = "Breathe Out";
          }
        }, 4000); // 4 seconds in, 4 seconds out
      }

      function openReport() {
        const modal = document.getElementById("reportModal");
        modal.style.display = "flex";
        setTimeout(() => {
          modal.style.opacity = "1";
        }, 10);
      }

      function closeReport() {
        const modal = document.getElementById("reportModal");
        modal.style.opacity = "0";
        setTimeout(() => {
          modal.style.display = "none";
        }, 300);
      }

      function showRelapseDetail(date, time) {
        alert(`Relapse Date: ${date}\nTime: ${time}`);
      }

      function closeUrgeSurfer() {
        const modal = document.getElementById("urgeModal");
        modal.style.opacity = "0";
        clearInterval(breatheInterval);
        setTimeout(() => {
          modal.style.display = "none";
        }, 300);
      }

      function openSettings() {
        const modal = document.getElementById("settingsModal");
        const content = document.getElementById("settingsContent");
        const input = document.getElementById("startDateInput");

        // Format current journey start for datetime-local input
        const tzoffset = new Date().getTimezoneOffset() * 60000;
        const localISOTime = new Date(journeyStart - tzoffset)
          .toISOString()
          .slice(0, 16);
        input.value = localISOTime;

        modal.style.display = "flex";
        setTimeout(() => {
          modal.style.opacity = "1";
          content.style.transform = "scale(1)";
        }, 10);
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

      function saveSettings() {
        const inputVal = document.getElementById("startDateInput").value;
        if (inputVal) {
          journeyStart = new Date(inputVal);
          updateTimer();
          closeSettings();
        }
      }

      function resetStreak() {
        journeyStart = new Date();
        achievedMilestones.clear(); // 🔥 important
        localStorage.setItem("ojas_journey_start", journeyStart);
        updateTimer();
        closeSettings();
      }
      // --- Initialization ---
      setInterval(updateTimer, 1000);
      updateTimer();
      newQuote(); // Init random quote

      // Add smooth transitions for quote fading
      document.getElementById("dailyQuote").style.transition =
        "opacity 0.5s ease";
      document.getElementById("quoteAuthor").style.transition =
        "opacity 0.5s ease";
      function setActiveTab(el) {
        const buttons = el.parentElement.querySelectorAll("button");

        buttons.forEach((btn) => {
          btn.classList.remove("text-saffron-600");
          btn.classList.add("text-gray-400");
        });

        el.classList.remove("text-gray-400");
        el.classList.add("text-saffron-600");
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
        const firstTab = document.querySelector(".nav-item");
        moveGlow(0);
      });
    </script>
    <!-- Report Modal -->
    <div
      id="reportModal"
      class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex-col items-center justify-center hidden opacity-0 transition-opacity duration-300"
    >
      <div
        class="bg-white rounded-3xl p-8 w-full max-w-md mx-4 shadow-2xl relative"
      >
        <button
          onclick="closeReport()"
          class="absolute top-4 right-4 text-gray-400 hover:text-gray-700"
        >
          <i class="fa-solid fa-xmark text-xl"></i>
        </button>

        <h3 class="text-xl font-bold text-gray-800 mb-6 text-center">
          Monthly Report
        </h3>

        <!-- Calendar Grid -->
        <div class="grid grid-cols-7 gap-3 text-center text-sm">
          <!-- GREEN Day -->
          <div
            class="py-2 rounded-xl bg-green-100 text-green-700 font-semibold cursor-pointer"
          >
            1
          </div>

          <!-- GREEN Day -->
          <div
            class="py-2 rounded-xl bg-green-100 text-green-700 font-semibold cursor-pointer"
          >
            2
          </div>

          <!-- RED Relapse Day -->
          <div
            onclick="showRelapseDetail('3 June 2026', '10:42 PM')"
            class="py-2 rounded-xl bg-red-100 text-red-600 font-semibold cursor-pointer hover:bg-red-200 transition"
          >
            3
          </div>

          <!-- GREEN -->
          <div
            class="py-2 rounded-xl bg-green-100 text-green-700 font-semibold"
          >
            4
          </div>

          <!-- RED -->
          <div
            onclick="showRelapseDetail('5 June 2026', '01:18 AM')"
            class="py-2 rounded-xl bg-red-100 text-red-600 font-semibold cursor-pointer hover:bg-red-200 transition"
          >
            5
          </div>

          <!-- Fill rest as needed -->
        </div>

        <p class="text-xs text-gray-400 text-center mt-6">
          Green = Discipline. Red = Relapse.
        </p>
      </div>
    </div>
    <!-- Bottom Navigation -->
    <!-- Bottom Navigation -->
    <div class="fixed bottom-0 left-0 w-full z-40">
      <div class="max-w-2xl mx-auto px-4 pb-[env(safe-area-inset-bottom)]">
        <div
          id="bottomNav"
          class="glass-panel rounded-3xl mb-4 px-6 py-3 flex justify-around items-center shadow-xl border border-white/40 relative overflow-hidden"
        >
          <!-- Glow Indicator -->
          <div
            id="navGlow"
            class="absolute bottom-0 h-1 bg-saffron-500 rounded-full transition-all duration-300 ease-out"
          ></div>

          <!-- Home -->
        <a href="{{ route('home') }}"
   class="nav-item flex flex-col items-center {{ request()->routeIs('home') ? 'text-saffron-600' : 'text-gray-400' }}">
   <i class="fa-solid fa-house text-lg mb-1"></i>
   <span class="text-xs">Home</span>
</a>

          <!-- Dincharya -->
         <a href="{{ route('dincharya') }}"
   class="nav-item flex flex-col items-center {{ request()->routeIs('dincharya') ? 'text-saffron-600' : 'text-gray-400' }}">
   <i class="fa-solid fa-book-open text-lg mb-1"></i>
   <span class="text-xs">Dincharya</span>
</a>
        </div>
      </div>
    </div>
  </body>
</html>
