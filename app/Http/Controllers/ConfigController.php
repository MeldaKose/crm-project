<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use App\Models\Product;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class ConfigController extends Controller
{
    public function index()
    {
        $site_configs = Site::find(1);
        return view('configs.config', compact('site_configs'));
    }

    public function siteConfigsUpdate(Request $request)
    {
        $request->validate([
            'logo' => 'bail|image|mimes:jpeg,png,jpg',
            'favicon' => 'bail|image|mimes:jpeg,png,jpg',
        ]);
        $site_config = Site::find(1);
        $site_config->title = $request->title;
        $slug = Str::slug($request->title);
        if ($request->hasFile('logo')) {
            $logoName = $slug . '-logo' . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('images'), $logoName);
            $site_config->logo = $logoName;
        }
        if ($request->hasFile('favicon')) {
            $faviconName = $slug . '-favicon' . '.' . $request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('images'), $faviconName);
            $site_config->favicon = $faviconName;
        }
        $site_config->save();
        toastr()->success('Site ayarları başarıyla güncellendi.');
        return back();
    }

    public function userCheck()
    {
        $roles = Role::get();
        $users = Auth::user()->get();
        return view('configs.user_check', compact('users', 'roles'));
    }

    public function userSwitch(Request $request)
    {
        $user = Auth::user()->find($request->id);
        $user->accept = $request->accept == "true" ? 1 : 0;
        $user->save();
        toastr()->success('Başarıyla' . $user->accept . "yapıldı");
        return back();
    }

    public function delete(Request $request)
    {
        $user = Auth::user()->find($request->id);;
        if (File::exists($request->image)) {
            File::delete(public_path('images'), $request->image);
        }
        $user->delete();
        toastr()->success('Kullanıcı başarıyla silindi');
        return back();
    }

    public function editRole(Request $request)
    {
        $employee = Employee::find($request->id);
        $employee->role_id = $request->role_id;
        $employee->save();
        toastr()->success('Kullanıcının rolü başarıyla güncellendi');
        return back();
    }

    public function productConfig()
    {
        $products = Product::get();
        return view('configs.product_config', compact('products'));
    }

    public function addProduct(Request $request)
    {
        $products = new Product();
        $products->name = $request->name;
        $products->description = $request->description;
        $products->bottom_cost = $request->bottom_cost;
        $products->top_cost = $request->top_cost;
        $products->save();
        toastr()->success('Ürün başarıyla güncellendi');
        return back();
    }

    public function deleteProduct(Request $request)
    {
        $products = Product::find($request->id);
        $products->delete();
        toastr()->success('Ürün başarıyla silindi');
        return back();
    }

    public function productGetdata(Request $request)
    {
        $products = Product::find($request->id);
        return response()->json($products);
    }

    public function editProduct(Request $request)
    {
        $products = Product::find($request->id);
        $products->name = $request->name;
        $products->description = $request->description;
        $products->bottom_cost = $request->bottom_cost;
        $products->top_cost = $request->top_cost;
        $products->save();
        toastr()->success('Ürün başarıyla güncellendi');
        return back();
    }

}
