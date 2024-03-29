@extends('layouts.app')
    @section('content')
    <h2>Make comment for {{ $post->title }}</h2>

    <div>
        <form method="POST" action="{{ route('comments.store') }}" class="mt-6 space-y-6">
            @csrf
            <div><p>Content: <textarea type="text" name="content" class="input-text-area-content"></textarea> </p></div>

            <div>
                <input type="hidden" name="user_id"
                    value="{{ Auth::id() }}"">
                <input type="hidden" name="post_id"
                    value="{{$post->id}}"">
                <input type="hidden" name="subforum"
                    value="{{$post->subforum_id}}"">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
    @endsection