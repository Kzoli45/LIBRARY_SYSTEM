<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Library System</title>
</head>
<body  class=" dark:bg-gray-900">
    <x-sidebar/>
    
    
    <div class="box flex flex-col justify-center items-center ml-40 mt-12 gap-4">
        <p class="elte font-bold">ELTE SEK</p>
        <p class= "font-bold lib uppercase">Library System 2024 ©</p>

    </div>
    <style>
        .box {
            margin-top: 4rem;
        }
        .elte {
            color: #d3d3d3;
            font-size: 5rem;
        }
        .lib {
            color: #d3d3d3;
            font-size: 3rem;
        }
    </style>
</body>
</html>