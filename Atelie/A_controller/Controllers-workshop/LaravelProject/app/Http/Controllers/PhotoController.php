<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
// use Illuminate\Routing\Controllers\HasMiddleware;

class PhotoController extends Controller
{
    // use HasMiddleware;

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // protected array $middleware = [
    //     'auth', // Apply 'auth' middleware to all methods
    // ];


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all photos including soft-deleted ones
        $photos = Photo::withTrashed()->get();
        return view('photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('photos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Show a specific photo, including soft-deleted ones
        $photo = Photo::withTrashed()->findOrFail($id);
        return view('photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->delete();  // Soft delete the photo
        return redirect()->route('photos.index');
    }

    public function restore($id)
    {
        $photo = Photo::withTrashed()->findOrFail($id);
        $photo->restore();  // Restore the soft-deleted photo
        return redirect()->route('photos.index');
    }
}
