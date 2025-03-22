<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function getSelectedGame(): JsonResponse
    {
        $game = Game::query()->where("status", 1)->with("style")->first();
        return response()->json($game);
    }

    public function changeGameStatus(Game $game): void
    {
        $otherGames = Game::query()->where("status", 1)->get();
        $otherGames->each(fn(Game $game) => $game->update(["status" => 0]));
        $game->update(["status" => 1]);
    }

    public function getAllGame()
    {
        $games = Game::with('style', "categories.questions")->get();
        return response()->json($games);
    }

    public function addGame(Request $request)
    {
        $game = new Game();
        $game->title = $request->title;
        $game->style_id=$request->style; // Добавляем выбранный стиль
        $game->save();

        return redirect()->back();
    }

    public function update(Request $request, Game $game)
    {

        $validated = $request->validate([
            'title' => 'required|unique:games,title'
        ]);

        $game->update($validated);

        return redirect('/');
    }

    public function getGame(Game $game)
    {
        $gameWithRelation = $game->with("categories.questions")->first();
        return response()->json($gameWithRelation);
    }

    public function deleteGame(Game $game)
    {
        $game->delete();
        return redirect()->back();
    }

    public function edit(Game $game)
    {
        return view('game.edit', ['game' => $game]);
    }
}
