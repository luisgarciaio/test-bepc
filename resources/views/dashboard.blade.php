@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}
@endsection


@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-1/2 px-5">
                <img src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg') }}"
                    alt="Imagen del usuario">
            </div>
            <div class="w-8/12 lg:w-1/2 px-5 flex flex-col items-center py-10 md:items-start md:justify-center">
                <div class="flex items-center gap-3">
                    <p class="text-2xl text-gray-700 ">{{ $user->username }}</p>

                </div>
                @auth

                    @if (auth()->user()->isAdmin === 1)
                        <p class="text-gray-800 text-sm mb-3 font-bold">
                            {{ $user->posts()->count() }}

                            <span class="font-normal">Posts</span>
                        </p>
                    @else
                        <p class="text-gray-800 text-xl mb-3 font-bold">No puedes crear posts, tienes que ser admin</p>
                    @endif

                @endauth
            </div>
        </div>
    </div>
    @auth
        @if (!auth()->user()->isAdmin)
            <section class="container mx-auto mt-10">
                <h2 class="text-4xl text-center font-black my-10">Ver publicaciones de administradores</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
                    @foreach ($postsUser as $post)
                        <a href="{{ route('posts.show', [$user, $post]) }}">
                            <div>
                                <p class="text-2xl text-center font-black ">{{ $post->titulo }}</p>
                                <img src="{{ asset('uploads/' . $post->imagen) }}" alt="Imagen del post {{ $post->titulo }}">

                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @else
            <section class="container mx-auto mt-10">
                <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
                    @foreach ($posts as $post)
                        <a href="{{ route('posts.show', [$user, $post]) }}">
                            <div>
                                <p class="text-2xl text-center font-black ">{{ $post->titulo }}</p>
                                <img src="{{ asset('uploads/' . $post->imagen) }}" alt="Imagen del post {{ $post->titulo }}">

                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    @endauth
@endsection
