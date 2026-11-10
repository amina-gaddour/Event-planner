<nav class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">

        <!-- LOGO -->
        <a href="{{ route('home') }}" class="text-xl font-bold">
            Event <span class="text-purple-600">Planner</span>
        </a>

        <!-- LINKS -->
        <div class="flex items-center gap-6 text-sm">

            <a href="{{ route('home') }}" class="hover:text-purple-600">Home</a>

            @auth
                {{-- ================= ADMIN ================= --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.events.index') }}" class="hover:text-purple-600">
                        Events
                    </a>

                    <a href="{{ route('admin.categories.index') }}" class="hover:text-purple-600">
                        Categories
                    </a>

                    <a href="{{ route('admin.registrations.index') }}" class="hover:text-purple-600">
                        Registrations
                    </a>
                @endif

                {{-- ================= USER ================= --}}
                @if(auth()->user()->role === 'user')
                    <a href="{{ route('events.my-events') }}" class="hover:text-purple-600">
                        My events
                    </a>
                @endif

                {{-- USER INFO + LOGOUT --}}
                <div class="relative flex items-center gap-4">

                    <!-- PROFILE -->
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 hover:bg-gray-100 px-3 py-2 rounded-lg transition">

                        <div class="leading-tight">
                            <div class="text-sm font-semibold text-gray-800">
                                {{ auth()->user()->name }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ auth()->user()->email }}
                            </div>
                        </div>
                    </a>

                    <!-- LOGOUT -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-500 hover:text-red-600 transition font-medium">
                            Logout
                        </button>
                    </form>
                </div>

            @else
                {{-- GUEST --}}
                <a href="{{ route('login') }}" class="hover:text-purple-600">Login</a>
                <a href="{{ route('register') }}" class="bg-purple-600 text-white px-4 py-1.5 rounded">
                    Signup
                </a>
            @endauth

        </div>
    </div>
</nav>