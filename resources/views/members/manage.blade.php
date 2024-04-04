<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Manage Member</title>
</head>
<body  class=" dark:bg-gray-900">
    <x-sidebar/>

   

    <div class=" mt-14 ml-40 flex flex-col justify-center items-center">
<div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

    <div class="mt-6 flex flex-col items-center pb-10">
        <div class="w-24 h-24 mb-3 rounded-full shadow-md flex flex-col items-center justify-center bg-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-2 -2 28 28" style="fill: rgba(112, 128, 144, 1);transform: ;msFilter:;"><path d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5zM20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h17z"></path></svg>
        </div>
        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$member->name}} (<span class="capitalize">{{$member->type}})</span></h5>
        <div class="flex flex-col mt-1 justify-center items-center gap-2">
            <span class="font-semibold text-sm text-gray-500 dark:text-gray-400 capitalize">{{$member->city}}</span>
            <address class="text-sm text-gray-500 dark:text-gray-400 capitalize">{{$member->street}} {{$member->door}}</address>
            <span class="text-sm text-gray-500 dark:text-gray-400 capitalize">{{$member->contact}}</span>
        </div>
        <div class="flex mt-2 md:mt-6 gap-1">
            <a href="/members/{{$member->id}}/edit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit Details</a>
            <form method="POST" action="/members/{{$member->id}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-red-500 dark:border-gray-600 dark:hover:text-red-500 dark:hover:bg-gray-700">Delete Member</button>
            </form>
            
        </div>
    </div>
</div>

@if(session('error'))
<div id="error-message" class="alert alert-danger text-red-600 ease-out mt-4">
{{ session('error') }}
</div>
@endif

</div>
<script>
            setTimeout(function () {
                var errorMessage = document.getElementById('error-message');
                if (errorMessage) {
                    errorMessage.style.display = 'none';
                }
            }, 2000);
        </script>
</body>
</html>