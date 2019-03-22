<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($page=1)
    {
        if ($page < 1)
            $page = 1;

        $count = Post::all()->count();

        $take = 10;
        $count_pages = ceil($count / $take);
        if ($page > $count_pages)
            $page = $count_pages;

        $skip = ($page-1)*$take;

        $posts = Post::orderBy('created_at', 'desc')
            ->skip($skip)
            ->take($take)
            ->with('user')
            ->get();

        return view('home')
            ->with('title', 'Все публикации')
            ->with('posts', $posts)
            ->with('page', $page)
            ->with('count', $count_pages);
    }

    public function tag($tag_id, $page=1)
    {
        if ($page < 1)
            $page = 1;

        $tag = Tag::find($tag_id);
        if (!isset($tag))
            return abort(404);

        $count = Tag::find($tag_id)->posts->count();

        $take = 10;
        $count_pages = ceil($count / $take);
        if ($page > $count_pages)
            $page = $count_pages;

        $skip = ($page-1)*$take;

        $posts = Tag::find($tag_id)->posts()
            ->orderBy('created_at', 'desc')
            ->skip($skip)
            ->take($take)
            ->with('user')
            ->get();

        return view('home')
            ->with('title', 'Публикации с тегом: '.$tag->name)
            ->with('posts', $posts)
            ->with('page', $page)
            ->with('count', $count_pages);
    }
}
