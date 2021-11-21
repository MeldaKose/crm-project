@extends('auth.layouts.app')
@section('content')
    <body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">

                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Şifreni mi unuttun?</h1>
                                        <p class="mb-4">Email adresini gir ve sana gönderdiğimiz linkten şifreni
                                            yenile.</p>
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
                                    <form class="user" method="post" action="{{route('forgotPassword.post')}}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                   id="exampleInputEmail" aria-describedby="emailHelp" name="email"
                                                   placeholder="Enter Email Address...">
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block"
                                               value="Linki Gönder">

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{route('register')}}">Hesap Oluştur!</a>
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
        </div>
    </div>
@endsection

