<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\memApp\Repositories\BackendRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 


class BackendController extends Controller
{

   public function __construct(BackendRepository $bR) {
      $this->middleware('CheckOwner')->only(['publishMem']);
      $this->bR = $bR;
   }
   public function addmem() {
   $categories = $this->bR->getAllCategories();

    return view('backend.addmem', ['categories'=>$categories]);
   } 

   public function saveMem(Request $request)
   {    

      $mem = $this->bR->saveMem($request);
      $path = $request->file('photo')->store('mems', 'public');  
      $this->bR->createMemPhoto($mem,$path);          
      return redirect('/');
   }

   public function memsToPublish() {
      
      $mems = $this->bR->getAllMems();
      return view('backend.memstopublish', ['mems'=>$mems]);
   }

   public function publishMem($id) {
      // dd('aa');
      $this->bR->publishMem($id);
      return redirect('/');
   }

   public function profile(Request $request) {

     

      if($request->isMethod('post')) 
      {
        
         $user = $this->bR->saveUser($request);
         

         if ($request->hasFile('userPicture'))
         {
                        
            $path = $request->file('userPicture')->store('users', 'public');

            if (count($user->photos) != 0) 
            {
               $photo = $this->bR->getPhoto($user->photos->first()->id);

               Storage::disk('public')->delete($photo->storagepath);
               $photo->path = $path;

               $this->bR->updateUserPhoto($user,$photo);
               
            }
            else {
               $this->bR->createUserPhoto($user, $path);

            }

         }

         return redirect()->back();
      }
       return view('backend.profile', ['user'=>Auth::user()]);
   }

   public function userMemsList(Request $request) {
      
      $mems = $this->bR->getMemsByUser(Auth::user());
       return view('backend.usermemslist', ['mems'=> $mems]);
   }
}