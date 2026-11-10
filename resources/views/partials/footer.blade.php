<footer class="mt-20 bg-indigo-900 text-white">
    <div class="max-w-7xl mx-auto px-6 py-14">
        <!-- TOP -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-12">

            <!-- BRAND -->
            <div>
                <h3 class="text-lg font-semibold tracking-tight">
                    Event <span class="text-purple-400">Planner</span>
                </h3>

                <p class="text-sm text-indigo-200 mt-2 max-w-sm leading-relaxed">
                    Plan, manage and share events easily with a clean and modern experience.
                </p>
            </div>
            <!-- SUBSCRIBE -->
            <div class="w-full md:w-auto">
                <p class="text-sm font-medium text-indigo-200 mb-3">
                    Subscribe to updates
                </p>

                <form class="flex w-full md:w-[360px]">
                    <input type="email" placeholder="Your email" class="w-full h-11 px-4 rounded-l-lg
                                  bg-indigo-800/70 text-white placeholder-indigo-300
                                  border border-indigo-700
                                  focus:ring-2 focus:ring-purple-400 focus:outline-none">

                    <button class="h-11 px-5 rounded-r-lg
                               bg-purple-600 hover:bg-purple-700
                               text-white font-medium transition">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        <!-- BOTTOM -->
        <div class="mt-12 pt-6 border-t border-indigo-700/60
                    flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">

            <!-- LINKS -->
            <div class="flex gap-6 text-sm text-indigo-200">
                <a href="/" class="hover:text-white transition">Home</a>
                <a href="{{ route('register') }}" class="hover:text-white transition">Sign Up</a>
                <a href="{{ route('login') }}" class="hover:text-white transition">Sign In</a>
            </div>

            <!-- COPYRIGHT -->
            <p class="text-xs text-indigo-300">
                © 2026 Event Planner. All rights reserved.
            </p>
        </div>

    </div>
</footer>