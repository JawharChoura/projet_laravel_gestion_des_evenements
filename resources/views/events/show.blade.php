<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->CJ_title }} - Event Planner</title>
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
<body class="bg-white">
    
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
                    @else
                        <a href="/login" class="text-gray-700 hover:text-purple-600 font-medium">Login</a>
                        <a href="/register" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition font-medium">Sign up</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    
    <section class="relative h-96">
        @if($event->CJ_image)
            <img src="{{ url('/image/' . $event->CJ_image) }}" alt="{{ $event->CJ_title }}" 
                 class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gradient-to-br from-purple-600 via-pink-500 to-red-500"></div>
        @endif
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="absolute bottom-8 left-8 text-white">
            <span class="bg-purple-600 px-4 py-2 rounded-full text-sm font-semibold mb-4 inline-block">
                {{ format_price_dt($event->CJ_price) }}
            </span>
            <h1 class="text-5xl font-bold mb-2">{{ $event->CJ_title }}</h1>
            <p class="text-xl">{{ $event->CJ_place }}</p>
        </div>
    </section>

    
    <section class="bg-gradient-to-b from-gray-50 to-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2">
                    
                    <div class="mb-6">
                        <span class="inline-block px-4 py-2 bg-gradient-to-r from-purple-100 to-purple-50 text-purple-700 rounded-full text-sm font-semibold">
                            📁 {{ $event->category->CJ_name }}
                        </span>
                    </div>

                    
                    <div class="mb-12 bg-white rounded-xl shadow-md p-8">
                        <h2 class="text-3xl font-bold mb-6 text-gray-900">About this event</h2>
                        <p class="text-gray-700 leading-relaxed text-lg">{{ $event->CJ_description }}</p>
                    </div>

                    
                    <div class="grid grid-cols-2 gap-4 mb-12">
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <div class="flex items-center gap-4">
                                <div class="bg-blue-100 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Location</p>
                                    <p class="font-bold text-gray-900">{{ $event->CJ_place }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-md p-6">
                            <div class="flex items-center gap-4">
                                <div class="bg-green-100 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Start Time</p>
                                    <p class="font-bold text-gray-900">{{ $event->CJ_start_date->format('M d, Y • h:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Other Events -->
                    <div>
                        <h2 class="text-3xl font-bold mb-8 text-gray-900">Similar events</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($relatedEvents->take(3) as $otherEvent)
                                <a href="/events/{{ $otherEvent->CJ_id }}" class="group">
                                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                                        <div class="relative overflow-hidden h-40">
                                            @if($otherEvent->CJ_image)
                                                <img src="{{ url('/image/' . $otherEvent->CJ_image) }}" 
                                                     alt="{{ $otherEvent->CJ_title }}" 
                                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                            @else
                                                <div class="w-full h-full bg-gradient-to-br from-purple-500 to-pink-500"></div>
                                            @endif
                                            <span class="absolute top-3 left-3 bg-white text-gray-800 px-3 py-1 rounded-full text-xs font-bold">
                                                {{ format_price_dt($otherEvent->CJ_price) }}
                                            </span>
                                        </div>
                                        <div class="p-4">
                                            <h3 class="font-bold text-sm mb-2 text-gray-900 line-clamp-2">{{ $otherEvent->CJ_title }}</h3>
                                            <div class="text-xs text-gray-500 space-y-1">
                                                <p class="flex items-center gap-2">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ $otherEvent->CJ_start_date->format('M d, Y') }}
                                                </p>
                                                <p class="flex items-center gap-2">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ $otherEvent->CJ_place }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Column - Info Box -->
                <div>
                    <div class="bg-gradient-to-br from-purple-600 to-purple-700 rounded-xl shadow-xl p-8 sticky top-6 text-white">
                        <!-- Price -->
                        <div class="mb-8 pb-8 border-b border-purple-400">
                            <p class="text-purple-200 text-sm mb-2">Price</p>
                            <p class="text-4xl font-bold">{{ format_price_dt($event->CJ_price) }}</p>
                        </div>

                        <!-- Hours -->
                        <div class="mb-8 pb-8 border-b border-purple-400">
                            <h3 class="text-lg font-bold mb-4">When</h3>
                            <div class="space-y-3">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-purple-200 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-purple-200 text-sm">Start</p>
                                        <p class="font-semibold">{{ $event->CJ_start_date->format('M d, Y') }}</p>
                                        <p class="text-purple-200 text-sm">{{ $event->CJ_start_date->format('h:i A') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-purple-200 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-purple-200 text-sm">End</p>
                                        <p class="font-semibold">{{ $event->CJ_end_date->format('M d, Y') }}</p>
                                        <p class="text-purple-200 text-sm">{{ $event->CJ_end_date->format('h:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Capacity -->
                        <div class="mb-8 pb-8 border-b border-purple-400">
                            <h3 class="text-lg font-bold mb-2">Availability</h3>
                            <div class="flex items-end gap-2">
                                <p class="text-3xl font-bold">{{ $availableSpots }}</p>
                                <p class="text-purple-200 mb-1">spots available</p>
                            </div>
                            <div class="mt-3 bg-purple-500 rounded-full h-2">
                                <div class="bg-yellow-300 rounded-full h-2" style="width: {{ ($availableSpots / $event->CJ_capacity * 100) }}%"></div>
                            </div>
                        </div>

                        <!-- Book Button -->
                        @auth
                            @if(!$isUserRegistered)
                                @if($availableSpots > 0)
                                    <button onclick="openModal()" class="w-full bg-white text-purple-600 py-3 rounded-lg hover:bg-purple-50 transition font-bold text-lg mb-3">
                                        Book Event
                                    </button>
                                @else
                                    <button disabled class="w-full bg-gray-400 text-white py-3 rounded-lg cursor-not-allowed font-bold text-lg mb-3">
                                        Event Full
                                    </button>
                                @endif
                            @else
                                <div class="text-center mb-3">
                                    <p class="text-yellow-300 font-bold mb-4 flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        You're registered!
                                    </p>
                                    <form action="/events/{{ $event->CJ_id }}/unregister" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full bg-red-500 text-white py-3 rounded-lg hover:bg-red-600 transition font-bold">
                                            Cancel Registration
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @else
                            <a href="/login" class="block w-full bg-white text-purple-600 py-3 rounded-lg hover:bg-purple-50 text-center transition font-bold text-lg">
                                Login to Book
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
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

    <!-- Booking Modal -->
    <div id="bookingModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
            <h2 class="text-2xl font-bold text-center mb-6">Book Event</h2>
            
            <form action="/events/{{ $event->CJ_id }}/register" method="POST">
                @csrf
                <div class="flex gap-4">
                    <button type="button" onclick="closeModal()" class="flex-1 border-2 border-purple-600 text-purple-600 py-3 rounded-lg hover:bg-purple-50 transition font-semibold">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 transition font-semibold">
                        Book now
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('bookingModal').classList.remove('hidden');
            document.getElementById('bookingModal').classList.add('flex');
        }
        
        function closeModal() {
            document.getElementById('bookingModal').classList.add('hidden');
            document.getElementById('bookingModal').classList.remove('flex');
        }

        // Close modal on background click
        document.getElementById('bookingModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</body>
</html>
