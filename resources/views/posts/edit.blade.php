@extends('layouts.app')

@section('title')
    Edit
@endsection

@section('content')
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    {{$error}}
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{route('posts.update', $post->id)}}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{$post->title}}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description"
                      rows="3">{{$post->description}}</textarea>
        </div>
        <div class="mb-3">
            <label for="post-creator" class="form-label">Post Creator</label>
            <select id="post-creator" class="form-select" name="post_creator" aria-label="Select Post Creator">
                @foreach($users as $user)
                    {{--                    <option @if($user->id == $post->user_id) selected--}}
                    {{--                            @endif value="{{$user->id}}">{{$user->name}}</option> Same as below --}}
                    <option @selected($user->id == $post->user_id) value="{{$user->id}}">{{$user->name}}</option>

                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
