<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Tag;
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

        $string_tags = array_map('trim', explode(PHP_EOL, $request->tags));
        $tags = Tag::whereIn('name', $string_tags)->get();
        if (count($tags) > 0) {
            $post->tags()->saveMany($tags);
            $exist_tags = array_column($tags->toArray(), 'name');
            $notexist_tags = array_diff($string_tags,
                $exist_tags);
        }
        else
        {
            $notexist_tags = $string_tags;
        }
        foreach ($notexist_tags as $tag)
        {
            $new_tag = new Tag();
            $new_tag->name = $tag;
            $post->tags()->save($new_tag);
        }

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
