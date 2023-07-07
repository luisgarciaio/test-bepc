@extends('layouts.app')

@section('titulo')
    Registro
@endsection

@section('contenido')
    <div class="md:flex justify-center md:gap-10  md:items-center">
        <div class="md:w-1/3 p-5">
            <img src="{{asset('img/usuario.svg')}}" alt="Imagen de registrar">
        </div>
        <div class="md:w-4/12 p-6 bg-white rounded-lg shadow-xl">
            <form action={{route('register')}} method="POST">
                @csrf
                <div class="mb-2">
                    <label 
                    for="name" 
                    class=" mb-2 block uppercase text-gray-500 font-bold" >
                        Nombre
                    </label>
                    <input 
                    id="name" 
                    name="name" 
                    type="text" 
                    placeholder="Tu nombre"
                    class="border p-3 w-full rounded-lg @error('name')
                        border-red-500
                    @enderror"
                    value="{{old('name')}}"
                    />
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg p-2 text-center">
                        {{$message}}    
                        </p>
                    @enderror
                </div>
                <div class="mb-5 ">
                    <label 
                    for="username" 
                    class="mb-2 block uppercase text-gray-500 font-bold" >
                        Username
                    </label>
                    <input 
                    id="username" 
                    name="username" 
                    type="text" 
                    placeholder="Tu nombre de usuario"
                    class="border p-3 w-full rounded-lg
                    @error('name')
                        border-red-500
                    @enderror"
                    value="{{old('username')}}"
                    />
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg p-2 text-center">
                        {{$message}}    
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label 
                    for="email" 
                    class="mb-2 block uppercase text-gray-500 font-bold" >
                        E-mail
                    </label>
                    <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    placeholder="Tu E-mail"
                    class="border p-3 w-full rounded-lg
                    @error('username')
                    border-red-500
                @enderror"
                value="{{old('email')}}"
                />
                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg p-2 text-center">
                    {{$message}}    
                    </p>
                @enderror
                </div>

                <div class="mb-5">
                    <label 
                    for="password" 
                    class="mb-2 block uppercase text-gray-500 font-bold" >
                        Password
                    </label>
                    <input 
                    id="password" 
                    name="password" 
                    type="password" 
                    placeholder="Password de registro"
                    class="border p-3 w-full rounded-lg 
                    @error('password')
                    border-red-500
                @enderror"
                />
                @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg p-2 text-center">
                    {{$message}}    
                    </p>
                @enderror
                </div>

                <div class="mb-5">
                    <label 
                    for="password_confirmation" 
                    class="mb-2 block uppercase text-gray-500 font-bold" >
                        Repetir Password
                    </label>
                    <input 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    placeholder="Repite tu password"
                    class="border p-3 w-full rounded-lg"
                    >
                </div>
                <div class="mb-5">
                    <input type="checkbox" name="isAdmin" value="true">
                    <label class="text-sm text-gray-500">Es administrador?</label>
                </div>
                <input 
                type="submit"
                value="Crear cuenta"
                class="bg-sky-600 hover:bg-sky-700 transition-colors 
                rounded-md
                cursor-pointer font-bold uppercase p-3 w-full text-white"
                >
            </form>
        </div>
    </div>
@endsection
