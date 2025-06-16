<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование вопроса</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="w-full flex p-4">
        <div class="w-[660px] h-auto mx-auto flex flex-col gap-y-3">
            <div class="w-full border shadow-xl rounded-lg p-4 flex flex-col gap-y-3">
                <h2 class="text-2xl">Редактирование вопроса</h2>
                <form action="{{ route('updateQuestion', $question) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-y-3">
                    @csrf
                    @method('PUT')
                    <textarea class='w-full min-h-[46px] h-24 border p-2 rounded-lg' type="text" name="desc" placeholder="Описание">{{ old('desc', $question->desc) }}</textarea>
                    <textarea class='w-full min-h-[46px] h-[46px] border p-2 rounded-lg' type="text" name="question" placeholder="Вопрос">{{ old('question', $question->question) }}</textarea>
                    <select class='w-full border p-2 rounded-lg' name="question_type">
                        <option value="text" @if(old('question_type', $question->question_type) == 'text') selected @endif>Выберите тип вопроса</option>
                        <option value="img" @if(old('question_type', $question->question_type) == 'img') selected @endif>Изображение</option>
                        <option value="video" @if(old('question_type', $question->question_type) == 'video') selected @endif>Видео</option>
                        <option value="music" @if(old('question_type', $question->question_type) == 'music') selected @endif>Звук</option>
                    </select>
                    <input type="file" name="question_file" class="border rounded-lg p-2">
                    <textarea class='w-full min-h-[46px] h-[46px] border p-2 rounded-lg' type="text" name="answer" placeholder="Ответ">{{ old('answer', $question->answer) }}</textarea>
                    <textarea class='w-full min-h-[46px] h-24 border p-2 rounded-lg' type="text" name="answer_desc" placeholder="Описание ответа">{{ old('answer_desc', $question->answer_desc) }}</textarea>
                    <select class='w-full border p-2 rounded-lg' name="answer_type">
                        <option value="text" @if(old('answer_type', $question->answer_type) == 'text') selected @endif>Выберите тип ответа</option>
                        <option value="img" @if(old('answer_type', $question->answer_type) == 'img') selected @endif>Изображение</option>
                        <option value="video" @if(old('answer_type', $question->answer_type) == 'video') selected @endif>Видео</option>
                        <option value="music" @if(old('answer_type', $question->answer_type) == 'music') selected @endif>Звук</option>
                    </select>
                    <input type="file" name="answer_file" class="border rounded-lg p-2">
                    <select class='w-full border p-2 rounded-lg' name="points">
                        <option value="100" @if(old('points', $question->points) == 100) selected @endif>100</option>
                        <option value="200" @if(old('points', $question->points) == 200) selected @endif>200</option>
                        <option value="300" @if(old('points', $question->points) == 300) selected @endif>300</option>
                        <option value="400" @if(old('points', $question->points) == 400) selected @endif>400</option>
                        <option value="500" @if(old('points', $question->points) == 500) selected @endif>500</option>
                    </select>
                    <button class='w-full bg-green-300 p-2 rounded-lg' type="submit">Обновить</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
