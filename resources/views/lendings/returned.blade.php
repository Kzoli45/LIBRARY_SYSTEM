<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Returned</title>
</head>
<body class="dark:bg-gray-900">
    <x-sidebar/>

    <div class="flex flex-col justify-center items-center ml-40 pt-4 sm:rounded-lg pb-4 gap-4">
        @if (count($lendings) > 0)
        <h1 class="text-white mt-2 mb-4 text-xl">Returned books of <span class="font-bold">{{ $lendings->first()
        ->member->name }}</span></h1>
            <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Book
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Taken on
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Return date
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lendings as $lending)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$lending->book->title}}
                        </th>
                        <td class="px-6 py-4 text-center">
                            @if ($lending->is_active == 1) 
                                Active
                            
                            @else 
                                Passive
                            @endif
                        </td>
                        <td class="px-6 py-4 capitalize">
                            {{$lending->taken_date}}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($lending->is_active == 1) 
                                {{$lending->return_date}}
                            @else 
                            <span class="text-green-700">Returned</span>
                            @endif
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