<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = Album::with('categories')->latest();
        return view("gallery.albums", [
            'albums' => $albums->paginate(8),
            'category_id' => null
        ]);
    }

    public function showAlbumPhotos(Album $album)
    {
        $photos = Photo::whereAlbumId($album->id)->latest();
        return view("gallery.photos", ['photos' => $photos->paginate(8), 'album' => $album]);
    }

    public function showCategoryAlbums(Category $category)
    {
        $albums = $category->albums()->with('categories')->latest();
        return view("gallery.albums", [
            'albums' => $albums->paginate(8),
            'category_id' => $category->id
        ]);
    }
}
