<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Library System</title>
</head>
<body>
    <div class="flex flex-col justify-center items-center mt-14">
        <p class="text-lg mb-4">Home Page</p>
        <p class="mb-4">Logged in as {{auth()->user()->username}}</p>
        <div class="flex flex-row justify-center items-center mt-2 gap-4">
            <a href="/books"><button class="bg-black text-white rounded py-1 px-1">Books</button></a>
            <div>
                <form method="POST" action="/logout">
                    @csrf

                <button type="submit" class="bg-black text-white rounded py-1 px-1 ">Logout</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>