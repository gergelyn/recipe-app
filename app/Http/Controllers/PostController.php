<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCoverImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('posts')
                    ->join('post_cover_images', 'posts.id', '=', 'post_cover_images.post_id')
                    ->select('*')
                    ->latest('posts.created_at')
                    ->paginate(9);
        return view('posts.index')
            ->with('posts', $posts)
            ->with('title', 'Blog');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('title', 'Blog írása');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $title = $request->title;
        $body = $request->body;
        $image = $request->image;

        $post = Post::create([
            'title' => $title,
            'body' => $body,
            'user_id' => auth()->user()->id
        ]);

        // Post::create($request->all());

        
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'), $imageName);
        // $imagePath = Storage::disk('local')->put('/posts', $image);
        PostCoverImage::create([
            'post_image_path' => '/images/' . $imageName,
            'post_image_caption' => $title,
            'post_id' => $post->id
        ]);

        return redirect('/posts')
            ->with('title', 'Blog')
            ->with('status', 'Sikeres posztolás!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $image = PostCoverImage::find($post->id);
        return view('posts.show')
            ->with(compact('post'))
            ->with('image', $image)
            ->with('title', $post->title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('status', 'Nem elérhetô');
        }
        return view('posts.edit', compact('post'))->with('title', 'Poszt szerkesztése');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $image = PostCoverImage::find($post->id);

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        if ($request->hasFile('image')) {
            unlink(public_path().$image->post_image_path);
            $newImageReq = $request->image;
            $imageName = time().'.'.$newImageReq->extension();
            $newImageReq->move(public_path('images'), $imageName);
            $image->update([
                'post_image_path' => '/images/' . $imageName,
                'post_image_caption' => $request->title,
            ]);
        }
        
        return redirect('/posts')
            ->with('title', 'Blog')
            ->with('status', 'Sikeres poszt szerkesztés!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('status', 'Nem elérhetô!');
        }

        $image = PostCoverImage::find($post->id);
        unlink(public_path().$image->post_image_path);
        $image->delete();
        $post->delete();
        return redirect('/posts')
            ->with('title', 'Blog')
            ->with('status', 'Sikeres poszt törlés!');
    }
}
