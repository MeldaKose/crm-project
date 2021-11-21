@extends('layouts.app')
@section('title','Müşteri Oluştur')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Müşteri Ekle</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Anasayfa</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Müşteriler</a>
                            </li>
                            <li class="breadcrumb-item active">Müşteri Ekle
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
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
                        <form method="post" action="{{route('customers.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Şirket Fotoğrafı</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Şirket Adı</label>
                                <input type="text" name="name" class="form-control" value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label>Şirketin Websitesi</label>
                                <input type="url" name="website" class="form-control" value="{{old('website')}}">
                            </div>
                            <div class="form-group">
                                <label>Şirket Adresi</label>
                                <textarea name="adress" type="text"  value="{{old('adress')}}" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Şirketin Bize Ulaştığı Kaynak</label>
                                <input type="text" value="{{old('source')}}" name="source" class="form-control">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary btn-block" type="submit" value="Müşteriyi Oluştur">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
