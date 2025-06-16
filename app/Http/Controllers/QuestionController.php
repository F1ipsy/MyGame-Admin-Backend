<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function getQuestions()
    {
        return Question::all();
    }

    public function getQuestion(Question $question)
    {
        return $question;
    }

    public function addQuestion(Request $request)
    {
        // Валидация входных данных
        $request->validate([
            'question' => 'nullable|string|max:255',
            'points' => 'required|integer',
            'category_id' => 'required|integer|exists:categories,id',
            'question_file' => 'nullable|file',
            'answer' => 'required|string',
            'answer_desc' => 'nullable|string',
            'answer_type' => 'required|string',
            'answer_file' => 'nullable|file',
        ]);

        // Проверка на уникальность очков вопроса в категории
        $existingPoints = Question::where('category_id', $request->category_id)
            ->where('points', $request->points)
            ->first();

        if ($existingPoints) {
            return redirect()->back()->withErrors(['question' => 'Вопрос с таким кол-вом очков уже существует в данной категории']);
        }

        // Создание нового вопроса
        $question = new Question;
        $question->question = $request->question;
        $question->points = $request->points;

        if ($request->file('question_file')) {
            $path_question = $request->file('question_file')->store('file');
            $question->question_file = 'storage/' . $path_question;
        }

        if ($request->file('answer_file')) {
            $path_answer = $request->file('answer_file')->store('file');
            $question->answer_file = 'storage/' . $path_answer;
        }

        $question->desc = $request->desc;
        $question->question_type = $request->question_type;
        $question->answer = $request->answer;
        $question->answer_desc = $request->answer_desc;
        $question->answer_type = $request->answer_type;
        $question->category_id = $request->category_id;

        $question->save();

        return redirect()->back();
    }

    public function editQuestion(Question $question)
    {
        return view('question.edit', compact('question'));
    }

    public function updateQuestion(Request $request, Question $question)
    {
        $validated = $request->validate([
            'desc' => 'nullable|string',
            'question' => 'required|string',
            'question_type' => 'required|string',
            'question_file' => 'nullable|file',
            'answer' => 'required|string',
            'answer_desc' => 'nullable|string',
            'answer_type' => 'required|string',
            'answer_file' => 'nullable|file',
            'points' => 'required|integer',
        ]);

        // Обновляем поля модели из валидированных данных
        $question->fill($validated);

        if ($request->file('question_file')) {
            $path_question = $request->file('question_file')->store('file');
            $question->question_file = 'storage/' . $path_question;
        }

        if ($request->file('answer_file')) {
            $path_answer = $request->file('answer_file')->store('file');
            $question->answer_file = 'storage/' . $path_answer;
        }

        // Сохраняем модель
        $question->save();

        return redirect()->route('categ', $question->category);
    }

    public function deleteQuestion(Question $question)
    {
        $question->delete();

        return redirect()->back();
    }
}
