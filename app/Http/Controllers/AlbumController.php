<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Requests\AlbumRequest;
use App\Http\Resources\AlbumResource;
use Symfony\Component\HttpFoundation\Response;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $album = Album::all();
        return AlbumResource::collection($album);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlbumRequest $request)
    {
        $album = Album::create($request->validated());
        return new AlbumResource($album);
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        return new AlbumResource($album);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlbumRequest $request, Album $album)
    {
        $album->update($request->validated());
        return new AlbumResource($album);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        $album->delete();
        return response("",Response::HTTP_NO_CONTENT);
    }
}
