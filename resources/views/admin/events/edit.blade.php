<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - Event Planner</title>
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
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('imagePreviewContainer').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const capacity = document.getElementById('CJ_capacity');
            const price = document.getElementById('CJ_price');
            [capacity, price].forEach(function(input) {
                if (input) {
                    input.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            form.submit();
                        }
                    });
                }
            });
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
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold text-center mb-12">Edit Event</h1>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="/admin/events/{{ $event->CJ_id }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                
                <div class="bg-white p-8 rounded-lg shadow">
                    <div>
                        <label for="CJ_title" class="block text-sm font-medium text-gray-700 mb-2">Event Title</label>
                        <input type="text" name="CJ_title" id="CJ_title" value="{{ old('CJ_title', $event->CJ_title) }}" required
                               placeholder="---"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                        @error('CJ_title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                
                <div class="bg-white p-8 rounded-lg shadow">
                    <h2 class="text-xl font-bold mb-6">Details</h2>
                    
                    <div class="grid grid-cols-2 gap-6">
                        
                        <div>
                            <label for="CJ_start_date" class="block text-sm font-medium text-gray-700 mb-2">Date start</label>
                            <input type="datetime-local" name="CJ_start_date" id="CJ_start_date" 
                                   value="{{ old('CJ_start_date', $event->CJ_start_date->format('Y-m-d\TH:i')) }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                            @error('CJ_start_date')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        
                        <div>
                            <label for="CJ_place" class="block text-sm font-medium text-gray-700 mb-2">Place</label>
                            <input type="text" name="CJ_place" id="CJ_place" value="{{ old('CJ_place', $event->CJ_place) }}" required
                                   placeholder="---"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                            @error('CJ_place')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        
                        <div>
                            <label for="CJ_end_date" class="block text-sm font-medium text-gray-700 mb-2">Date end</label>
                            <input type="datetime-local" name="CJ_end_date" id="CJ_end_date" 
                                   value="{{ old('CJ_end_date', $event->CJ_end_date->format('Y-m-d\TH:i')) }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                            @error('CJ_end_date')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        
                        <div>
                            <label for="CJ_category_id" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <select name="CJ_category_id" id="CJ_category_id" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->CJ_id }}" @selected(old('CJ_category_id', $event->CJ_category_id) == $category->CJ_id)>
                                        {{ $category->CJ_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('CJ_category_id')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        
                        <div>
                            <label for="CJ_status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="CJ_status" id="CJ_status" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                                <option value="active" @selected(old('CJ_status', $event->CJ_status) === 'active')>Active</option>
                                <option value="archived" @selected(old('CJ_status', $event->CJ_status) === 'archived')>Archived</option>
                            </select>
                            @error('CJ_status')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        
                        <div>
                            <label for="CJ_capacity" class="block text-sm font-medium text-gray-700 mb-2">Capacity</label>
                            <input type="number" name="CJ_capacity" id="CJ_capacity" min="1" value="{{ old('CJ_capacity', $event->CJ_capacity) }}" required
                                   placeholder="Entrez la nouvelle capacité"
                                   autocomplete="off"
                                   onfocus="this.select()"
                                   class="w-full px-4 py-3 border-2 border-purple-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 text-lg font-semibold text-purple-900">
                            <span class="text-xs text-gray-500">Modifiez la capacité avec le clavier puis validez.</span>
                            @error('CJ_capacity')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        
                        <div>
                            <label for="CJ_price" class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                            <input type="number" name="CJ_price" id="CJ_price" step="0.01" min="0" value="{{ old('CJ_price', $event->CJ_price) }}" required
                                   placeholder="Entrez le nouveau prix"
                                   autocomplete="off"
                                   onfocus="this.select()"
                                   class="w-full px-4 py-3 border-2 border-purple-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 text-lg font-semibold text-purple-900">
                            <span class="text-xs text-gray-500">Modifiez le prix avec le clavier puis validez.</span>
                            @error('CJ_price')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                
                <div class="bg-white p-8 rounded-lg shadow">
                    <h2 class="text-xl font-bold mb-6">Event Description</h2>
                    
                    <div class="mb-6">
                        <label for="CJ_description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="CJ_description" id="CJ_description" rows="6" required
                                  placeholder="Write event description..."
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 resize-none">{{ old('CJ_description', $event->CJ_description) }}</textarea>
                        @error('CJ_description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                
                <div class="bg-white p-8 rounded-lg shadow">
                    <h2 class="text-xl font-bold mb-6">Event Image</h2>
                    
                    <div class="grid grid-cols-2 gap-8">
                        
                        <div>
                            <label for="CJ_image" class="block text-sm font-medium text-gray-700 mb-2">Upload Image</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-purple-600 transition" 
                                 onclick="document.getElementById('CJ_image').click()">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <p class="text-gray-700 font-medium">Click to upload</p>
                                <p class="text-gray-500 text-sm">or drag and drop</p>
                                <p class="text-gray-400 text-xs mt-1">PNG, JPG, GIF up to 5MB</p>
                            </div>
                            <input type="file" name="CJ_image" id="CJ_image" accept="image/*" 
                                   onchange="previewImage(event)"
                                   class="hidden">
                            @error('CJ_image')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        
                        <div>
                            @if($event->CJ_image)
                                <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                                <img src="{{ asset('storage/' . $event->CJ_image) }}" alt="Current image" class="w-full h-48 object-cover rounded-lg border border-gray-300">
                            @endif
                            
                            <div id="imagePreviewContainer" class="hidden mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">New Image Preview</label>
                                <img id="imagePreview" src="" alt="Image preview" class="w-full h-48 object-cover rounded-lg border border-gray-300">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="flex gap-4 justify-center">
                    <button type="submit" class="bg-purple-600 text-white px-12 py-3 rounded-lg hover:bg-purple-700 transition font-semibold">
                        Update Event
                    </button>
                    <a href="/admin/events" class="bg-gray-400 text-white px-12 py-3 rounded-lg hover:bg-gray-500 text-center font-semibold transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
