<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toplevelcategory;
use App\Models\Midlelevelcategory;
use App\Models\Endlevelcategory;

class CategoryController extends Controller
{
    //
    public function viewtoplevelcategorypage(){
        $toplevelcategories = Toplevelcategory::get();
        $increment = 1;
        
        return view('admin.toplevelcategory')->with('toplevelcategories', $toplevelcategories)->with("increment", $increment);
    }
    public function viewaddtoplevelcategorypage(){
        return view('admin.addtoplevelcategory');
    }
    public function viewedittoplevelcategorypage($id){
        $toplevelcategory = Toplevelcategory::find($id);
        return view('admin.edittoplevelcategory')->with('toplevelcategory', $toplevelcategory);
    }
    public function viewmidlevelcategorypage(){
        $midlevelcategories = Midlelevelcategory::get();
        $increment = 1;
        
        return view('admin.midlevelcategory')->with('midlevelcategories', $midlevelcategories)->with("increment", $increment);
    }

    public function viewaddmidlevelcategorypage(){
        $toplevelcategories = Toplevelcategory::get();
        $increment = 1;
        
        return view('admin.addmidlevelcategory')->with('toplevelcategories', $toplevelcategories)->with("increment", $increment);

        
    }
    public function vieweditmidlevelcategorypage($id){
        $midlevelcategory = Midlelevelcategory::find($id);
        $toplevelcategories = Toplevelcategory::where('tcat_name', '!=', $midlevelcategory->tcat_id)->get();
        return view('admin.editmidlevelcategory')->with('midlevelcategory', $midlevelcategory)->with('toplevelcategories', $toplevelcategories);
    }

    
    public function viewendlevelcategorypage(){

        $endlevelcategories = Endlevelcategory::get();
        $increment =1;
        

        return view('admin.endlevelcategory')->with('endlevelcategories', $endlevelcategories)->with('increment', $increment);
    }
    public function viewaddendlevelcategorypage(){
        $toplevelcategories = Toplevelcategory::get();
        $midlevelcategories = Midlelevelcategory::get();
        return view('admin.addendlevelcategory')->with('toplevelcategories', $toplevelcategories)->with('midlevelcategories', $midlevelcategories);
    }

    public function saveendlevelcategory(Request $request){
        $endlevelcategory = new Endlevelcategory();
        $endlevelcategory->tcat_id = $request->input('tcat_id');
        $endlevelcategory->mcat_id = $request->input('mcat_id');
        $endlevelcategory->ecat_name = $request->input('ecat_name');

        $endlevelcategory->save();
        return back()->with("status", "The end level category has been succesfully saved");
    }
    public function vieweditendlevelcategorypage($id){
        $endlevelcategory = Endlevelcategory::find($id);
        $toplevelcategories = Toplevelcategory::where("tcat_name", "!=", $endlevelcategory->tcat_id)->get();
        $midlevelcategories = Midlelevelcategory::where("mcat_name", "!=", $endlevelcategory->mcat_id)->get();
        return view('admin.editendlevelcategory')->with('endlevelcategory', $endlevelcategory)->with('toplevelcategories', $toplevelcategories)->with('midlevelcategories', $midlevelcategories);
    }

    public function updateendlevelcategory(Request $request, $id){
        $endlevelcategory = Endlevelcategory::find($id);
        $endlevelcategory->update($request->all());

        return back()->with("status", "The end level category has been successfully updated !");
    }
    
    public function deleteendlevelcategory($id){
        $endlevelcategory = Endlevelcategory::find($id);
        $endlevelcategory->delete();

        return back()->with("status", "The end level category has been successfully deleted !");
    }

    public function savetoplevelcategory(Request $request){
        $this->validate($request, [
            'tcat_name'=> 'required',
            'show_on_menu'=> 'required',
        ]);

        $toplevelcategory = new Toplevelcategory();
        $toplevelcategory->tcat_name = $request->input('tcat_name');
        $toplevelcategory->show_on_menu = $request->input('show_on_menu');

        $toplevelcategory->save();
        return back()->with("status", "The top level category has been successfully saved !");
    }
    public function updatetoplevelcategory(Request $request, $id){
        $this->validate($request, [
            'tcat_name'=> 'required',
            'show_on_menu'=> 'required',
        ]);

        $toplevelcategory = Toplevelcategory::find($id);
        $toplevelcategory->tcat_name = $request->input('tcat_name');
        $toplevelcategory->show_on_menu = $request->input('show_on_menu');

        $toplevelcategory->update();
        return back()->with("status", "The top level category has been successfully updated !");
    }
    public function deletetoplevelcategory($id){
        $toplevelcategory = Toplevelcategory::find($id);
        $toplevelcategory->delete();

        return back()->with("status", "The top level category has been successfully deleted !");
    }

    public function savemidlevelcategory(Request $request){
        $midlevelcategory = new Midlelevelcategory();
        $midlevelcategory->tcat_id = $request->input('tcat_id');
        $midlevelcategory->mcat_name = $request->input('mcat_name');

        $midlevelcategory->save();
        return back()->with("status", "The mid level category has been successfully saved !");
    }

    public function updatemidlevelcategory (Request $request, $id){
        $midlevelcategory = Midlelevelcategory::find($id);
        $midlevelcategory->tcat_id = $request->input('tcat_id');
        $midlevelcategory->mcat_name = $request->input('mcat_name');

        $midlevelcategory->update();
        return back()->with("status", "The mid level category has been successfully updated !");
    }

    public function deletemidlevelcategory($id){
        $midlevelcategory = Midlelevelcategory::find($id);
        $midlevelcategory->delete();

        return back()->with("status", "The mid level category has been successfully deleted !");
}
}
