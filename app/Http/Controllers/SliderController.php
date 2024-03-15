<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SliderController extends Controller
{
    //
    public function viewsliderspage(){
        return view('admin.sliders');
    }
    public function vieweditsliderspage(){
        return view('admin.editsliders');
    }
    public function viewaddsliderspage(){
        return view('admin.addsliders');
    }

    public function viewservicespage(){
        return view('admin.services');
    }
    public function viewaddservicepage(){
        return view('admin.addservice');
    }
    public function vieweditservicepage(){
        return view('admin.editservice');
    }
    
}
