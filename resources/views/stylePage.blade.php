<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Стили</title>
    @vite('resources/css/app.css')
</head>

<body>
@include("layouts.navbar")
<div class="w-full p-4 bg-green-300">
    <h2 class="text-2xl">Стили</h2>
</div>
<div class="w-full p-4 flex flex-col gap-y-3">
    <h2 class="text-2xl">Добавление стиля</h2>
    <form action="{{ route('style.store') }}" method="POST" enctype="multipart/form-data" class="flex gap-x-3">
        @csrf
        @method("POST")
        <input class='w-full border-2 p-2 text-2xl rounded-lg' type="text" name="title" placeholder="Название стиля">
        <input class='w-full border-2 p-2 text-2xl rounded-lg' type="file" name="css" accept="text/css">
        <button class='w-auto bg-green-300 px-6 py-1 rounded-lg' type="submit">Добавить</button>
    </form>
</div>
<div class="w-full p-4 flex flex-col gap-y-3">
    @foreach($styles as $key => $style)
        <div class="flex justify-between gap-x-3">
            <p class='w-full bg-yellow-300 p-2.5 text-2xl rounded-lg'>
                {{ $style->title }}
            </p>
            <div class="flex gap-x-3">
                <a href="/game/{{$style->id}}/edit" class='grid place-items-center w-full h-full bg-blue-500 px-6 py-1 text-white rounded-lg cursor-pointer'>
                    Редактировать
                </a>
                <form class="h-full" action="{{ route('style.delete', $style->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 h-full text-white px-6 py-1 rounded-lg" type="submit">Удалить</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
</body>
</html>
