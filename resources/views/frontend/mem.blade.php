@extends('layouts.frontend')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">                
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
                  
                    <div class="mem__image-wrapper">
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

                <div class="print d-flex">
                    <a class="btn btn-primary ml-auto" href="{{ route('printmem', ['id'=>$mem->id]) }}">Print mem</a>
                </div>

                <!--Comments -->
                <div class="comments">
                    @auth
                        <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Add comment
                         </a>
                     @else
                         <p>
                             <a href="{{ route('login') }}">Login to add a comment</a>
                        </p>
                    @endauth


                    <div class="collapse" id="collapseExample">
                        <div class="well">
                             <form method="POST" action="{{ route('addComment',['mem_id'=>$mem->id])}}" class="form-horizontal">
                                <fieldset>
                                     <div class="form-group">
                                         <label for="textArea" class="col-lg-2 control-label">Comment</label>
                                             <div class="col-lg-10">
                                                  <textarea required name="content" class="form-control" rows="3" id="textArea"></textarea>
                                                  <span class="help-block">Add a comment about this mem.</span>
                                            </div>
                                        </div>                            
                                            <div class="form-group">
                                                <div class="col-lg-10 col-lg-offset-2">
                                                 <button type="submit" class="btn btn-primary">Send</button>
                                                 </div>
                                            </div>
                                 </fieldset>
                                {{ csrf_field() }} <!-- Lecture 25 -->
                            </form>
                        </div>
                    </div>
                    
                        <h2 class="comments__title">Comments</h2>                        
                        @foreach ($mem->comments as $comment)
                        <div class="comment">
                            <div class="comment__user">
                                <div class="comment__user-image-wrapper">
                                    <a href="{{ route('memsbyuser', ['id'=>$comment->user->id]) }}">
                                        <img class="comment__user-image" src="{{ $comment->user->photos->first()->path ?? $user_placeholder }}" alt="">
                                    </a>   
                                </div>
                                <div class="comment__user-name">
                                    <a href="{{ route('memsbyuser', ['id'=>$comment->user->id]) }}">
                                        {{ $comment->user->name }}
                                    </a>            
                                </div>
                            </div>
                            
                            <p>{{ $comment->content }}</p>
                        </div>
                        
                        
                        @endforeach
                    
                </div>
            </div>

        </div>
 
    </div>

 @endsection