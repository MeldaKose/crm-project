@extends('auth.layouts.app')
@section('content')
<body class="bg-gradient-primary">
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Hesap Oluştur!</h1>
                        </div>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="user" method="post" action="{{route('register.post')}}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                           placeholder="Ad" name="first_name" value="{{old('first_name')}}">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="exampleLastName"
                                           placeholder="Soyad" name="last_name" value="{{old('last_name')}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user bfh-phone" id="examplePhone"data-format="+90 (ddd) ddd-dddd"
                                           placeholder="Telefon" name="phone" value="{{old('phone')}}">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="exampleJob"
                                           placeholder="Ünvan" name="job_title" value="{{old('job_title')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                       placeholder="Mail Adresi" name="email" value="{{old('email')}}">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user"
                                           id="exampleInputPassword" name="password" placeholder="Şifre">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user "
                                           id="exampleRepeatPassword" name="password_confirmation" placeholder="Şifre Tekrar">
                                </div>
                            </div>
                            <input class="btn btn-primary btn-user btn-block" type="submit" value="Kaydol">
                            <hr>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{route('forgotPassword')}}">Şifreni mi unuttun?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{route('login')}}">Zaten hesabın var mı? Giriş Yap!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
