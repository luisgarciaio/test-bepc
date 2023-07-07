<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PublicacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function __invoke()
    {
        $posts = Post::latest()->all();
        return view('auth.login');
    }
    
}
