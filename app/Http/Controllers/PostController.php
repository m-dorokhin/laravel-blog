<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index($id)
    {
        $post = Post::find($id);

        if (!isset($post))
            return abort(404);

        return view('post')
            ->with('post', $post);
    }

    /**
     * Вывести форму редактора постов
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editor()
    {
        return view('editor');
    }

    /**
     * Сохранение поста
     *
     * @param Request $request
     * @return Response
     */
    public  function save(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->text = $request->text;
        $request->user()->posts()->save($post);

        return redirect('/');
    }
}
