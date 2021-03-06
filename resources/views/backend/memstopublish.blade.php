@extends('layouts.backend')
@section('content')
        
       
<div class="row">
@foreach($mems as $mem)
<div class="col-md-6">
<div class="mem ">
    <div class="mem__user">
        <div class="mem__user-image-wrapper">
            <a href="{{ route('memsbyuser', ['id'=>$mem->user->id]) }}">
                <img class="mem__user-image" src="{{ $mem->user->photos->first()->path ?? null}}" alt="">
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

        <div class="mem__publish">
                 <a class="btn btn-md btn-primary" href="{{ route('publishmem', ['id'=>$mem->id]) }}" alt="">Publikuj</a>
         </div>
   
</div> 
</div>  
@endforeach
</div>
</div>
<div class="row">
    <div class="col-sm-12">{{$mems->links()}}</div>
</div>
</div>
@endsection