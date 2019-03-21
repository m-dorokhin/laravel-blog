<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
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

        $post->load(['comments' => function($query)
        {
            $query->orderBy('created_at', 'asc');
        }]);

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

    public function comment(Request $request)
    {
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->text = $request->text;
        $request->user()->comments()->save($comment);

        return redirect(route('post', ['id' => $request->post_id]));
    }
}
