<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Situation;
use App\Models\Customer;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;


class OfferController extends Controller
{
    public function index(){
        $offers=Offer::where('employee_id',Auth::id())->get();
        $situations=Situation::orderBy('order','ASC')->get();
        $customers=Customer::orderBy('created_at','ASC')->get();
        $products=Product::get();
        return view('offers.index',compact('situations','customers','offers','products'));
    }
    public function create(Request $request){
        $request->validate([
            'name'=>'bail|required',
        ]);
        $offers=new Offer();
        $offers->name=$request->name;
        $offers->price=$request->price;
        $offers->customer_id=$request->customer;
        $offers->situation_id=$request->situation_id;
        $offers->product_id=$request->product_id;
        $offers->employee_id=Auth::id();
        $offers->save();
        toastr()->success('Teklif başarıyla eklendi');
        return redirect()->route('offer.index');
    }
    public function delete(Request $request){
        $contact=Contact::findOrFail($request->id);
        $contact->delete();
        toastr()->success('Teklif başarıyla silindi');
        return back();
    }
    public function orders(Request $request){
        foreach ($request->get('situation') as $key=>$order){
            Offer::where('id',$order)->update(['order'=>$key]);
        }
    }
    public function getData(Request $request){
        $offer=Offer::findOrFail($request->id);
        return response()->json($offer);
    }
    public function update(Request $request){

        $request->validate([
            'name'=>'bail|required',
        ]);
        $offers=Offer::find($request->id);
        $offers->name=$request->name;
        $offers->price=$request->price;
        $offers->customer_id=$request->customer;
        $offers->situation_id=$request->situation_id;
        $offers->product_id=$request->product_id;
        $offers->employee_id=Auth::id();
        $offers->save();
        toastr()->success('Teklif başarıyla güncellendi');
        return redirect()->route('offer.index');
    }
    public function all(){
        $offers=Offer::get();
        return view('offers.all',compact('offers'));
    }
}
