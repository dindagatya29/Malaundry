<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaLaundry - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="flex items-center justify-center h-screen" style="background-color: #51C228;">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <div class="text-center mb-6">
            <img src="https://malaundry.com/logo/20210323145733/logo-text.jpg" alt="MaLaundry Logo" class="mx-auto h-12">
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4 flex items-center border border-gray-300 rounded-md">
                <label for="username" class="sr-only">Username</label>
                <div class="px-3">
                    <i class="fas fa-user"></i>
                </div>
                <input type="text" id="username" name="username" placeholder="Username" required aria-label="Username"
                       class="w-full px-3 py-2 border-none focus:outline-none" autocomplete="username">
            </div>
            <div class="mb-6 flex items-center border border-gray-300 rounded-md">
                <label for="password" class="sr-only">Password</label>
                <div class="px-3">
                    <i class="fas fa-lock"></i>
                </div>
                <input type="password" id="password" name="password" placeholder="Password" required aria-label="Password"
                       class="w-full px-3 py-2 border-none focus:outline-none" autocomplete="current-password">
            </div>
            <div class="flex items-center mb-4">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-sm text-gray-600">Ingat Saya</label>
            </div>
            <button type="submit"
                    class="w-full bg-green-500 text-white py-2 rounded-md hover:bg-green-600 transition duration-200">
                Sign In
            </button>
        </form>
        @if ($errors->any())
            <div class="mt-4 text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mt-4 text-center">
            <a href="#" class="text-green-600 hover:underline">Lupa Password?</a>
        </div>
    </div>
</body>
</html>
