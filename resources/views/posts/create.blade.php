@extends('layouts.app')

@section('content')
    <div class="mx-auto w-1/2">
        <h1 class="text-lg font-bold mb-6 text-yellow-600">Blog posztolása</h1>
    {{--    <a href="{{ route('posts.index') }}" class="rounded-full bg-blue-600 text-white px-4 py-2">Vissza</a>--}}
        @if ($errors->any())
            <div class="bg-red-600 text-white w-1/3">
                <strong>Error!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="image">Poszt képe</label>
                <input id="image" type="file" name="image" accept="image/*">
            </div>
            <div class="mb-4">
                <label for="title">Cím</label>
                <input id="title" type="text" name="title" class="border-2 border-black rounded-md">
            </div>
            <div class="mb-4">
                <label for="body">Szöveg</label>
                <textarea id="body" name="body" class="ckeditor border-2 border-black rounded-md" rows="5"></textarea>
            </div>

            <button type="submit" class="m-auto p-3 border border-yellow-600 bg-yellow-600 rounded-full text-white hover:border-yellow-700 hover:bg-yellow-700 mt-2">Posztolás</button>
        </form>
    </div>
@endsection

@section('script')
    <script src="//cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".ckeditor").ckeditor();
        });

    </script>
@endsection
