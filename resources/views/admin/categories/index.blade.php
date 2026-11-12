<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - Event Planner</title>
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
        
        function openModal() {
            document.getElementById('categoryModal').classList.remove('hidden');
        }
        
        function closeModal() {
            document.getElementById('categoryModal').classList.add('hidden');
        }
    </script>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold">
                    <a href="/events">Event <span class="text-purple-600">Planner</span></a>
                </div>
                <div class="flex gap-6 items-center">
                    <a href="/admin/categories" class="text-purple-600 font-semibold">Categories</a>
                    <a href="/admin/events" class="text-gray-700 hover:text-purple-600 font-medium">Events</a>
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

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-purple-600">List of categories</h1>
            <button onclick="openModal()" class="bg-purple-600 text-white px-8 py-3 rounded-lg hover:bg-purple-700 transition font-semibold">
                Create category
            </button>
        </div>

        @if($categories->count() > 0)
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b">
                    <h2 class="text-lg font-semibold text-gray-700">Categories</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach($categories as $category)
                        <div class="px-6 py-4 hover:bg-gray-50 transition flex justify-between items-center">
                            <div>
                                <h3 class="font-medium text-gray-900">{{ $category->CJ_name }}</h3>
                                @if($category->CJ_description)
                                    <p class="text-sm text-gray-500 mt-1">{{ Str::limit($category->CJ_description, 80) }}</p>
                                @endif
                            </div>
                            <div class="flex gap-3">
                                <a href="/admin/categories/{{ $category->CJ_id }}/edit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium text-sm">
                                    Edit
                                </a>
                                <form action="/admin/categories/{{ $category->CJ_id }}" method="POST" class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition font-medium text-sm">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Pagination supprimée car $categories n'est plus paginé -->
        @else
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <p class="text-gray-500 text-lg">No categories yet.</p>
                <button onclick="openModal()" class="inline-block mt-4 bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition">
                    Create your first category
                </button>
            </div>
        @endif
    </div>

    <!-- Create Category Modal -->
    <div id="categoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
            <h2 class="text-2xl font-bold text-center mb-6">Create category</h2>
            
            <form action="/admin/categories" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="CJ_name" class="block text-sm font-medium text-gray-700 mb-2">Display Name</label>
                    <input type="text" name="CJ_name" id="CJ_name" required 
                           placeholder="Enter category name"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>

                <div class="mb-6">
                    <label for="CJ_description" class="block text-sm font-medium text-gray-700 mb-2">Description (Optional)</label>
                    <textarea name="CJ_description" id="CJ_description" rows="3"
                              placeholder="Enter category description"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 resize-none"></textarea>
                </div>

                <div class="flex gap-4">
                    <button type="button" onclick="closeModal()" class="flex-1 border-2 border-purple-600 text-purple-600 py-3 rounded-lg hover:bg-purple-50 transition font-semibold">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 transition font-semibold">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('categoryModal').classList.remove('hidden');
            document.getElementById('categoryModal').classList.add('flex');
        }
        
        function closeModal() {
            document.getElementById('categoryModal').classList.add('hidden');
            document.getElementById('categoryModal').classList.remove('flex');
        }

        
        document.getElementById('categoryModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</body>
</html>
