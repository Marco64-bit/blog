@extends('layouts.app')

@section('title')
    Create
@endsection

@section('content')
@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>

    </div>
@endif
    <form method="POST" action="{{route('posts.store')}}">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{old("title")}}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3">{{old("description")}}</textarea>
        </div>
        <div class="mb-3">
            <label for="post-creator" class="form-label">Post Creator</label>
            <select id="post-creator" class="form-select" name="post_creator" aria-label="Select Post Creator" >
                <option value="">Select...</option>
                @foreach($users as $user)
                    <option @selected(old('post_creator') == $user->id) value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
