<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index(){
        $employees=Employee::orderBy('created_at','ASC')->paginate(6);
        return view('employees.index',compact('employees'));
    }
    public function create(){
        return view('employees.create');
    }
    public function store(Request $request){
        $request->validate([
            'first_name'=>'bail|required|min:2',
            'last_name'=>'bail|required|min:2',
            'email'=>'bail|required|email:rfc,dns',
            'phone'=>'bail|required|numeric',
            'image' => 'bail|image|mimes:jpeg,png,jpg|max:2048',
            'job_title'=>'bail|required',
        ]);
        $slug=Str::slug($request->first_name);
        $employee=new Employee();
        $employee->first_name=$request->first_name;
        $employee->last_name=$request->last_name;
        $employee->slug=$slug;
        $employee->email=$request->email;
        $employee->phone=$request->phone;
        $employee->job_title=$request->job_title;
        if($request->hasFile('image')){
            $imageName=$slug.'-employee'.'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'),$imageName);
            $employee->image=$imageName;
        }
        $employee->save();
        toastr()->success('Çalışan başarıyla oluşturuldu');
        return redirect()->route('employees.index');
    }
    public function update($id)
    {
        $employee=Employee::findOrFail($id);
        return view('employees.update',compact('employee'));
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
        $employee->name=$request->first_name;
        $employee->last_name=$request->last_name;
        $employee->slug=$slug;
        $employee->email=$request->email;
        $employee->phone=$request->phone;
        $employee->job_title=$request->job_title;
        if($request->hasFile('image')){
            $imageName=$slug.'-employee'.'.'.$request->image->getClientriginalExtension();
            $request->image->move(public_path('images'),$imageName);
            $employee->image=$imageName;
        }
        $employee->save();
        toastr()->success('Çalışan başarıyla güncellendi');
        return redirect()->route('employees.index');
    }

    public function delete(Request $request){
        $employee=Employee::findOrFail($request->id);;
        if(File::exists($request->image)){
            File::delete(public_path('images'),$request->image);
        }
        $employee->delete();
        toastr()->success('Çalışan başarıyla silindi');
        return back();
    }

}
