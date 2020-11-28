<?php

namespace App\memApp\ViewComposers;

use Illuminate\View\View; 

use App\{Category, Mem}; 
use Illuminate\Support\Facades\Auth;


 /* Lecture 49 */
class FrontendComposer
{


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', Category::all()->sortBy('name'));

         

        $popularmems = Mem::withCount('likes')->orderByDesc('likes_count')->take(5)->get();

        $view->with('popularmems', $popularmems);
    }
}