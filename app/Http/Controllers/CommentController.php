<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Subforum;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Subforum $subforum, Post $post)
    {
        //dd($post);
        return view('comments.create', ['post' => $post]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|max:1000',
            'user_id' => 'required|integer',
            'post_id' => 'required|integer',
            'subforum' => 'required|integer',
        ]);

        $p = new Comment;
        $p->content = $validatedData['content'];
        $p->user_id = $validatedData['user_id'];
        $p->post_id = $validatedData['post_id'];
        $p->save();

        session()->flash('message', 'Post was created.');

        //return redirect()->route('subforum.posts.show', ['post' => $validatedData['post_id']]);
        return redirect()->route('subforum.posts.show', ['subforum' => $validatedData['subforum'], 'post'=> $validatedData['post_id']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subforum $subforum, Post $post, Comment $comment)
    {
        return view ('comments.edit', ['subforum'=>$subforum, 'post'=>$post, 'comment'=>$comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        $validatedData = $request->validate([
            'content' => 'required|max:1000',
        ]);

        $comment->content = $validatedData['content'];
        $comment->update();  

        $post = Post::find($comment->post_id);

        return redirect()->route('subforum.posts.show', ['subforum'=>$post->subforum_id, 'post'=>$post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subforum $subforum, Post $post, Comment $comment)
    {
        //dd($comment);
        //$todelete = Comment::find($comment);
        $comment->delete();

        return redirect()->route('subforum.posts.show', ['subforum'=>$subforum, 'post'=>$post]);
    }
}
