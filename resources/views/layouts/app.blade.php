<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Event Planner')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('scripts')
</head>
<body class="bg-gray-50">
    
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold">
                    <a href="{{ route('events.index') }}">Event <span class="text-purple-600">Planner</span></a>
                </div>
                
                <nav class="flex gap-6 items-center">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-purple-600 font-medium">Categories</a>
                            <a href="{{ route('admin.events.index') }}" class="text-gray-700 hover:text-purple-600 font-medium">Events</a>
                            <a href="{{ route('registrations.index') }}" class="text-gray-700 hover:text-purple-600 font-medium">Registrations</a>
                        @else
                            <a href="{{ route('events.index') }}" class="text-gray-700 hover:text-purple-600 font-medium">Événements</a>
                            <a href="{{ route('user.registrations') }}" class="text-gray-700 hover:text-purple-600 font-medium">Mes Inscriptions</a>
                        @endif
                        
                        
                        <div class="relative">
                            <button id="profileButton" onclick="toggleDropdown()" 
                                    class="flex items-center gap-3 bg-purple-50 hover:bg-purple-100 px-4 py-2 rounded-lg transition">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->CJ_name) }}&background=8b5cf6&color=fff" 
                                     class="w-8 h-8 rounded-full" alt="User">
                                <div class="text-left">
                                    <div class="font-semibold text-gray-800 text-sm">{{ auth()->user()->CJ_name }}</div>
                                    <div class="text-xs text-purple-600">{{ auth()->user()->isAdmin() ? 'Administrator' : 'User' }}</div>
                                </div>
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-200">
                                <div class="px-4 py-2 border-b border-gray-200">
                                    <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->CJ_name }}</p>
                                    <p class="text-xs text-gray-500">{{ auth()->user()->CJ_email }}</p>
                                </div>
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Profile</a>
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.events.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage Events</a>
                                    <a href="{{ route('categories.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage Categories</a>
                                @endif
                                <form action="{{ route('logout') }}" method="POST" class="border-t border-gray-200 mt-2 pt-2">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('events.index') }}" class="text-gray-700 hover:text-purple-600 font-medium">Événements</a>
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-purple-600 font-medium">Connexion</a>
                        <a href="{{ route('register') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Inscription</a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    
    @if(session('success'))
        <div class="container mx-auto px-6 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mx-auto px-6 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                {{ session('error') }}
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="container mx-auto px-6 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    
    <main class="@yield('container-class', 'container mx-auto px-6 py-12')">
        @yield('content')
    </main>

    
    @hasSection('footer')
        @yield('footer')
    @else
        <footer class="bg-white border-t mt-12 py-8">
            <div class="container mx-auto px-6 text-center text-gray-600">
                <p>&copy; {{ date('Y') }} Event Planner. Tous droits réservés.</p>
            </div>
        </footer>
    @endif
    
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown?.classList.toggle('hidden');
        }
        
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('profileDropdown');
            const button = document.getElementById('profileButton');
            if (dropdown && button && !button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
    @stack('inline-scripts')
</body>
</html>
