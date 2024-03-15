<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Color;

class ShopController extends Controller
{
    //

    public function savesize(Request $request){
        $size = new Size();
        $size->size_name = $request->input('size_name');
        $size->save();

        return back()->with("status", "The size has been successfully saved !");
    }

    public function vieweditsize($id){
        $size = Size::find($id);
        return view("admin.editsize")->with("size", $size);
    }

    public function updatesize(Request $request, $id){
        $size = Size::find($id);
        $size->size_name = $request->input("size_name");

        $size->update();
        return back()->with("status", "The size has been successfully updated !");
    }

    public function deletesize($id){
        $size = Size::find($id);
        

        $size->delete();
        return back()->with("status", "The size has been successfully deleted !");
    }

    public function savecolor(Request $request){
        $color = new Color();
        $color->color_name = $request->input('color_name');
        $color->save();

        return back()->with("status", "The color has been successfully saved !");
    }

    public function vieweditcolorpage($id){
        $color = Color::find($id);
        return view("admin.editcolor")->with("color", $color);
    }

    public function updatecolor(Request $request, $id){
        $color = Color::find($id);
        $color->color_name = $request->input("color_name");

        $color->update();
        return back()->with("status", "The color has been successfully updated !");
    }

    public function deletecolor($id){
        $color = Color::find($id);
        

        $color->delete();
        return back()->with("status", "The color has been successfully deleted !");
    }
}
