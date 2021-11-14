@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        
        <div class="w-4/12 p-6">
            @if (session('status'))
                <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="sr-only">E-mail</label>
                    <input type="email" name="email" id="email" placeholder="E-mail cím" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="password" class="sr-only">Jelszó</label>
                    <input type="password" name="password" id="password" placeholder="Jelszó" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror" value="">
                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2">
                        <label for="remember">Emlékezz rám</label>
                    </div>
                </div>

                <button type="submit" class="p-3 border border-yellow-600 bg-yellow-600 rounded-full text-white hover:border-yellow-700 hover:bg-yellow-700 mt-2 w-full">Bejelentkezés</button>
            </form>
        </div>
    </div>
    
@endsection