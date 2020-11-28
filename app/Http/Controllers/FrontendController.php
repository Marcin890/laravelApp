<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mem;
use Illuminate\Support\Facades\Auth;
use App\memApp\Repositories\FrontendRepository;
use Barryvdh\DomPDF\Facade as PDF;

class FrontendController extends Controller
{

    public function __construct(FrontendRepository $fR) {
        $this->fR = $fR;

        $this->middleware('auth')->only(['like','unlike']); 

    }
    public function index() {
        $mems = $this->fR->getAllMems();
       

        return view('frontend.index', ['mems'=>$mems]);
    }

    public function memsByCategory($id) {
        $category = $this->fR->getCategory($id);
        $mems = $this->fR->getMemsByCategory($id);       

        return view('frontend.index', ['mems'=>$mems, 'category'=>$category]);
    }

    public function memsByUser($user_id)  {
            $user = $this->fR->getUser($user_id);
            $mems = $this->fR->getMemsByUser($user_id);
            return view('frontend.index', ['mems'=> $mems, 'user'=>$user]);       
    }


    public function mem($id) {
        $mem = $this->fR->getMem($id); 
        return view('frontend.mem', ['mem'=>$mem]);
    }

    public function like($mem_id, Request $request)
    {
        $this->fR->like($mem_id, $request);

        // Powrót do strony
        return redirect()->back();
    }
    public function unlike($mem_id, Request $request)
    {
        $this->fR->unlike($mem_id, $request);

        // Powrót do strony
        return redirect()->back();
    }


    public function addComment($mem_id, Request $request)
    {

        $this->validate($request,[
            'content'=>"required|string"
        ]);

        $this->fR->addComment($mem_id,  $request);
        
        return redirect()->back();
    }


    public function printmem($id) 
    {
        
        $mem = $this->fR->getMem($id); 
        $pdf = PDF::loadView('print.printmem', ['mem'=>$mem]);
        return $pdf->stream('invoice.pdf');
     
    }


 }