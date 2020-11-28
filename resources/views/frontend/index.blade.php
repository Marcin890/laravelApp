@extends('layouts.frontend')
@section('content')
     
@if($category ?? null)
    <h2>Category: {{ $category->name }}</h2>
@endif

@if($user ?? null)
    <h2>User: {{ $user->name }}</h2>
@endif
@foreach($mems  as $mem) 
{{-- {{ dd($mem) }} --}}
<div class="mem">
    <div class="mem__user">
        <div class="mem__user-image-wrapper">
            <a href="{{ route('memsbyuser', ['id'=>$mem->user->id]) }}">
                <img class="mem__user-image" src="{{ $mem->user->photos->first()->path ?? $user_placeholder }}" alt="">
            </a>   
        </div>
        <div class="mem__user-name">
            <a href="{{ route('memsbyuser', ['id'=>$mem->user->id]) }}">
                {{ $mem->user->name }}
            </a>            
        </div>
    </div>


        <h2 class="mem__title"> 
            <a  class="mem__title-link" href="{{ route('mem', ['id'=>$mem->id]) }}" alt="">{{ $mem->title }}</a>
        </h2>
        
        <p class="mem__category">
            <a href="{{ route('memsByCategory', ['id'=>$mem->category->id]) }}" class="mem__category-link">{{ $mem->category->name }}</a>
            
        </p>
  
        <div>
            <a href="{{ route('mem', ['id'=>$mem->id]) }}" alt="">
            <img src="{{ $mem->photos->first()->path ?? null }}" alt="" class="img-full">
            </a>
        </div>
     
    <div class="mem__likes">        
        @auth
          @if( $mem->isLiked() )
             <div class="mem__likes-button-wrapper"><a href="{{ route('unlike', ['id'=>$mem->id])}}" class="btn btn-primary keep_position">Unlike</a></div> 
         @else
              <div class="mem__likes-button-wrapper"><a href="{{ route('like', ['id'=>$mem->id])}}" class="btn btn-primary keep_position">Like</a></div> 
          @endif  
          @else
             <div class="mem__likes-button-wrapper"><a href="{{ route('login') }}">Login to like</a></div>
          @endauth      

          <div class="mem__likes-count">
            Likes: {{ $mem->likes->count  () }}
        </div>
         
    </div> 
    


</div>
@endforeach




<div class="row">
    <div class="col-sm-12">{{$mems->links()}}</div>
</div>



@endsection