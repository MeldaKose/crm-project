<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    public function index(){
        $contacts=Contact::orderBy('created_at','ASC')->paginate(6);
        return view('contacts.index',compact('contacts'));
    }
    public function create(){
        $customers=Customer::orderBy('created_at','ASC')->get();
        return view('contacts.create',compact('customers'));
    }
    public function store(Request $request){
        $request->validate([
            'first_name'=>'bail|required',
            'last_name'=>'bail|required',
            'email'=>'bail|required|email:rfc,dns',
            'phone'=>'bail|required|numeric',
            'image' => 'bail|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $slug=Str::slug($request->first_name);
        $contact=new Contact();
        $contact->first_name=$request->first_name;
        $contact->last_name=$request->last_name;
        $contact->slug=$slug;
        $contact->email=$request->email;
        $contact->phone=$request->phone;
        $contact->customer_id=$request->customer;
        if($request->hasFile('image')){
            $imageName=$slug.'-contact'.'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'),$imageName);
            $contact->image=$imageName;
        }
        else {
            $contact->image = 'pp.jpg';
        }
        $contact->save();
        toastr()->success('Kişi başarıyla rehbere eklendi');
        return redirect()->route('contacts.index');
    }
    public function update($id){
        $contact=Contact::findOrFail($id);
        $customers=Customer::orderBy('created_at','ASC')->get();
        return view('contacts.update',compact('contact','customers'));
    }
    public function edit(Request $request){
        $request->validate([
            'first_name'=>'bail|required',
            'last_name'=>'bail|required',
            'email'=>'bail|required|email:rfc,dns',
            'phone'=>'bail|required|numeric',
            'image' => 'bail|required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $slug=Str::slug($request->first_name);
        $contact=Contact::findOrFail($request->id);
        $contact->first_name=$request->first_name;
        $contact->last_name=$request->last_name;
        $contact->slug=$slug;
        $contact->email=$request->email;
        $contact->phone=$request->phone;
        $contact->customer_id=$request->customer;
        if($request->hasFile('image')){
            $imageName=$slug.'-contact'.'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'),$imageName);
            $contact->image=$imageName;
        }
        $contact->save();
        toastr()->success('Kişi başarıyla rehbere güncellendi');
        return redirect()->route('contacts.index');
    }
    public function delete(Request $request){
        $contact=Contact::findOrFail($request->id);
        if(File::exists($contact->image)){
            File::delete(public_path('images'),$contact->image);
        }
        $contact->delete();
        toastr()->success('Kişi başarıyla rehberden silindi');
        return back();
    }
}
