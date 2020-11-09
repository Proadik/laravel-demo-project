<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function index_page (Request $request) {

        $posts = Post::query();
        $q = $request->get('q');

        if($request->has('q')) {
            $posts->where('title', 'like', '%'.$q.'%')->orWhere('content', 'like', '%'.$q.'%');
        }

        $posts = $posts->latest()->paginate(8);
        return view('pages.index', compact('posts'));
    }

}
