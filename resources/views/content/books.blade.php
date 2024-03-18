<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Books</title>
</head>
<body>
    @unless (count($books) == 0)
        <div class="flex flex-col justify-center items-center mt-10 gap-3">
            @foreach ($books as $book)
                <div class="flex flex-row justify-center items-center gap-4">
                    {{$book->author}}
                    <p>-</p>
                    {{$book->title}}  ({{$book->ISBN}})
                </div>
            @endforeach
                <a href="/"><button class="bg-black text-white rounded py-1 px-1 w-20 mt-5">Back</button></a>
            @else
                <p>No books found</p> 
                <a href="/"><button class="bg-black text-white rounded py-1 px-1 w-20 mt-5">Back</button></a>
        </div>
    @endunless
</body>
</html>