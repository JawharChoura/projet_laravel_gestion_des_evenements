<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Event Planner</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex min-h-screen">
        <!-- Left Side - Image -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-cover bg-center" 
             style="background-image: url('https://imgs.search.brave.com/Asbzd0FiYJ8FMwmEFoyAe5VCauRj0NLjd1JzdyYKf7c/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly90aW1l/Lmx5L3dwLWNvbnRl/bnQvdXBsb2Fkcy8y/MDI0LzA4L2tleS1l/bGVtZW50cy1ldmVu/dC1yZWdpc3RyYXRp/b24uanBn');">
            <div class="absolute inset-0 bg-black opacity-40"></div>
            <div class="relative flex flex-col items-center justify-center text-white px-12 z-10 w-full h-full">
                <h1 class="text-5xl font-bold mb-4">Welcome Back</h1>
                <p class="text-lg mb-8 text-center max-w-xs">Already have an account? Sign in to continue your journey</p>
                <a href="/login" class="border-2 border-white text-white px-8 py-3 rounded-lg hover:bg-white hover:text-purple-600 transition duration-300 font-semibold">
                    Sign In
                </a>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center px-8 py-12">
            <div class="max-w-md w-full">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold mb-2">Event <span class="text-purple-600">Planner</span></h2>
                    <h1 class="text-3xl font-bold mb-2">Sign Up to Event Planner</h1>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="/register" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="CJ_name" class="block text-sm font-medium text-gray-700 mb-2 uppercase">Your Name</label>
                        <input type="text" name="CJ_name" id="CJ_name" value="{{ old('CJ_name') }}" required 
                               placeholder="Enter your name"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                        @error('CJ_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="CJ_email" class="block text-sm font-medium text-gray-700 mb-2 uppercase">Your Email</label>
                        <input type="email" name="CJ_email" id="CJ_email" value="{{ old('CJ_email') }}" required 
                               placeholder="Enter your email"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                        @error('CJ_email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="CJ_password" class="block text-sm font-medium text-gray-700 mb-2 uppercase">Password</label>
                        <input type="password" name="CJ_password" id="CJ_password" required 
                               placeholder="Enter your password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                        @error('CJ_password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="CJ_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2 uppercase">Confirm Password</label>
                        <input type="password" name="CJ_password_confirmation" id="CJ_password_confirmation" required 
                               placeholder="Enter your password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                    </div>

                    <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 transition duration-300 font-semibold text-lg">
                        Sign Up
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
