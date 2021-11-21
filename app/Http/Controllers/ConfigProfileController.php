<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ConfigProfileController extends Controller
{
    public function index(){
        $user=Auth::user();
        return view('configs.profile_config',compact('user'));
    }
    public function edit(Request $request){
        $request->validate([
            'first_name'=>'bail|required|min:2',
            'last_name'=>'bail|required|min:2',
            'email'=>'bail|required|email:rfc,dns',
            'phone'=>'bail|required|numeric',
            'image' => 'bail|image|mimes:jpeg,png,jpg|max:2048',
            'job_title'=>'bail|required',
        ]);
        $employee=Employee::findOrFail($request->id);
        $slug=Str::slug($request->first_name);
        $employee->first_name=$request->first_name;
        $employee->last_name=$request->last_name;
        $employee->slug=$slug;
        $employee->email=$request->email;
        $employee->phone=$request->phone;
        $employee->job_title=$request->job_title;
        if($request->hasFile('image')){
            $imageName=$slug.'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'),$imageName);
            $employee->image=$imageName;
        }
        $employee->save();
        toastr()->success('Hesabınız başarıyla güncellendi');
        return redirect()->route('profile.config');
    }
    public function updatePassword(Request $request){
        $request->validate([
            'password' => 'confirmed',
        ]);
        $employee = Employee::find($request->id);
        if(Hash::check($request->current_password,$employee->password)){
            $employee->password = bcrypt($request->password);
            $employee->save();
            toastr()->success('Şifreniz başarıyla yenilenmiştir.');
            return redirect()->route('profile.config');
        }else{
            toastr()->error('Şifreniz doğrulanamadı. Tekrar deneyin.');
            return redirect()->route('profile.config');
        }
    }
}
