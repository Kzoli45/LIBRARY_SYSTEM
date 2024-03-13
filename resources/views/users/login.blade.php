<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Login</title>
</head>
<body>
    <div>
        <form method="POST" action="/users/authenticate">
        @csrf
        
        <div class="mb-6">
            <label for="username" class="inline-block text-lg mb-2">Username</label>
            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="username">
            @error('username')<p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="inline-block text-lg mb-2">Username</label>
            <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password">
            @error('password')<p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <button
                type="submit"
                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Sign In
            </button>
        </div>
        </form>
    </div>
</body>
</html>