<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Profile;
use Illuminate\Support\Facades\DB;
// import the Intervention Image Manager Class
use Intervention\Image\Facades\Image;


class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        // paginate 5 latests posts with relationship on user
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        // $profiles=DB::table('profiles')->get();
        $profiles=DB::table('profiles')->inRandomOrder()->limit(5)->get();;
        return view('posts/index', compact(['posts','profiles']));
    }

    public function create(){
        return view('posts/create');
    }

    public function store(){
        $data = request()->validate([
            'caption'=>'required',
            'image'=>'required|image',
        ]);
        $imagePath = request('image')->store('uploads','public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();
        auth()->user()->posts()->create([
            'caption'=> $data['caption'],
            'image'=>$imagePath,
        ]);
        return redirect('/profile/'.auth()->user()->id);
        // dd(request()->all());
    }

    public function show(\App\Post $post){
        //dd($post);
        return view('posts.show', compact('post'));
    }
}
