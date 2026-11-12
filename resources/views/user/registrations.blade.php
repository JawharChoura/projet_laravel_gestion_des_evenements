<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Registrations - Event Planner</title>
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
                                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Profile</a>
                                @if(!auth()->user()->isAdmin())
                                    <a href="/my-registrations" class="block px-4 py-2 text-sm text-purple-600 bg-purple-50 font-medium">My Registrations</a>
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

    
    <div class="container mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold text-purple-600 mb-8">My Registrations</h1>

        @if($registrations->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($registrations as $registration)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                        <div class="relative">
                            @if($registration->event->CJ_image)
                                <img src="{{ url('/image/' . $registration->event->CJ_image) }}" alt="{{ $registration->event->CJ_title }}" 
                                     class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-purple-500 to-pink-500"></div>
                            @endif
                            <span class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                Registered
                            </span>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">{{ $registration->event->CJ_title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($registration->event->CJ_description, 100) }}</p>
                            
                            <div class="text-sm text-gray-500 mb-4 space-y-1">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ $registration->event->CJ_start_date->format('M d, Y - h:i A') }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $registration->event->CJ_place }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <span class="text-purple-600 font-medium">{{ $registration->event->category->CJ_name }}</span>
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <a href="/events/{{ $registration->event->CJ_id }}" class="flex-1 bg-purple-600 text-white text-center py-2 rounded-lg hover:bg-purple-700 transition font-medium text-sm">
                                    View Details
                                </a>
                                <form action="/events/{{ $registration->event->CJ_id }}/unregister" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Are you sure you want to unregister?')" 
                                            class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition font-medium text-sm">
                                        Unregister
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <p class="text-gray-500 text-lg mb-4">You have no registrations yet.</p>
                <a href="/events" class="inline-block bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition">
                    Browse Events
                </a>
            </div>
        @endif
    </div>

    
    <footer class="bg-indigo-950 text-white py-12 mt-16">
        <div class="container mx-auto px-6">
            <div class="text-center mb-8">
                <h3 class="text-3xl font-bold mb-4">Event <span class="text-purple-400">Planner</span></h3>
                <div class="flex justify-center gap-8 mb-6">
                    <a href="/events" class="hover:text-purple-400 transition">Home</a>
                    <a href="/register" class="hover:text-purple-400 transition">Sign up</a>
                    <a href="/login" class="hover:text-purple-400 transition">Sign in</a>
                </div>
            </div>
            <div class="text-center text-sm text-gray-400 border-t border-gray-700 pt-6">
                <p>You Copyright @ 2025 Event Planner</p>
            </div>
        </div>
    </footer>
</body>
</html>