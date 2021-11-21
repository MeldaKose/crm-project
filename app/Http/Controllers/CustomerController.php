<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'ASC')->paginate(6);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|min:2',
            'adress' => 'bail|required|min:10',
            'website' => 'bail|required|active_url',
            'source' => 'bail|required|min:2',
            'image' => 'bail|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $slug = Str::slug($request->name);
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->slug = $slug;
        $customer->adress = $request->adress;
        $customer->website = $request->website;
        $customer->source = $request->source;
        if ($request->hasFile('image')) {
            $imageName = $slug . '-customer' . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $customer->image = $imageName;
        } else {
            $customer->image = 'pp.jpg';
        }
        $customer->save();
        toastr()->success('Müşteri başarıyla oluşturuldu');
        return redirect()->route('customers.index');
    }

    public function update($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.update', compact('customer'));
    }

    public function edit(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|min:2',
            'adress' => 'bail|required|min:10',
            'website' => 'bail|required|active_url',
            'source' => 'bail|required|min:2',
            'image' => 'bail|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $customer = Customer::findOrFail($request->id);
        $slug = Str::slug($request->name);
        $customer->name = $request->name;
        $customer->slug = $slug;
        $customer->website = $request->website;
        $customer->adress = $request->adress;
        $customer->source = $request->source;
        if ($request->hasFile('image')) {
            $imageName = $slug . '-customer' . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $customer->image = $imageName;
        }
        $customer->save();
        toastr()->success('Müşteri başarıyla güncellendi');
        return redirect()->route('customers.index');
    }

    public function delete(Request $request)
    {
        $customer = Customer::findOrFail($request->id);
        if (File::exists($request->image)) {
            File::delete(public_path('images'), $request->image);
        }
        $customer->delete();
        toastr()->success('Müşteri başarıyla silindi');
        return back();
    }
}
