@extends('layouts.backend')
@section('content')
<h2>Profile</h2>

@if($user->photos->first())
<div class="mem__user-image-wrapper mem__user-image-wrapper--profile ">
    <img class="img-fluid" src="{{ $user->photos->first()->path}}" alt="...">
</div>

@endif
<form {{ $novalidate }}  action="{{ route('profile') }}" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name" class="control-label">Name *</label>
        <input type="text" class="form-control" name="name" required id="name" value={{ $user->name }}>
    </div>
    <div class="form-group">
        <label for="email" class="control-label">Email *</label>
        <input type="text" class="form-control" name="email" id="email" required value={{ $user->email }}>
    </div> 
    <div class="form-group">
        <button class="btn btn-lg btn-primary" type="submit">Save</button>
    </div>
    <div class="form-group">
        <label for="userPicture">Add photo</label>
        <input name="userPicture" type="file" id="userPicture">
    </div>
{{ csrf_field() }}
</form>



@endsection