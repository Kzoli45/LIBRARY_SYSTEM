<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Manage Book</title>
</head>
<body class=" dark:bg-gray-900">
    <x-sidebar/>
<div class="flex flex-col justify-center items-center ml-40 pl-14 pt-4 sm:rounded-lg pb-4 gap-8">
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
                <th scope="col" class="px-6 py-3 text-center">
                    ISBN
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Lending Status
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Edit
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Delete
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($copies as $copy)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$copy->author}}
                        <td class="px-6 py-4">
                            {{$copy->title}}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{$copy->year}}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{$copy->ISBN}}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($copy->takeable == 1)
                                Ready to borrow
                            @else
                                Not available
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="/books/{{$copy->id}}/edit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                        <td class="px-6 py-4">
                        <form  method="POST" action="/books/{{$copy->id}}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="book_id" value=""> 
                            <button type="submit" onclick="event.preventDefault(); confirmDelete({{$copy->takeable}}, {{$copy->id}}, this.form)" class="font-medium text-blue-600 dark:text-red-500 hover:underline">Delete</button>
                        </form>
                        </td>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
        <button type="button" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-red-500 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">DELETE ALL</button>
    
    
<script>
    function confirmDelete(takeable, bookId, form) {
        if (takeable == 1) {
            if (confirm("Are you sure you want to delete this book?")) {
                form.querySelector('input[name="book_id"]').value = bookId;
                form.submit();
            }
        } else {
            alert("You can only delete books that are currently avaliable!");
        }
    }
</script>

</body>
</html>
