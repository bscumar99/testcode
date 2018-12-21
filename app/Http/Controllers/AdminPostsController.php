<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //


        return view('admin.posts.create');
    }

    public function store(PostsCreateRequest $request)
    {
        //
        $input = $request->all();


        $user = Auth::user();


        if($file = $request->file('photo_id')){

          $name = time() . $file->getClientOriginalName();


          $file->move('images', $name);

          $photo = Photo::create(['file'=>$name]);


          $input['photo_id'] = $photo->id;

        }

        $user->posts()->create($input);


        return redirect('/admin/posts');

      }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
}
