<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Переименовать категорию</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div>
        <div class="w-full p-4 bg-green-300">
            <h2 class="text-2xl">Категория: {{ $category->title }}</h2>
        </div>
        <div class="p-4 flex rounded-lg mt-4">
            <form action="{{ route('category.update', $category->id) }}" method="POST" class="w-full flex justify-between">
                @csrf
                @method('PUT')
                <input autofocus type=" text" name="title" value="{{ $category->title }}" id="categoryName" class="w-full rounded-lg p-2.5 text-2xl outline-none ring-2 ring-yellow-300" />
                <button class='h-full bg-green-300 px-6 py-1 ml-3 rounded-lg' type="submit">Сохранить</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const input = document.getElementById("categoryName");
            input.focus();
            input.setSelectionRange(input.value.length, input.value.length);
        });
    </script>
</body>

</html>
