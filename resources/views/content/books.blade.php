<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Books</title>
</head>
<body class="dark:bg-gray-900">
    <x-sidebar/>

    <div class="flex flex-col justify-center items-center ml-40 pt-4 sm:rounded-lg pb-4 gap-4">
        @include('partials._search')
        
        @if (count($books) > 0)
        <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Author
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Year
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quantity
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Manage
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$book->author}}
                    </th>
                    <td class="px-6 py-4">
                        {{$book->title}}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{$book->year}}
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{$book->quantity}}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('manage.book', ['author' => $book->author, 'title' => $book->title, 'year' => $book->year]) }}"class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Manage</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h1 class="text-red-500">No Books Found</h1>
        @endif
    </div>
</body>
</html>
