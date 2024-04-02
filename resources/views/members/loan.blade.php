<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Loan Book</title>
</head>
<body class="dark:bg-gray-900">
    <x-sidebar/>

    <div class="flex flex-col justify-center items-center ml-40 pt-4 sm:rounded-lg pb-4 gap-4 mt-14">
        <div class="block items-start max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow  dark:bg-gray-800 dark:border-gray-700">
            <h2 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white">You are loaning <span class="font-bold">{{$book->title}} ({{$book->ISBN}})</span> to <span class="font-bold">{{$member->name}} <span class="capitalize">({{$member->type}})</span></span></h2>
            <p class="text-white text-sm mt-3">Select the starting date of the loan</p>
            <form action="{{ route('lending.store', ['book' => $book->id, 'member' => $member->id]) }}" method="POST">
                @csrf
            <div class="relative max-w-sm mt-4">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                </svg>
            </div>
            <input type="date" name="startdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
            </div>
            <div class="flex justify-center items-center mt-8">
                <button type="submit" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-blue-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Confirm</button>
            </div>
        </form>
        </div>
    </div>
</body>
</html>