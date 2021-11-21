<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Situation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    public function index(){
        $situation1=Situation::Where('Id',1)->count();
        $situation2=Situation::Where('Id',2)->count();
        $situation3=Situation::Where('Id',3)->count();
        $situation4=Situation::Where('Id',4)->count();
        $customers=Customer::count();
        $activities=Activity::count();
        $employees=Employee::count();
        $price=Offer::where('situation_id',4)->sum('price');
        $products=Product::get();
        return view('homepage',compact('situation1','situation2','situation3','situation4','customers','activities','employees','price','products'));
    }

}
