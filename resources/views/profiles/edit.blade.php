@extends('layouts.app')

@section('content')
<div class="container">
<form method="post" action="/profile/{{$user->id}}" enctype="multipart/form-data" accept-charset="utf-8" name="post" >
        @csrf
        @method('PATCH')
        <div class="col-8 offset-2">

        <div class="row">
            <h1>Edit Profile</h1>
        </div>
        <div class="row">
            <label for="title" class="col-md-4 col-form-label">Title</label>
            <input id="title" type="text" 
            class="form-control @error('title') is-invalid @enderror" 
            name="title" 
            value="{{ old('title') ?? $user->profile->title }}" autofocus>

            @error('title')
                <strong class="text-danger">{{ $message }}</strong>
            @enderror
        </div>

        <div class="row">
            <label for="description" class="col-md-4 col-form-label">Description</label>
            <input id="description" type="text" 
            class="form-control @error('description') is-invalid @enderror" 
            name="description" 
            value="{{ old('description') ?? $user->profile->description}}" autofocus>

            @error('description')
                <strong class="text-danger">{{ $message }}</strong>
            @enderror
        </div>

        <div class="row">
            <label for="url" class="col-md-4 col-form-label">URL</label>
            <input id="url" type="text" 
            class="form-control @error('url') is-invalid @enderror" 
            name="url" 
            value="{{ old('url') ?? $user->profile->url}}" autofocus>

            @error('url')
                <strong class="text-danger">{{ $message }}</strong>
            @enderror
        </div>

        <div class="row">
            <label for="image" class="col-md-4 col-form-label">Profile Image</label>
            <input type="file" class="form-control-file" id="image" name="image">

            @error('image')
                <strong class="text-danger">{{ $message }}</strong>
            @enderror
        </div>

        <div class="row pt-4">
            <button class="btn btn-primary">Save Profile</button>
        </div>
        </div><!--col-8 offset-2-->
    </form>
</div>
@endsection
