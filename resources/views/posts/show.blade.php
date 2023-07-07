@extends('layouts.app')
@section('titulo')
    {{ $post->titulo }}
@endsection
@section('contenido')
    <div class="container mx-auto md:flex ">
        <div class="md:w-1/2 md:flex p-10">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">

            <div>
                <div class=" md:pl-20">
                    {{-- <p class="font-bold">{{ $post->user->username }}</p> --}}
                    <a href="{{ route('dashboard.index', $post->user->username) }}"
                        class="font-bold">{{ $post->user->username }}</a>
                    <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                    <p class="mt-5">{{ $post->descripcion }}</p>
                </div>
    
                @auth
                    @if ($post->user_id === auth()->user()->id)
                        <form class="px-10" action="{{ route('posts.destroy', $post) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="submit" value="Eliminar publicación"
                                class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4">
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>
@endsection
