@extends('layouts.app')
@section('title','Ayarlar')
@section('content')
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Profil Ayarları</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active "><a href="#">Profil Ayarları</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="media width-250 float-right">
                        <media-left class="media-middle">

                        </media-left>
                        <div class="media-body media-right text-right">

                        </div>
                    </div>
                </div>
            </div>
            <div class="content-detached">
                <div class="content-body">
                    <section id="description" class="card">
                        <div class="card-header">
                            <h4 class="card-title">Bilgilerini Güncelle</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <section class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            @if($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach($errors->all() as $error)
                                                            <li>{{$error}}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="card-body">
                                                <form method="post" action="{{route('user.config',$user->id)}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Profil Fotoğrafı</label>
                                                        <input type="file" name="image" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Ad</label>
                                                        <input type="text" name="first_name" class="form-control" value="{{$user->first_name}}">
                                                    </div>
                                                    <input type="hidden" name="password" value="{{$user->password}}">
                                                    <div class="form-group">
                                                        <label>Soyad</label>
                                                        <input type="text" name="last_name" class="form-control" value="{{$user->last_name}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Mail Adresi:</label>
                                                        <input type="email" name="email" class="form-control" value="{{$user->email}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Telefon:</label>
                                                        <input type="tel" value="{{$user->phone}}" name="phone" class="form-control" data-format="+90 (ddd) ddd-dddd">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pozisyon:</label>
                                                        <input type="tel" value="{{$user->job_title}}" name="job_title" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <input class="btn btn-primary btn-block" type="submit" value="Bilgilerimi Güncelle">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </section>
                    <section id="description" class="card">
                        <div class="card-header">
                            <h4 class="card-title">Şifreni Değiştir</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <section class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            @if($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach($errors->all() as $error)
                                                            <li>{{$error}}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="card-body">
                                                <form method="post" action="{{route('password.config',$user->id)}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="password" class="form-control form-control-user"
                                                               id="exampleCurrentPassword" name="current_password" placeholder=" Eski Şifre">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" class="form-control form-control-user"
                                                               id="exampleInputPassword" name="password" placeholder="Şifre">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" class="form-control form-control-user"
                                                               id="exampleRepeatPassword" name="password_confirmation" placeholder="Şifre Tekrar">
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="btn btn-primary btn-block" type="submit" value="Şifremi Güncelle">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </section>
                    <section id="description" class="card">
                        <div class="card-header">
                            <h4 class="card-title">Hesabı Sil</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <section class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="alert alert-danger">
                                                <p>Butona basarsanız bütün hesap bilgileriniz geri dönüşü olmayan biçimde silinecektir.</p>
                                            </div>
                                            <form method="post" action="">
                                                <input type="hidden" name="id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                                                <div class="form-group">
                                                    <input class="btn btn-primary btn-danger" type="submit" value="Hesabımı Sil">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </section>
                </div>
            </div>


@endsection
