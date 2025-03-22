<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    @vite('resources/css/app.css')
</head>

<body>
    @include("layouts.navbar")
    <div class="w-full p-4 bg-green-300">
        <h2 class="text-2xl">Игры</h2>
    </div>
    <div class="w-full p-4 flex flex-col gap-y-3">
        <form action="{{ route('addGame') }}" method="POST" class="flex gap-x-3">
            @csrf
            @method("POST")
            <div class="w-full flex flex-col gap-2">
                <label for="title" class="text-2xl">Название игры</label>
                <input class='w-full border-2 p-2 text-2xl rounded-lg' type="text" id="title" name="title" placeholder="Название игры">
            </div>
            <div class="w-full flex flex-col gap-2">
                <label for="style" class="text-2xl">Стиль</label>
                <div class="flex gap-4">
                    <select class='w-full border-2 p-2 text-2xl rounded-lg' id="style" name="style">
                        @foreach($styles as $style)
                            <option value="{{$style->id}}">{{$style->title}}</option>
                        @endforeach
                    </select>
                    <button class='w-auto h-full self-end bg-green-300 px-12 rounded-lg' type="submit">Добавить</button>
                </div>
            </div>
        </form>
    </div>
    <div class="w-full p-4 flex flex-col gap-y-3">
        @foreach($games as $key => $game)
            <div class="flex justify-between gap-x-3">
                <a href="/set/{{$game->id}}" class='w-full bg-yellow-300 p-2.5 text-2xl rounded-lg cursor-pointer'>
                    {{ $game->title }}
                </a>
                <div class="flex gap-x-3">
                    <a href="/game/{{$game->id}}/edit" class='grid place-items-center w-full h-full bg-blue-500 px-6 py-1 text-white rounded-lg cursor-pointer'>
                        Редактировать
                    </a>
                    <form class="h-full" action="{{ route('deleteGame', $game->id) }}" method="POST">
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
