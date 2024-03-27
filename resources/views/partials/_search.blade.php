<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>
    <form action="/books" method="GET">
    <div class="flex flex-row justify-center items-center mb-4">
        <select id="categorySelect" name="category" class=" pr-4 border border-r-4 border-gray-700 text-white border-r-gray-500 bg-gray-700 rounded-l-none px-4 py-2 appearance-none focus:outline-none">
            <option value="author">Author</option>
            <option value="title">Title</option>
            <option value="ISBN">ISBN</option>
        </select>
        <input id="searchInput" name="search" type="text" placeholder="Type something..." class="border text-white border-gray-700 px-4 py-2 pr-10 focus:outline-none focus:border-gray-500 bg-gray-700">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Search</button>
    </div>
</form>

</body>
</html>