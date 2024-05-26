<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>

<body class="font-[Roboto]">
    {{-- <div class="h-screen container mx-auto flex items-center justify-center">
        <div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-950">
            <div class="bg-white border dark:bg-gray-900  rounded-lg px-8 py-6 max-w-md">
                <h1 class="text-2xl font-bold text-center mb-4 dark:text-gray-200">Welcome to GymBilog!</h1>
                <form id="loginForm" action="{{ route('validate_login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
                        <input type="email" id="email" name="email" class="shadow-sm rounded-md w-full px-3 placeholder:text-sm text-sm py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="your@email.com" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                        <input type="password" id="password" name="password" class="shadow-sm rounded-md w-full px-3 placeholder:text-sm text-sm py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 bg-blue-700 rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</button>
                </form>
            </div>
        </div>
    </div> --}}
    <div class="h-screen container mx-auto flex items-center justify-center">
        <div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-950">
            <div class="bg-white border dark:bg-gray-900  rounded-lg px-8 py-6 max-w-md">
                <h1 class="text-2xl font-bold text-center mb-4 dark:text-gray-200">Welcome to GymBilog!</h1>
                @if (session('error'))
                    <div id="error-alert"
                        class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <strong class="font-bold">Error:</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
                <form id="loginForm" action="{{ route('validate_login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email
                            Address</label>
                        <input type="email" id="email" name="email"
                            class="shadow-sm rounded-md w-full px-3 placeholder:text-sm text-sm py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="your@email.com" required>
                    </div>
                    <div class="mb-4">
                        <label for="password"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                        <input type="password" id="password" name="password"
                            class="shadow-sm rounded-md w-full px-3 placeholder:text-sm text-sm py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter your password" required>
                    </div>
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 bg-blue-700 rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function() {
            var errorAlert = document.getElementById('error-alert');
            if (errorAlert) {
                errorAlert.remove();
            }
        }, 2000);
    </script>
</body>

</html>
