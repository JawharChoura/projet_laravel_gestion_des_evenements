<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Event Planner</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('hidden');
        }
        
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('profileDropdown');
            const button = document.getElementById('profileButton');
            if (dropdown && button && !button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</head>
<body class="bg-gray-50">
    
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold">
                    <a href="/events">Event <span class="text-purple-600">Planner</span></a>
                </div>
                <div class="flex gap-6 items-center">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="/admin/events" class="text-gray-700 hover:text-purple-600 font-medium">Dashboard</a>
                        @endif
                        <div class="relative">
                            <button id="profileButton" onclick="toggleDropdown()" class="flex items-center gap-3 bg-purple-50 hover:bg-purple-100 px-4 py-2 rounded-lg transition">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->CJ_name) }}&background=8b5cf6&color=fff" 
                                     class="w-8 h-8 rounded-full" alt="User">
                                <div class="text-left">
                                    <div class="font-semibold text-gray-800 text-sm">{{ auth()->user()->CJ_name }}</div>
                                    <div class="text-xs text-purple-600">
                                        @if(auth()->user()->isAdmin())
                                            Administrator
                                        @else
                                            User
                                        @endif
                                    </div>
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
                                <a href="/profile" class="block px-4 py-2 text-sm text-purple-600 bg-purple-50 font-medium">My Profile</a>
                                @if(!auth()->user()->isAdmin())
                                    <a href="/my-registrations" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Registrations</a>
                                @endif
                                <form action="/logout" method="POST" class="border-t border-gray-200 mt-2 pt-2">
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
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-6">
        <div class="container mx-auto max-w-4xl">
            
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                
                <div class="h-32 bg-gradient-to-r from-purple-600 to-purple-400"></div>
                
                
                <div class="px-8 pb-8">
                    <div class="flex flex-col sm:flex-row items-center sm:items-end gap-6 -mt-16 mb-8">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->CJ_name) }}&background=8b5cf6&color=fff&size=140" 
                             class="w-40 h-40 rounded-full border-4 border-white shadow-lg" alt="User">
                        <div class="flex-1 text-center sm:text-left pb-2">
                            <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ auth()->user()->CJ_name }}</h1>
                            <p class="text-gray-600 text-lg mb-3">{{ auth()->user()->CJ_email }}</p>
                            <div class="flex flex-wrap justify-center sm:justify-start gap-3">
                                <span class="inline-flex items-center px-4 py-2 rounded-full {{ auth()->user()->isAdmin() ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }} font-semibold text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                    </svg>
                                    @if(auth()->user()->isAdmin())
                                        Administrator
                                    @else
                                        User
                                    @endif
                                </span>
                                <span class="inline-flex items-center px-4 py-2 rounded-full bg-gray-100 text-gray-700 font-medium text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Joined {{ auth()->user()->created_at->format('M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8 pt-8 border-t border-gray-200">
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600 font-medium mb-2">Full Name</p>
                                    <p class="text-xl font-bold text-gray-900">{{ auth()->user()->CJ_name }}</p>
                                </div>
                                <svg class="w-12 h-12 text-purple-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600 font-medium mb-2">Email Address</p>
                                    <p class="text-lg font-bold text-gray-900 truncate">{{ auth()->user()->CJ_email }}</p>
                                </div>
                                <svg class="w-12 h-12 text-blue-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                </svg>
                            </div>
                        </div>

                        @if(!auth()->user()->isAdmin())
                            <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl sm:col-span-2">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium mb-2">Events Registered</p>
                                        <p class="text-3xl font-bold text-green-600">{{ auth()->user()->registrations()->count() }}</p>
                                    </div>
                                    <svg class="w-14 h-14 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
                                    </svg>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            
            @if(!auth()->user()->isAdmin())
                <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v4h8v-4zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                        </svg>
                        My Registrations
                    </h2>
                    <a href="/my-registrations" class="inline-flex items-center justify-center w-full bg-gradient-to-r from-purple-600 to-purple-500 text-white py-4 rounded-xl hover:shadow-lg hover:from-purple-700 hover:to-purple-600 transition duration-300 font-semibold text-lg gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        View My Registrations
                    </a>
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                        </svg>
                        Admin Dashboard
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <a href="/admin/events" class="group relative bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl hover:shadow-lg transition duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600 mb-1">Manage Events</p>
                                    <p class="text-2xl font-bold text-purple-600">📅</p>
                                </div>
                                <svg class="w-5 h-5 text-purple-400 group-hover:translate-x-1 transition" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </a>

                        <a href="/admin/categories" class="group relative bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl hover:shadow-lg transition duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600 mb-1">Manage Categories</p>
                                    <p class="text-2xl font-bold text-blue-600">📂</p>
                                </div>
                                <svg class="w-5 h-5 text-blue-400 group-hover:translate-x-1 transition" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </a>

                        <a href="/admin/registrations" class="group relative bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl hover:shadow-lg transition duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600 mb-1">Registrations</p>
                                    <p class="text-2xl font-bold text-green-600">👥</p>
                                </div>
                                <svg class="w-5 h-5 text-green-400 group-hover:translate-x-1 transition" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    
    <footer class="bg-indigo-950 text-white py-12 mt-16">
        <div class="container mx-auto px-6">
            <div class="text-center mb-8">
                <h3 class="text-3xl font-bold mb-4">Event <span class="text-purple-400">Planner</span></h3>
                <div class="flex justify-center gap-8 mb-6">
                    <a href="/events" class="hover:text-purple-400 transition">Home</a>
                    <a href="/profile" class="hover:text-purple-400 transition">Profile</a>
                    <a href="/events" class="hover:text-purple-400 transition">Events</a>
                </div>
            </div>
            <div class="text-center text-sm text-gray-400 border-t border-gray-700 pt-6">
                <p>You Copyright @ 2025 Event Planner</p>
            </div>
        </div>
    </footer>
</body>
</html>
