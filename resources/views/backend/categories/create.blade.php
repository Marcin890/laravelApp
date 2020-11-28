@extends('layouts.backend')
@section('content')
<h1>Create new category</h1>
<form action="{{ route('category.store') }}" method="POST">
<label for="name" class="form-label">Name*</label>
<input type="text" class="form-control" name="name" required>
<button class="btn" type="submit">Create</button>
{{ csrf_field() }}
</form>
@endsection