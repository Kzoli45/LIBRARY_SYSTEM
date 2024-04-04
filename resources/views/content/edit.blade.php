<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Edit Book</title>
</head>
<body class=" dark:bg-gray-900">
    <x-sidebar/>

    <div class="flex flex-row justify-center items-center ml-40 sm:rounded-lg pb-4">
        <section class="bg-white dark:bg-gray-900">
            <div class="px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit <span class="italic text-gray-400">{{$book->title}} ({{$book->ISBN}})</span></h2>
                <form method="POST" action="/books/{{$book->id}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Book title" value="{{$book->title}}">
                            @error('title')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="author" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Author</label>
                            <input type="text" name="author" id="author" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type author's name" value="{{$book->author}}">
                            @error('author')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="publisher" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publisher</label>
                            <input type="text" name="publisher" id="publisher" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Publisher's name" value="{{$book->publisher}}">
                            @error('publisher')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ISBN</label>
                            <input type="text" name="ISBN" id="ISBN" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="12345678" value="{{$book->ISBN}}">
                            @error('ISBN')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year of Release</label>
                            <input type="text" name="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="2024" value="{{$book->year}}">
                            @error('year')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div> 
                        <div>
                            <label for="release" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Release</label>
                            <input type="number" name="release" id="release" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Release" value="{{$book->release}}">
                            @error('release')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div> 
                        <div>
                            <label for="takeable" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lending status</label>
                            <select id="takeable" name="takeable" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @if ($book->takeable == 1)
                                <option value="1" {{ $book->takeable == 1 ? 'selected' : '' }}>Ready to borrow</option>
                                @else
                                <option value="0" {{ $book->takeable == 0 ? 'selected' : '' }}>Not available</option>
                                @endif
                            </select>
                            @error('takeable')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Edit book
                    </button>
                </form>
            </div>
          </section>

    </div>
</body>
</html>