<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mail;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            if(Auth::user()->accept==1){
                return redirect()->route('dashboard');
            }
            else{
                return redirect()->route('login')->withErrors('Hesabınıza yönetici tarafından izin verildiğinde girebilirsiniz.');
            }
        } else {
            return redirect()->route('login')->withErrors('Mailiniz veya şifreniz yanlış.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'first_name' => 'bail|required',
            'last_name' => 'bail|required',
            'email' => 'bail|required|email:rfc,dns|unique:employees,email',
            'phone' => 'bail|required|numeric',
            'job_title' => 'bail|required',
            'password' => 'confirmed',
        ]);
        $slug = Str::slug($request->first_name);
        $employee = new Employee();
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->slug = $slug;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->role_id = 2;
        $employee->password = bcrypt($request->password);
        $employee->job_title = $request->job_title;
        $employee->image='pp.jpg';
        $employee->save();
        toastr()->success('Talebiniz yöneticiye gönderildi');
        return redirect()->route('login');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function forgotPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email:rfc,dns|exists:employees',]);
        $employee = Employee::whereEmail($request->email)->first();
        $token=Str::random(60);
        $employee->token=$token;
        $employee->save();
        $email=$request->email;
        $name=$employee->name;
        Mail::send('auth.mail-reset-password', ['token' => $token], function ($message) use ($email,$name) {
            $message->to($email,$name);
            $message->subject('Şifre Yenileme Bilgilendirmesi');
            $message->from(env('MAIL_USERNAME'),env('APP_NAME'));
        });
        toastr()->success('Şifre yenileme linkini sana mail attık');
        return redirect()->route('login');
    }

    public function resetPassword($token)
    {
        return view('auth.reset-password', compact('token'));
    }

    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            'password' => 'confirmed',
        ]);
        $employee = Employee::Where('token',$request->token)->first();
        $employee->password = bcrypt($request->password);
        $employee->token=null;
        $employee->save();
        toastr()->success('Şifreniz başarıyla yenilenmiştir.');
        return redirect()->route('login');
    }

}
