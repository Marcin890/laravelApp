<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','FrontendController@index')->name('home');
Route::get('/memsbyuser/{user_id}','FrontendController@memsByUser')->name('memsbyuser');

Route::get('mem'.'/{id}','FrontendController@mem')->name('mem');

Auth::routes();

Route::get('/like/{mem_id}', 'FrontendController@like')->name('like');
Route::get('/unlike/{mem_id}', 'FrontendController@unlike')->name('unlike');

 
Route::post('/addComment/{mem_id}', 'FrontendController@addComment')->name('addComment');
Route::get('/memsByCategory/{id}', 'FrontendController@memsByCategory')->name('memsByCategory');

Route::get('/printmem/{mem_id}','FrontendController@printmem')->name('printmem');


Route::group(['prefix'=>'admin', 'middleware' => 'auth'],function(){  

    Route::get('/','BackendController@addmem')->name('addmem');
     
   Route::get('addmem','BackendController@addmem')->name('addmem');
   Route::get('memstopublish','BackendController@memsToPublish')->name('memstopublish');
   Route::get('usermemslist','BackendController@userMemsList')->name('usermemslist');

   Route::post('savemem','BackendController@saveMem')->name('savemem');

   Route::get('publishmem'.'/{id}','BackendController@publishMem')->name('publishmem');

   Route::resource('category', 'CategoryController'); 

   Route::match(['GET', 'POST'],trans('routes.profile'),'BackendController@profile')->name('profile'); 
   
  });
  Auth::routes();