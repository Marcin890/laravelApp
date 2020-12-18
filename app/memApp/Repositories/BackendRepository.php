<?php
namespace App\memApp\Repositories; 
use App\{Mem, Category, User, Photo}; 

class BackendRepository {
    use \Illuminate\Foundation\Validation\ValidatesRequests; 
    
    public function saveMem($request)
    {   
        
        $this->validate($request, [
            'title'=>"string|required",
            'category'=>"string|required",
            
        ]); 
        
        $mem = new Mem;  
        $mem->title = $request->input('title');       
        $mem->user_id = $request->user()->id;
        $mem->published = false;
        if($request->user()->hasRole(['admin'])) {
            $mem->published = true; 
        }
         $mem->category_id = $request->input('category');      
        $mem->save(); 
        
        return $mem;
        
    }

    public function createMemPhoto($mem, $path) {
        $photo = new Photo;
        $photo->path = $path;
        $mem->photos()->save($photo);
    }

    public function getAllMems()
    {

        return Mem::where([
            ['published', false]            
            ] )->with(['user', 'likes.user', 'photos'])->orderByDesc('id')->paginate(8);
    }

    public function getMemsByUser($user) {
      
        return Mem::where([
            ['user_id', $user->id]            
            ] )->with(['photos'])->orderByDesc('id')->paginate(8);

     }

    public function publishMem($id) {
        return Mem::find($id)->update(['published' => true]);;
         
    }

    public function getAllCategories() {
        return Category::all()->sortBy('name');
    }

    public function deleteCategory($id) {
         return Category::where('id', $id)->delete();
    }


    public function createCategory($request) {
        $this->validate($request, [
            'name'=>'required|string|unique:categories',
        ]);

        return Category::create([
            'name' => $request->input('name')
        ]);
    }

    public function getCategory($id) {
        return Category::find($id);
    }


    public function updateCategory($request, $id) {
        return Category::where('id', $id)->update([
            'name' => $request->input('name')
        ]);
    }

    public function saveUser($request) {
        $this->validate($request,[
            'name'=>'required|string',
            'email'=>'required|email',
        ]);

       
         if($request->hasFile('userPicture'))
        {
            
            $this->validate($request,[
                'userPicture'=>"image|max:3000",             
            ]);
        }

      
        
        $user = User::find($request->user()->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return $user;
    }

    public function createUserPhoto($user, $path) {
        $photo = new Photo;
        $photo->path = $path;
        $user->photos()->save($photo);
    }
    public function getPhoto($id)
    {
        return Photo::find($id);
    }

    public function updateUserPhoto(User $user,Photo $photo) {
        return $user->photos()->save($photo);
    }
}