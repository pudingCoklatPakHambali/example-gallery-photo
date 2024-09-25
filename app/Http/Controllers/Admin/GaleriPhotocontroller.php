<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Helpers\Category;
use Iluminate\Support\Facedes\Auth;

class GaleriPhotocontroller extends Controller
{
    public function index()
    {
        return view('admin.galeri-photo.index', [
        'pageTitle' => 'Galeri photo',
        'listPost' => Post::all(),
       ]);
    }

    public function create()
    {

        return view('admin.galeri-photo.create',[
        'pageTitle'         =>'create Galeri ',
        'listCategory'      => Category::categories
    ]);
    }

    public function store(Request $request)
    {

            $validated = $request->validate([
            'title'       => 'required',
            'category'    => 'required',
            'description' => 'required'
        ],[
            'title.required'   => 'Isi we ',
            'description.required'   => 'Isi we '
        ]);

        // dd($validated);
        $post = Post::create([
            'title' =>$validated['title'],
            'category'=>$validated['category'],
            'description' => $validated['description'],
            'user_id' =>auth()->user()->id
        ]);
        return redirect(route('admin-galeri-dashboard', absolute: false));
        // dd($post);
        // return redirect();
    }

        public function edit(string $postid)
    {
        $post = post::findOrfail($postid);

        //mengembalikan ke halaman edit
        return view('admin.galeri-photo.edit', [
            'pageTitle' => 'Edit Album',
            'post'      => $post,
            'listCategory'      => Category::categories
        ]);
        // dd('mau edit galeri photo..',$post);
    }

}
