@extends('layouts.backend')

@section('content')
<h1>Edit category</h1>
<form action="{{ route('category.update', ['id'=>$category->id]) }}" method="POST">
    <label for="name">Name *</label>
    <input type="text" required name="name" class="form-control" value="{{ $category->name }}">
    <button class="btn" type="submit">Save</button>
    {{ csrf_field() }}
    {{ method_field('PUT') }}
</form>

@endsection