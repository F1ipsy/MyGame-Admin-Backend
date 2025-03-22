<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->title }}</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="w-full flex p-4">
        <div class="w-[660px] h-auto mx-auto flex flex-col gap-y-3">
            <div class="w-full border shadow-xl rounded-lg p-4 flex flex-col gap-y-3">
                <h2 class="text-2xl">{{ $category->title }}</h2>
                <form action="{{ route('addQuestion') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-y-3">
                    @csrf
                    @method("POST")
                    <textarea class='w-full min-h-[46px] h-24 border-2 p-2 rounded-lg' type="text" name="desc" placeholder="Описание вопроса"></textarea>
                    <textarea class='w-full min-h-[46px] h-[46px] border-2 p-2 rounded-lg' type="text" name="question" placeholder="Вопрос"></textarea>
                    <select class='w-full border-2 p-2 rounded-lg' name="question_type">
                        <option value="text" selected>Выберите тип вопроса</option>
                        <option value="img">Изображение</option>
                        <option value="video">Видео</option>
                        <option value="music">Звук</option>
                    </select>
                    <input type="file" name="question_file">
                    <textarea class='w-full min-h-[46px] h-[46px] border-2 p-2 rounded-lg' type="text" name="answer" placeholder="Ответ"></textarea>
                    <textarea class='w-full min-h-[46px] h-24 border-2 p-2 rounded-lg' type="text" name="answer_desc" placeholder="Описание ответа"></textarea>
                    <select class='w-full border-2 p-2 rounded-lg' name="answer_type">
                        <option value="text" selected>Выберите тип ответа</option>
                        <option value="img">Изображение</option>
                        <option value="video">Видео</option>
                        <option value="music">Звук</option>
                    </select>
                    <input type="file" name="answer_file">
                    <select class='w-full border-2 p-2 rounded-lg' name="points">
                        <option value="#" disabled selected>Очки</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="300">300</option>
                        <option value="400">400</option>
                        <option value="500">500</option>
                    </select>
                    <input class='w-full border-2 p-2 rounded-lg' type="hidden" name="category_id" value="{{ $category->id }}">
                    <button class='w-full bg-green-300 p-2 rounded-lg' type="submit">Создать</button>
                    @if ($errors->any())
                    <div class="text-red-500 text-lg">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </form>
            </div>
            <div class="w-full border shadow-xl rounded-lg p-4 flex flex-col gap-y-3">
                <table>
                    <thead>
                        <tr>
                            <th class="w-[48%] px-1 text-start">Вопрос</th>
                            <th class="w-[14%] px-1">Очки</th>
                            <th class="w-[14%] px-1">Действие</th>
                            <th class="w-[24%] px-1">Действие</th> <!-- Добавляем новую колонку для кнопки редактирования -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)
                        <tr class="border-b-2">
                            <td class="w-[48%] px-1 py-1 text-wrap">{{ $question->question }}</td>
                            <td class="w-[14%] px-1 py-1 text-center">{{ $question->points }}</td>
                            <td class="w-[14%] px-1 py-1 text-center">
                                <form action="{{ route('deleteQuestion', $question->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="w-full bg-red-500 text-white px-3 py-1 rounded" type="submit">Удалить</button>
                                </form>
                            </td>
                            <td class="w-[24%] px-1 py-1 text-center"> <!-- Новая колонка для кнопки редактирования -->
                                <div class="flex h-full w-full">
                                    <a href="{{ route('question.edit', $question->id) }}" class="w-full bg-blue-500 py-1 text-white rounded">Редактировать</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
