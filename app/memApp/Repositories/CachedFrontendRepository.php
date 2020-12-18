<?php
namespace App\memApp\Repositories; 
use App\{Mem, Like, Comment, Category, User}; 
use App\memApp\Interfaces\FrontendRepositoryInterface; 
use Illuminate\Support\Facades\Cache;

class CachedFrontendRepository extends FrontendRepository implements FrontendRepositoryInterface {
    public function getAllMems()
    {
       
        return Mem::where([
            ['published', true]            
            ] )->with(['user', 'likes.user', 'category', 'photos' ])->orderByDesc('updated_at')->paginate(8);
    }


    public function getMemsByCategory($id) {
        return Mem::where([
            ['published', true],
            ['category_id', $id]
                  
            ] )->with(['user', 'likes.user', 'category', 'photos' ])->orderByDesc('id')->paginate(8);

    }

    public function getCategory($id) {
        return Category::find($id);
    }

    public function getUser($id) {
        return User::find($id);
    }

    public function getMem($id)
    {

        return Mem::with(['user', 'comments', 'photos'])->find($id);
    }

    public function like($mem_id,  $request)
    { 
        $like = new Like;
        $like->mem_id = $mem_id;
        $like->user_id = $request->user()->id;
        $like->timestamps = false;
        $like->save();
     }

     public function unlike($mem_id, $request)
     { 
        $user_id = $request->user()->id;

         $like = Like::where([
             ['mem_id', $mem_id], 
             ['user_id', $user_id]
             ] )->delete();   
      }


      public function addComment($mem_id, $request)
     {
          
         $comment = new Comment;
  
         $comment->content = $request->input('content');
        
         $comment->user_id = $request->user()->id;

         $comment->mem_id = $mem_id;
         $comment->timestamps = false;
         
         $comment->save();
     }

     public function getMemsByUser($user_id) {
      
        return Mem::where([
            ['user_id', $user_id]            
            ] )->with(['photos'])->orderByDesc('id')->paginate(8);

     }
    
}