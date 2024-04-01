<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Members</title>
</head>
<body>
    <body class="dark:bg-gray-900">
        <x-sidebar/>
    
        <div class="flex flex-col justify-center items-center ml-40 pt-4 sm:rounded-lg pb-4 gap-4">

            <form action="/members" method="GET">
                @csrf
            <div class="flex flex-row justify-center items-center mb-4">
                <select id="categorySelect" name="category" class=" pr-4 border border-r-4 border-gray-700 text-white border-r-gray-500 bg-gray-700 rounded-l-none px-4 py-2 appearance-none focus:outline-none">
                    <option value="name">Name</option>
                    <option value="city">City</option>
                    <option value="street">Address</option>
                </select>
                <input id="searchInput" name="search" type="text" placeholder="Type something..." class="border text-white border-gray-700 px-4 py-2 pr-10 focus:outline-none focus:border-gray-500 bg-gray-700">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Search</button>
            </div>
        </form>
            
            @if (count($members) > 0)
            <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Registered as
                        </th>
                        <th scope="col" class="px-6 py-3">
                            City
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Contact
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Manage
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$member->name}}
                        </th>
                        <td class="px-6 py-4 capitalize">
                            {{$member->type}}
                        </td>
                        <td class="px-6 py-4">
                            {{$member->city}}
                        </td>
                        <td class="px-6 py-4">
                            {{$member->contact}}
                        </td>
                        <td class="px-6 py-4">
                            <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Manage</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h1 class="text-red-500">No Members Found</h1>
            @endif
        </div>
    </body>
</body>
</html>