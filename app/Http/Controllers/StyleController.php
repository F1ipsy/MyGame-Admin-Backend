<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StyleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $style = Style::query()->where("id", $request->id)->first()->path;
        return response()->json($style);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $style = new Style();
        $style->title=$request->title;
        if ($request->hasFile('css')) {
            $origName = $request->css->getClientOriginalName();
            Storage::disk("public")->putFileAs('/style/', $request->css, $origName);
            $style->path = '/storage/style/' . $origName;
        }
        $style->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Style $style)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Style $style)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Style $style)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Style $style)
    {
        $style->delete();
        return redirect()->back();
    }
}
