@extends('layouts.backend')
@section('content')

<h2 class="category__title">Categories</h2>
<div class="category__link">
    <a href="{{ route('category.create') }}" class="btn btn-md btn-primary">Add category</a>
</div>

<span class="glyphicon glyphicon-remove"></span>

<div class="table-responsive">

    <table class="table table-hover">
        <tr>
            <th>Category name</th>
            <th>Edit</th>
        </tr>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>
                <a href="{{ route('category.edit', ['id'=>$category->id]) }}">Edit</a>
                
            </td>
        </tr>
        @endforeach
    </table>
</div>




@endsection