<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Event Planner</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex min-h-screen">
        <!-- Left Side - Image -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-cover bg-center" 
             style="background-image: url('https://imgs.search.brave.com/RvVoHMt_BaAMbM0Ui3_2XxAVGG5D4avXMmcCD4onD54/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWcu/ZnJlZXBpay5jb20v/cGhvdG9zLXByZW1p/dW0vY29uY2VwdC1p/bnRlcmZhY2UtY29u/bmV4aW9uLW1vZGVy/bmUtY2hhbXBzLW5v/bS11dGlsaXNhdGV1/ci1tb3QtcGFzc2Ut/ZWNyYW4tb3JkaW5h/dGV1ci1wb3J0YWJs/ZV8xMjk2NDk3LTYy/NC5qcGc_c2VtdD1h/aXNfaHlicmlkJnc9/NzQwJnE9ODA');">
            <div class="absolute inset-0 bg-black opacity-40"></div>
            <div class="relative flex flex-col items-center justify-center text-white px-12 z-10 w-full h-full">
                <h1 class="text-5xl font-bold mb-4">Hello Friend</h1>
                <p class="text-lg mb-8 text-center max-w-xs">To keep connected with us provide us with your information</p>
                <a href="/register" class="border-2 border-white text-white px-8 py-3 rounded-lg hover:bg-white hover:text-purple-600 transition duration-300 font-semibold">
                    Sign Up
                </a>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center px-8 py-12">
            <div class="max-w-md w-full">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold mb-2">Event <span class="text-purple-600">Planner</span></h2>
                    <h1 class="text-3xl font-bold mb-2">Sign In to Event Planner</h1>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="/login" method="POST" class="space-y-5">
                    @csrf

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
                        <div class="flex justify-between items-center mb-2">
                            <label for="CJ_password" class="block text-sm font-medium text-gray-700 uppercase">Password</label>
                            <a href="#" class="text-sm text-purple-600 hover:underline">Forgot your password?</a>
                        </div>
                        <input type="password" name="CJ_password" id="CJ_password" required 
                               placeholder="Enter your password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                        @error('CJ_password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700 transition duration-300 font-semibold text-lg">
                        Sign In
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
