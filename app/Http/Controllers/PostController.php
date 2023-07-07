<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //Al utilizar el middleware auth, Laravel verificará automáticamente 
    // si el usuario ha iniciado sesión antes de permitir el acceso a las 
    // rutas o métodos protegidos. Si el usuario no ha iniciado sesión, 
    // se redirigirá a la página de inicio de sesión.
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function __invoke()
    {

        $postsLat = Post::latest()->get();
        // dd($post);
        return view('dashboard', [
            'postsUser' =>$postsLat
        ]);
    }

    public function index(User $user)
    {

        // dd($user->id);
        $postsLat = Post::latest()->get();
        $posts = Post::where('user_id', $user->id)->latest()->paginate(6);
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts,
            'postsUser' =>$postsLat
        ]);
    }
    public function create(User $user)
    {
        if (auth()->user()->isAdmin) {
            return view('posts.create');
        }
        return view('dashboard', [
            'user' => $user,
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'imagen' => 'required',

        ]);
        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id,
        // ]);

        // otra forma de crear registros
        // $post = new Post;
        // $post ->titulo = $request -> titulo;
        // $post ->descripcion = $request -> descripcion;
        // $post ->imagen = $request -> imagen;
        // $post ->user_id = auth()->user()->id;
        // $post->save();

        // Otra forma con relacion
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('dashboard.index', auth()->user()->username);
    }
    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }
    public function destroy(User $user, Post $post)
    {
        $this->authorize('delete', $post);
        // $post->comentarios()->delete();
        $post->delete();

        // eliminar imagen
        $imagen_path = public_path('uploads/' . $post->imagen);
        if (File::exists($imagen_path)) {   
            unlink($imagen_path);
        }
        return redirect()->route('dashboard.index', auth()->user()->username);
    }
}
