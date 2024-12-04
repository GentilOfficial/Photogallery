<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Models\Album;
use App\Models\AlbumCategory;
use App\Models\Category;
use App\Models\Photo;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AlbumsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Album::class);
    }

    /**
     * Summary of getThumbnailFile
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Album $album
     * @return bool|string|null
     */
    protected function processThumbnailFile(Request $request, Album $album)
    {
        $file = $request->file('album_thumb');
        $filename = $album->id . '.' . $file->extension();
        $thumbnail = $file->storeAs(config('filesystems.album_thumbnails_dir'), $filename);

        return $thumbnail;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $queryBuilder = Album::orderBy('updated_at', 'DESC')
            ->withCount('photos')
            ->where('user_id', Auth::user()->id);

        if ($request->has("id")) {
            $queryBuilder->where("id", "=", $request->get("id"));
        }

        if ($request->has("album_name")) {
            $queryBuilder->where("album_name", "like", "%" . $request->get("album_name") . "%");
        }

        if ($request->has('category_id')) {
            $queryBuilder->whereHas('categories', fn($q) => $q->where('category_id', $request->category_id));
        }

        $albums = $queryBuilder->paginate(5);

        return view("albums.index", ['albums' => $albums]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('category_name')->get();
        $selectedCategories = [];
        return view('albums.create-album')->withAlbum(new Album())->with(compact('categories', 'selectedCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlbumRequest $request)
    {
        $data = $request->only(['album_name', 'description']);

        $album = new Album();
        $album->album_name = $data['album_name'];
        $album->description = $data['description'];
        $album->user_id = Auth::user()->id;
        $res = $album->save();

        if ($res) {
            if ($request->hasFile('album_thumb')) {
                $album->album_thumb = $this->processThumbnailFile($request, $album);
            }

            if ($request->has('categories')) {
                $album->categories()->attach($request->categories);
            }
        }

        $res = $album->save();

        $message = 'Album "' . $data['album_name'] . '" ';
        $message .= $res ? 'created.' : ' NOT created.';

        session()->flash('message', $message);

        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        return $album;
    }

    public function getPhotos(Album $album)
    {
        $photos = Photo::orderBy('updated_at', 'DESC')->whereAlbumId($album->id)->paginate(5);
        return view('photos.album-photos', compact('album', 'photos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        $categories = Category::orderBy('category_name')->get();
        $selectedCategories = $album->categories->pluck('id')->toArray();
        return view("albums.edit-album")->with(compact('album', 'categories', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlbumRequest $request, Album $album)
    {
        $data = $request->only(['album_name', 'description']);

        $album->album_name = $data['album_name'];
        $album->description = $data['description'];
        $res = $album->save();

        if ($res) {
            if ($request->hasFile('album_thumb')) {
                $album->album_thumb = $this->processThumbnailFile($request, $album);
            }

            if ($request->has('categories')) {
                $album->categories()->sync($request->categories);
            }
        }

        $res = $album->save();

        $message = 'Album "' . $album->album_name . '" ';
        $message .= $res ? 'updated.' : ' was not updated.';

        session()->flash('message', $message);

        return redirect()->route('albums.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        $thumbnail = $album->album_thumb;

        $res = +$album->delete();

        if ($thumbnail) {
            Storage::delete($thumbnail);
        }

        if (request()->ajax()) {
            return $res;
        }

        return redirect()->route('albums.index');
    }
}
