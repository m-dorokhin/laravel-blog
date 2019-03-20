<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($page=1)
    {
        if ($page < 1)
            $page = 1;

        $count = App\Post::all()->count();

        $take = 10;
        $count_pages = ceil($count / $take);
        if ($page > $count_pages)
            $page = $count_pages;

        $skip = ($page-1)*$take;

        $posts = App\Post::orderBy('created_at', 'desc')
            ->skip($skip)
            ->take($take)
            ->with('user')
            ->get();

        return view('home')
            ->with('posts', $posts)
            ->with('page', $page)
            ->with('count', $count_pages);
    }
}
