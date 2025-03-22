<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $game->title }}</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div>
        <div class="w-full p-4 bg-green-300">
            <h2 class="text-2xl">Игра: {{ $game->title }}</h2>
        </div>
        <div class="w-full p-4 flex flex-col gap-y-3">
            <h2 class="text-2xl">Добавление категорий</h2>
            <form action="{{ route('addCategory') }}" method="POST" class="flex gap-x-3">
                @csrf
                @method("post")
                <input class='w-full border-2 p-2 text-2xl rounded-lg' type="text" name="title" placeholder="Название категории">
                <input type="hidden" name="game_id" value="{{ $game->id }}">
                <button class='w-auto bg-green-300 px-6 py-1 rounded-lg' type="submit">Добавить</button>
            </form>
        </div>
        <div class="w-full p-4 flex flex-col gap-y-3">
            @foreach($categories as $key => $category)
            <div class="flex justify-between gap-x-3">
                <a href="/categ/{{$category->id}}" class='w-full bg-yellow-300 p-2.5 text-2xl rounded-lg cursor-pointer'>
                    {{ $category->title }}
                </a>
                <div class="flex gap-x-3">
                    <a href="/category/{{$category->id}}/edit" class='grid place-items-center w-full h-full bg-blue-500 px-6 py-1 text-white rounded-lg cursor-pointer'>
                        Редактировать
                    </a>
                    <form class="h-full" action="{{ route('deleteCategory', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 h-full text-white px-6 py-1 rounded-lg" type="submit">Удалить</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>

</html>
