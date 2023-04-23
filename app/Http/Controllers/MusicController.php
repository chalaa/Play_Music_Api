<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use App\Http\Requests\MusicRequest;
use App\Http\Resources\MusicResource;
use Symfony\Component\HttpFoundation\Response;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $music = Music::all();
        return MusicResource::collection($music);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => ["required","string"],
            "artist" => ["required","string"],
            "image" => ["required","image"],
            "music" => ["required","file"],
            "album_id" => ["sometimes"]
        ]);
        $music = Music::create([
            "title" => $request->title,
            "artist" => $request->artist,
            "image_path" => $request->file("image")->store("image","public"),
            "music_path" => $request->file("music")->store("music","public"),
            "album_id" => $request->album_id,
        ]);
        return new MusicResource($music);
    }

    /**
     * Display the specified resource.
     */
    public function show(Music $music)
    {
        return new MusicResource($music);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Music $music)
    {
        $request->validate([
            "title" => ["string"],
            "artist" => ["string"],
            "image" => ["image"],
            "music" => ["file"],
            "album_id" => ["sometimes"]
        ]);
        $music->update([
            "title" => $request->title?$request->title:$music->title,
            "artist" => $request->artist?$request->artist:$music->artist,
            "image_path" => $request->file("image")?$request->file("image")->store("image","public"):$music->image_path,
            "music_path" => $request->file("music")?$request->file("music")->store("music","public"):$music->music_path,
            "album_id" => $request->album_id,
        ]);
        return new MusicResource($music);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Music $music)
    {
        $music->delete();
        return response("",Response::HTTP_NO_CONTENT);
    }
}
