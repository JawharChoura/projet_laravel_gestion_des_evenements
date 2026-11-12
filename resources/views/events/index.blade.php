<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - Event Planner</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hero-bg {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                        url('https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=1200&h=400&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('hidden');
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('profileDropdown');
            const button = document.getElementById('profileButton');
            if (dropdown && button && !button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
        
        function toggleCategoryDropdown() {
            const dropdown = document.getElementById('categoryDropdown');
            dropdown.classList.toggle('hidden');
        }
        
        // Close category dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('categoryDropdown');
            const button = document.getElementById('categoryButton');
            if (dropdown && button && !button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });

        function toggleWeekdayDropdown() {
            const dropdown = document.getElementById('weekdayDropdown');
            dropdown.classList.toggle('hidden');
        }
        
        // Close weekday dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('weekdayDropdown');
            const button = document.getElementById('weekdayButton');
            if (dropdown && button && !button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</head>
<body class="bg-white">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold">
                    Event <span class="text-purple-600">Planner</span>
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

    <!-- Hero Section -->
    <section class="hero-bg text-white py-32">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-6xl font-bold mb-8">MADE FOR THOSE<br>WHO DO</h1>
        </div>
    </section>

    <!-- Upcoming Events Section -->
    <section class="container mx-auto px-6 py-16">
        <h2 class="text-3xl font-bold mb-8">Upcoming <span class="text-purple-600">Events</span></h2>
        
        <!-- Search and Filters -->
        <div class="mb-8 flex flex-col lg:flex-row gap-4">
            <!-- Search Bar -->
            <form method="GET" class="flex-1">
                <div class="relative">
                    <input type="text" name="search" placeholder="Search events..." 
                           value="{{ request('search') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-600 focus:ring-1 focus:ring-purple-600">
                    <svg class="absolute right-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </form>

            <!-- Filters Group -->
            <div class="flex gap-3">
                <!-- Weekday Filter -->
                <div class="relative">
                    <button id="weekdayButton" onclick="toggleWeekdayDropdown()" 
                            class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-2 whitespace-nowrap">
                        <span>{{ request('weekday') ? ['Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday', 'Saturday' => 'Saturday', 'Sunday' => 'Sunday'][request('weekday')] : 'All Days' }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="weekdayDropdown" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-200">
                        <a href="{{ request()->fullUrlWithQuery(['weekday' => null]) }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ !request('weekday') ? 'bg-purple-50 text-purple-600 font-semibold' : '' }}">
                            All Days
                        </a>
                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <a href="{{ request()->fullUrlWithQuery(['weekday' => $day]) }}" 
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('weekday') == $day ? 'bg-purple-50 text-purple-600 font-semibold' : '' }}">
                                {{ $day }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="relative">
                    <button id="categoryButton" onclick="toggleCategoryDropdown()" 
                            class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-2 whitespace-nowrap">
                        <span>{{ request('category') ? $categories->find(request('category'))->CJ_name : 'Any category' }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="categoryDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-200">
                        <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" 
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ !request('category') ? 'bg-purple-50 text-purple-600' : '' }}">
                            All Categories
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ request()->fullUrlWithQuery(['category' => $category->CJ_id]) }}" 
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('category') == $category->CJ_id ? 'bg-purple-50 text-purple-600' : '' }}">
                                {{ $category->CJ_name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Events Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @forelse($events as $event)
                <a href="/events/{{ $event->CJ_id }}" class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition block">
                    <div class="relative">
                        @if($event->CJ_image)
                            <img src="{{ url('/image/' . $event->CJ_image) }}" alt="{{ $event->CJ_title }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-purple-500 to-pink-500"></div>
                        @endif
                        <span class="absolute top-4 left-4 bg-white text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ format_price_dt($event->CJ_price) }}
                        </span>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-xl font-bold flex-1">{{ $event->CJ_title }}</h3>
                            <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold whitespace-nowrap ml-2">
                                {{ $event->category->CJ_name }}
                            </span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($event->CJ_description, 80) }}</p>
                        
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <div>
                                <p class="font-semibold">{{ $event->CJ_start_date->format('M d, Y') }}</p>
                                <p>{{ $event->CJ_start_date->format('h:i A') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">{{ $event->CJ_place }}</p>
                                <p>{{ $event->getAvailableSpots() }} spots left</p>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <p class="col-span-3 text-center text-gray-600">No events available.</p>
            @endforelse
        </div>

        <!-- Load More Button -->
        <div class="text-center">
            <button class="bg-purple-600 text-white px-8 py-3 rounded-lg hover:bg-purple-700 transition font-semibold">
                Load more
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-indigo-950 text-white py-12 mt-16">
        <div class="container mx-auto px-6">
            <div class="text-center mb-8">
                <h3 class="text-3xl font-bold mb-4">Event <span class="text-purple-400">Planner</span></h3>
                <div class="flex justify-center gap-8 mb-6">
                    <a href="/events" class="hover:text-purple-400 transition">Home</a>
                    <a href="#" class="hover:text-purple-400 transition">Sign up</a>
                    <a href="#" class="hover:text-purple-400 transition">Sign in</a>
                </div>
            </div>
            <div class="text-center text-sm text-gray-400 border-t border-gray-700 pt-6">
                <p>You Copyright @ 2025 Event Planner</p>
            </div>
        </div>
    </footer>
</body>
</html>
