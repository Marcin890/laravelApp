@extends('layouts.backend')
@section('content')
<h2>Add mem</h2>
<div class="row">
    <div class="col-md-12">
        <form {{ $novalidate }} action="{{ route('savemem') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        <fieldset>
            <div class="form group">
                <label for="category" class="control-label">Category *</label>
                <select name="category" id="category" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
               
            </div>
            <div class="form-group">
                <label for="title" class="control-label">Title *</label>
                <input type="text" name="title" required class="form-control" id="title">
            </div>

            <div class="form-group">
                <label for="photo" class="control-label">Add Your Photo *</label>
                <input type="file" name="photo" required class="form-control" id="photo">
            </div>

            <div class="form-group">
                <button class="btn btn-lg btn-primary" type="submit">Save</button>
            </div>

        </fieldset>
            {{ csrf_field() }}
        </form>

    </div>
</div>
@endsection