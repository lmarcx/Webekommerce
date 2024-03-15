<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logoimage;
use App\Models\Favicon;
use App\Models\Information;
use App\Models\Size;
use App\Models\Color;
use App\Models\Toplevelcategory;

class AdminController extends Controller
{
    //

    public function viewadmindashboard(){
        return view('admin.dashboard');
    }

    public function viewadminsettings(){
        $logoimage = Logoimage::first();
        $favicon = Favicon::first();
        $information = Information::first();

        return view('admin.settings')
            ->with("logoimage", $logoimage)
            ->with("favicon", $favicon)
            ->with("information", $information)
        
        ;
    }
    public function viewsizepage(){
        $sizes = Size::get();
        $increment=1;
        return view("admin.size")->with("sizes", $sizes)->with("increment", $increment);
    }
    public function viewaddsizepage(){
        return view("admin.addsize");
    }

    
    public function viewcolorpage(){
        $colors = Color::get();
        $increment = 1;
        return view("admin.color")->with("colors", $colors)->with("increment", $increment);
    }
    public function viewaddcolorpage(){
        return view("admin.addcolor");
    }
    
    public function viewcountrypage(){
        return view("admin.country");
    }
    public function viewaddcountrypage(){
        return view('admin.addcountry');
    }
    public function vieweditcountrypage(){
        return view('admin.editcountry');
    }
    public function viewshippingcostpage(){
        return view('admin.shippingcost');
    }
    public function vieweditshippingcostpage(){
        return view('admin.editshippingcost');
    }
    public function viewfaqpage(){
        return view('admin.faq');
    }
    public function viewaddfaqpage(){
        return view('admin.addfaq');
    }

    public function vieweditfaqpage(){
        return view('admin.editfaq');
    }
    public function viewregisteredcustomerpage(){
        return view('admin.registeredcustomer');
    }
    public function viewpagesettingspage(){
        return view('admin.pagesettings');
    }
    public function viewsocialmediapage(){
        return view('admin.socialmedia');
    }
    public function viewsubscriberspage(){
        return view('admin.subscribers');
    }
    public function viewadminprofilepage(){
        return view('admin.adminprofile');
    }
}
