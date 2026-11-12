<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Management - Event Planner</title>
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
                    <a href="/admin/categories" class="text-gray-700 hover:text-purple-600 font-medium">Categories</a>
                    <a href="/admin/events" class="text-purple-600 font-semibold">Events</a>
                    <a href="/admin/registrations" class="text-gray-700 hover:text-purple-600 font-medium">Registrations</a>
                    <div class="relative">
                        <button id="profileButton" onclick="toggleDropdown()" class="flex items-center gap-3 bg-purple-50 hover:bg-purple-100 px-4 py-2 rounded-lg transition">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->CJ_name) }}&background=8b5cf6&color=fff" 
                                 class="w-8 h-8 rounded-full" alt="User">
                            <div class="text-left">
                                <div class="font-semibold text-gray-800 text-sm">{{ auth()->user()->CJ_name }}</div>
                                <div class="text-xs text-purple-600">Administrator</div>
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
                            <a href="/admin/events" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage Events</a>
                            <a href="/admin/categories" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage Categories</a>
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
                </div>
            </div>
        </div>
    </header>


    <div class="container mx-auto px-6 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-purple-600">List of Events</h1>
            <a href="/admin/events/create" class="bg-purple-600 text-white px-8 py-3 rounded-lg hover:bg-purple-700 transition font-semibold">
                Create event
            </a>
        </div>

        @if($events->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Events</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Category</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date start</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date end</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Booking</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Capacity</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Place</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">More actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($events as $event)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($event->CJ_image)
                                            <img src="{{ url('/image/' . $event->CJ_image) }}" alt="{{ $event->CJ_title }}" class="h-12 w-12 object-cover rounded">
                                        @else
                                            <div class="h-12 w-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded"></div>
                                        @endif
                                        <span class="font-medium">{{ $event->CJ_title }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold">
                                        {{ $event->category->CJ_name }}
                                    </span>
                                                                <td class="px-6 py-4 text-sm">
                                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $event->CJ_status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                                        </svg>
                                                                        {{ ucfirst($event->CJ_status) }}
                                                                    </span>
                                                                </td>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <div>{{ $event->CJ_start_date->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $event->CJ_start_date->format('h:i A') }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <div>{{ $event->CJ_end_date->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $event->CJ_end_date->format('h:i A') }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full font-medium">
                                        {{ $event->registrations()->count() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $event->CJ_capacity }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $event->CJ_place }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex gap-2 justify-center items-center">
                                        <a href="/admin/events/{{ $event->CJ_id }}/edit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium text-sm">
                                            Edit
                                        </a>
                                        <form action="/admin/events/{{ $event->CJ_id }}" method="POST" class="inline"
                                              onsubmit="return confirm('Are you sure you want to delete this event?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition font-medium text-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        @else
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <p class="text-gray-500 text-lg">No events found.</p>
                <a href="/admin/events/create" class="inline-block mt-4 bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition">
                    Create your first event
                </a>
            </div>
        @endif
    </div>
</body>
</html>
