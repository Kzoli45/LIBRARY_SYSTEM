<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Books</title>
</head>
<body class=" dark:bg-gray-900">
    <x-sidebar/>

    <div class="flex flex-col justify-center items-center ml-40 pt-4 sm:rounded-lg pb-4 gap-4">
        @include('partials._search')
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
                        Edit
                    </th>
                </tr>
            </thead>
            <tbody>
                @unless (count($books) == 0)
                @foreach ($books as $book)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$book->author}}
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
                        </th>
                    </tr>
                @endforeach
                @else
                    No Books Found
                @endunless
            </tbody>
        </table>
    </div>
</body>
</html>