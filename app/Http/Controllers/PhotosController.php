<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Photo::class);
    }

    protected $rules = [
        'album_id' => 'bail|required|integer|exists:albums,id',
        'name' => 'required',
        'img_path' => 'bail|required|image'
    ];

    /**
     * Summary of processThumbnailFile
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Photo $photo
     * @return bool|string
     */
    protected function processImageFile(Request $request, Photo $photo)
    {
        $file = $request->file('img_path');
        $name = preg_replace('@[^a-z]i@', '_', $photo->name);
        $filename = $name . '.' . $file->extension();
        $image = $file->storeAs(config('filesystems.photo_images_dir') . $photo->album_id, $filename);

        return $image;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Photo::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $photo = new Photo();
        $album = $request->album_id ? Album::findOrFail($request->album_id) : new Album();
        $albums = $this->getAlbums();
        return view('photos.edit-photo', compact('album', 'photo', 'albums'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules);

        Auth::user()->albums->findOrFail($request->album_id);

        $photo = new Photo();
        $photo->name = $request->name;
        $photo->description = $request->description;
        $photo->album_id = $request->album_id;
        $photo->img_path = $this->processImageFile($request, $photo);
        $res = $photo->save();

        $message = 'photo "' . $request->name . '" ';
        $message .= $res ? 'created.' : ' NOT created.';

        session()->flash('message', $message);

        return redirect()->route('albums.photos', $photo->album);
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        return $photo;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        $album = $photo->album;
        $albums = $this->getAlbums();
        return view("photos.edit-photo", compact('photo', 'album', 'albums'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        $data = $request->only(['name', 'description', 'album_id']);

        $photo->name = $data['name'];
        $photo->description = $data['description'];
        $photo->album_id = $data['album_id'];

        if ($request->hasFile('img_path')) {
            $photo->img_path = $this->processImageFile($request, $photo);
        }


        $res = $photo->save();

        $message = 'Photo "' . $photo->name . '" ';
        $message .= $res ? 'updated.' : ' was not updated.';

        session()->flash('message', $message);

        return redirect()->route('albums.photos', $photo->album);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        $image = $photo->img_path;

        $res = +$photo->delete();

        if ($image) {
            Storage::delete($image);
        }

        return $res;
    }

    /**
     * Summary of getAlbums
     * @return \Illuminate\Support\Collection
     */
    public function getAlbums()
    {
        return Album::orderBy('album_name')->select(['id', 'album_name'])->whereUserId(Auth::user()->id)->get();
    }
}
