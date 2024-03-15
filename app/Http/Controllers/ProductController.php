<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Toplevelcategory;
use App\Models\Midlelevelcategory;
use App\Models\Endlevelcategory;
use App\Models\Size;
use App\Models\Color;


class ProductController extends Controller
{
    //
    public function viewproductspage(){
        $products = Product::all();
        $increment = 1;
        return view('admin.products')->with("products", $products)->with("increment", $increment );
    }
    public function viewaddproductpage(){
        $toplevelcategories = Toplevelcategory::get();
        $midlevelcategories = Midlelevelcategory::get();
        $endlevelcategories = Endlevelcategory::get();
        $sizes = Size::get();
        $colors = Color::get();
        
        return view('admin.addproduct')->with("toplevelcategories", $toplevelcategories)->with("midlevelcategories", $midlevelcategories)
        ->with("endlevelcategories", $endlevelcategories)->with("sizes", $sizes)->with("colors", $colors);
    }

    public function saveproduct(Request $request){
        
        $this->validate($request, [
            'tcat_id' => 'required | string',
            'mcat_id' => 'required | string',
            'ecat_id' => 'required | string',
            'p_name' => 'required | string',
            'p_old_price' => 'integer | required',
            'p_current_price' => 'integer | required',
            'p_qty' => 'integer | required',
            'size' => 'required | array',
            'size. *' => 'required | string',
            'color' => 'required | array',
            'color. *' => 'required | string',
            'p_featured_photo' => 'image|nullable|max:1999|required',
            'photo' => 'required | array',
            'photo. *' => 'image|nullable|max:1999|required',
            'p_description' => 'required | string',
            'p_short_description' => 'required | string',
            'p_feature' => 'required | string',
            'p_condition' => 'required | string',
            'p_return_policy' => 'required | string',
            'p_is_featured' => 'integer | required',
            'p_is_active' => 'integer | required',
        ]);

        $imagedata = "";
        $sizes = $request->input('size');
        $colors = $request->input('color');
        $photos = $request->file('photo');
        $sizedata = "";
        $colordata = "";
        $increment = 0;

        // Obtenir les sizes
        foreach ($sizes as $size){
            $sizedata = $sizedata.$size."*";
        }

        // Obtenir les colors
        foreach ($colors as $color){
            $colordata = $colordata.$color."*";
        }

        // Obtenir les photos
        foreach ($photos as $photo){
            //1 : file name with extension
            $fileNameWithExt = $photo->getClientOriginalName();

            // print('<h1>' .$fileNameWithExt. '</h1>');

            //2 : file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // print('<h1>' .$fileName. '</h1>');

            //3 : file extension
            $ext = $photo->getClientOriginalExtension();
            // print('<h1>' .$ext. '</h1>');

            //4 : file name to store with timestamp
            $fileNameToStore = $fileName. '_'.time().$increment.'.'.$ext;
            // print('<h1>' .$fileNameToStore. '</h1>');

            $imagedata = $imagedata.$fileNameToStore. "*";

            //upload img
            $path = $photo->storeAs('public/productimages', $fileNameToStore );

            $increment++;
        }

        //1 : file name with extension
        $fileNameWithExt = $request->file('p_featured_photo')->getClientOriginalName();

        // print('<h1>' .$fileNameWithExt. '</h1>');

        //2 : file name
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        // print('<h1>' .$fileName. '</h1>');

        //3 : file extension
        $ext = $request->file('p_featured_photo')->getClientOriginalExtension();
        // print('<h1>' .$ext. '</h1>');

        //4 : file name to store with timestamp
        $fileNameToStore = $fileName. '_'.time().'.'.$ext;
        // print('<h1>' .$fileNameToStore. '</h1>');

        // upload img
        $path = $request->file('p_featured_photo')->storeAs('public/productimages', $fileNameToStore );

        $product = new Product();
        $product->tcat_id = $request->input("tcat_id");
        $product->mcat_id = $request->input("mcat_id");
        $product->ecat_id = $request->input("ecat_id");
        $product->p_name = $request->input("p_name");
        $product->p_old_price = $request->input("p_old_price");
        $product->p_current_price = $request->input("p_current_price");
        $product->p_qty = $request->input("p_qty");
        $product->size = $sizedata;
        $product->color = $colordata;
        $product->p_featured_photo = $fileNameToStore;
        $product->photo = $imagedata;
        $product->p_description = $request->input("p_description");
        $product->p_short_description = $request->input("p_short_description");
        $product->p_feature = $request->input("p_feature");
        $product->p_condition = $request->input("p_condition");
        $product->p_return_policy = $request->input("p_return_policy");
        $product->p_is_featured = $request->input("p_is_featured");
        $product->p_is_active = $request->input("p_is_active");

        $product->save();

        return back()->with("status", "The product has been successfully saved !");
    

    
    }

