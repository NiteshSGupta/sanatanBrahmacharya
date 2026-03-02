<div class="fixed bottom-0 left-0 w-full z-40 bg-[#fcfbf9]/90 backdrop-blur-md border-t border-white/40">
    <div class="max-w-2xl mx-auto px-4 pb-[env(safe-area-inset-bottom)]">
        <div id="bottomNav"
            class="glass-panel rounded-3xl mb-4 px-6 py-3 flex justify-around items-center shadow-xl border border-white/40 relative overflow-hidden">
            <!-- Glow Indicator -->
            <div id="navGlow"
                class="absolute bottom-0 h-1 bg-saffron-500 rounded-full transition-all duration-300 ease-out"></div>

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
