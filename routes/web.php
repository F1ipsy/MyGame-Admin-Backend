<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StyleController;
use App\Models\Category;
use App\Models\Game;
use App\Models\Question;
use App\Models\Style;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $games = Game::all();
    return view('home', ["games" => $games, "styles" => Style::all()]);
})->name('home');

Route::get('/categ/{id}', function ($id) {

    $category = Category::find($id);
    $questions = Question::query()->where("category_id", "=", $id)->get();

    return view('categoryPage', ["category" => $category, "questions" => $questions]);
})->name('categ');

Route::get('/set/{id}', function ($id) {

    $game = Game::find($id);
    $categories = Category::query()->where("game_id", "=", $id)->get();

    return view('gamePage', ["game" => $game, "categories" => $categories]);
});

Route::get('/styles', function () {
    $styles = Style::all();
    return view('stylePage', ["styles" => $styles]);
})->name('styles');


// Категории
Route::get("/categories", [CategoryController::class, "getCategories"])->name("getCategories");
Route::get("/category/{category}", [CategoryController::class, "getCategory"])->name("getcategory");
Route::post("/category", [CategoryController::class, "addCategory"])->name("addCategory");
Route::put("/category/{category}", [CategoryController::class, "update"])->name("category.update");
Route::delete("/category/{category}", [CategoryController::class, "deleteCategory"])->name("deleteCategory");
Route::get("/category/{category}/edit", [CategoryController::class, "edit"])->name("category.edit");

// Вопросы
Route::get("/questions", [QuestionController::class, "getQuestions"])->name("getQuestions");
Route::get("/question/{question}", [QuestionController::class, "getQuestion"])->name("getQuestion");
Route::post("/question", [QuestionController::class, "addQuestion"])->name("addQuestion");
Route::get('/question/{question}/edit', [QuestionController::class, 'editQuestion'])->name('question.edit');
Route::put("/question/{question}", [QuestionController::class, "updateQuestion"])->name("updateQuestion");
Route::delete("/question/{question}", [QuestionController::class, "deleteQuestion"])->name("deleteQuestion");

// Игры
Route::get("/games", [GameController::class, "getAllGame"])->name("getAllGame");
Route::get("/game/{game}", [GameController::class, "getGame"])->name("getGame");
Route::post("/game", [GameController::class, "addGame"])->name("addGame");
Route::put("/game/{game}", [GameController::class, "update"])->name("game.update");
Route::delete("/game/{game}", [GameController::class, "deleteGame"])->name("deleteGame");
Route::get("/game/{game}/edit", [GameController::class, "edit"])->name("game.edit");

// Стили
Route::post("/styles", [StyleController::class, "store"])->name("style.store");
Route::delete("/styles/{style}", [StyleController::class, "destroy"])->name("style.delete");