    public function vieweditproductpage($id){
        $product = Product::find($id);

        $toplevelcategories = Toplevelcategory::where("tcat_name", "!=", $product->tcat_id)->get();
        $midlevelcategories = Midlelevelcategory::where("mcat_name", "!=", $product->mcat_id)->get();
        $endlevelcategories = Endlevelcategory::where("ecat_name", "!=", $product->ecat_id)->get();
        // Création d'un tableau en découpant à partir de "*"
        $selectedsizes = explode("*", $product->size);
        // Suppression du dernier caractère vide suivant le "*"
        array_pop($selectedsizes);

        $selectedcolors = explode("*", $product->color);
        array_pop($selectedcolors);

        $selectedphotos = explode("*", $product->photo);
        array_pop($selectedphotos);

        // Algorithme pour sélectionner et ajouter les éléments dans le tableau
        $sizes = array();
        $allsizes = Size::get();

        $colors = array();
        $allcolors = Color::get();

        foreach ($allsizes as $allsize){
            # Comparaison de toutes les tailles avec les tailles sélectionnées
            if (!(in_array($allsize->size_name, $selectedsizes))) {
                // Push des tailles différentes
                array_push($sizes, $allsize->size_name );
            }
        }

        foreach ($allcolors as $allcolor){
            # Comparaison de toutes les couleurs avec les couleurs sélectionnées
            if (!(in_array($allcolor->color_name, $selectedcolors))) {
                array_push($colors, $allcolor->color_name );
            }
        }



        return view('admin.editproduct')->with("product", $product)->with("toplevelcategories", $toplevelcategories)->with("midlevelcategories", $midlevelcategories)
        ->with("endlevelcategories", $endlevelcategories)->with("selectedsizes", $selectedsizes)->with("selectedcolors", $selectedcolors)
        ->with("selectedphotos", $selectedphotos)->with("sizes", $sizes)->with("colors", $colors);
    }

