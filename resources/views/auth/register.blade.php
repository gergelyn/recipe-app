@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 p-6">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="sr-only">Név</label>
                    <input type="text" name="name" id="name" placeholder="Név" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" value="{{ old('name') }}">
                    @error('name')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
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
                    <label for="password_confirmation" class="sr-only">Jelszó újra</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Jelszó újra" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password_confirmation') border-red-500 @enderror" value="">
                    @error('password_confirmation')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                

                <button type="submit" class="p-3 border border-yellow-600 bg-yellow-600 rounded-full text-white hover:border-yellow-700 hover:bg-yellow-700 mt-2 w-full">Regisztráció</button>
            </form>
        </div>
    </div>
    
@endsection