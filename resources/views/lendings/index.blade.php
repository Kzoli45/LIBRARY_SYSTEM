<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Lendings</title>
</head>
<body class="dark:bg-gray-900">
    <x-sidebar/>

    <div class="flex flex-col justify-center items-center ml-44 pt-4 sm:rounded-lg pb-4 gap-4">
        @if (count($lendings) > 0)
            <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Loaned to
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Book
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Return date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Put back
                        </th>
                        <th scope="col" class="px-6 py-3">
                            View All
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lendings as $lending)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$lending->member->name}}
                        </th>
                        <td class="px-6 py-4 capitalize">
                            {{$lending->book->title}}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($lending->is_active = 1) 
                                Active
                            
                            @else 
                                Passive
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($lending->is_active = 1) 
                                {{$lending->return_date}}
                            @else 
                                <span class="text-green-700">Returned</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Put back</a>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="/lendings/{{$lending->member->id}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View All</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h1 class="text-red-500">No Lendings Found</h1>
            @endif

    </div>
</body>
</html>