    public function updateproduct(Request $request, $id){
        $this->validate($request, [
            'tcat_id' => 'required | string',
            'mcat_id' => 'required | string',
            'ecat_id' => 'required | string',
            'p_name' => 'required | string',
            'p_old_price' => 'integer | required',
            'p_current_price' => 'integer | required',
            'p_qty' => 'integer | required',
            'size' => 'required | array',
            'size. *' => 'required | string',
            'color' => 'required | array',
            'color. *' => 'required | string',
            'p_description' => 'required | string',
            'p_short_description' => 'required | string',
            'p_feature' => 'required | string',
            'p_condition' => 'required | string',
            'p_return_policy' => 'required | string',
            'p_is_featured' => 'integer | required',
            'p_is_active' => 'integer | required',
        ]);

        $product = Product::find($id);

        if($request ->file("p_featured_photo")){
            $this->validate($request, [
                'p_featured_photo' => 'image|nullable|max:1999',
                
            ]);
    
            
            //1 : file name with extension
        $fileNameWithExt = $request->file('p_featured_photo')->getClientOriginalName();

        // print('<h1>' .$fileNameWithExt. '</h1>');

        //2 : file name
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        // print('<h1>' .$fileName. '</h1>');

        //3 : file extension
        $ext = $request->file('p_featured_photo')->getClientOriginalExtension();
        // print('<h1>' .$ext. '</h1>');

        //4 : file name to store with timestamp
        $fileNameToStore = $fileName. '_'.time().'.'.$ext;
        // print('<h1>' .$fileNameToStore. '</h1>');

        //4.1 Delete old image
        Storage::delete("public/productimages/$product->p_featured_photo");

        //5 : upload img
        $path = $request->file('p_featured_photo')->storeAs('public/productimages', $fileNameToStore );

        $product->p_featured_photo = $fileNameToStore;
        }
        $imagedata = "";
        $sizes = $request->input('size');
        $colors = $request->input('color');
        $photos = $request->file('photo');
        $sizedata = "";
        $colordata = "";
        $increment = 0;

         // Obtenir les sizes
        foreach ($sizes as $size){
            $sizedata = $sizedata.$size."*";
        }

        // Obtenir les colors
        foreach ($colors as $color){
            $colordata = $colordata.$color."*";
        }

        // Obtenir les photos
        if($photos){
            $this->validate($request, [
                'photo' => 'required | array',
            'photo. *' => 'image|nullable|max:1999',
                
            ]);
            foreach ($photos as $photo){
                //1 : file name with extension
                $fileNameWithExt = $photo->getClientOriginalName();
    
                // print('<h1>' .$fileNameWithExt. '</h1>');
    
                //2 : file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // print('<h1>' .$fileName. '</h1>');
    
                //3 : file extension
                $ext = $photo->getClientOriginalExtension();
                // print('<h1>' .$ext. '</h1>');
    
                //4 : file name to store with timestamp
                $fileNameToStore = $fileName. '_'.time().$increment.'.'.$ext;
                // print('<h1>' .$fileNameToStore. '</h1>');
    
                $imagedata = $imagedata.$fileNameToStore. "*";
    
                //5 : upload img
                $path = $photo->storeAs('public/productimages', $fileNameToStore );

                $increment++;
            }
            $product->photo = $product->photo.$imagedata;
        }
        // foreach ($photos as $photo){
        //     //1 : file name with extension
        //     $fileNameWithExt = $photo->getClientOriginalName();

        //     // print('<h1>' .$fileNameWithExt. '</h1>');

        //     //2 : file name
        //     $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //     // print('<h1>' .$fileName. '</h1>');

        //     //3 : file extension
        //     $ext = $photo->getClientOriginalExtension();
        //     // print('<h1>' .$ext. '</h1>');

        //     //4 : file name to store with timestamp
        //     $fileNameToStore = $fileName. '_'.time().'.'.$ext;
        //     // print('<h1>' .$fileNameToStore. '</h1>');

        //     $imagedata = $imagedata.$fileNameToStore. "*";

        //     //5 : upload img
        //     $path = $photo->storeAs('public/productimages', $fileNameToStore );

        // }
        

        $product->tcat_id = $request->input("tcat_id");
        $product->mcat_id = $request->input("mcat_id");
        $product->ecat_id = $request->input("ecat_id");
        $product->p_name = $request->input("p_name");
        $product->p_old_price = $request->input("p_old_price");
        $product->p_current_price = $request->input("p_current_price");
        $product->p_qty = $request->input("p_qty");
        $product->size = $sizedata;
        $product->color = $colordata;
        $product->p_description = $request->input("p_description");
        $product->p_short_description = $request->input("p_short_description");
        $product->p_feature = $request->input("p_feature");
        $product->p_condition = $request->input("p_condition");
        $product->p_return_policy = $request->input("p_return_policy");
        $product->p_is_featured = $request->input("p_is_featured");
        $product->p_is_active = $request->input("p_is_active");

        $product->update();

        return back()->with("status", "The product has been successfully updated !");
    }

    public function deleteotherphoto($id, $photo){
        $product = Product::find($id);
        $imagedata="";
        $updatedphotos = explode($photo."*", $product->photo);

        foreach ($updatedphotos as $updatedphoto) {
            if($updatedphoto){
                $imagedata = $imagedata.$updatedphoto;
            }
            
        }
        $product->photo = $imagedata;
        Storage::delete("public/productimages/$photo");
        $product->update();

        return back();
    }

    public function deleteproduct ($id){
        $product = Product::find($id);
        Storage::delete("public/productimages/$product->p_featured_photo");

        $photos = explode("*", $product->photo);

        foreach ($photos as $photo) {
            Storage::delete("public/productimages/$photo");
        }

        $product->delete();
        return back()->with("status", "The product has been successfully deleted !");
    }

    public function vieworderspage(){
        return view('admin.orders');
    }
}
