@extends('layouts.app')
@section('title','Rehbere Ekle')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Kontakt Ekle</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Anasayfa</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Kontaktlar</a>
                            </li>
                            <li class="breadcrumb-item active">Kontakt Ekle
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
                        <form method="post" action="{{route('contacts.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Kontakt Fotoğrafı</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Adı</label>
                                <input type="text" name="first_name" class="form-control" value="{{old('first_name')}}">
                            </div>
                            <div class="form-group">
                                <label>Soyadı</label>
                                <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}">
                            </div>
                            <div class="form-group">
                                <label>Mail Adresi:</label>
                                <input type="email" name="email" placeholder="ornek@gmail.com" class="form-control"
                                       value="{{old('email')}}">
                            </div>
                            <div class="form-group">
                                <label>Telefon</label>
                                <input type="tel" placeholder="123-45-678" value="{{old('phone')}}" name="phone"
                                       class="form-control bfh-phone" data-format="+90 (ddd) ddd-dddd">
                            </div>

                                <div class="form-group">
                                    <label>Müşteri Bilgileri</label>
                                    <select class="form-control" name="customer" value="{{old('customer')}}">
                                        <option value="">Yok</option>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            <div class="form-group">
                                <input class="btn btn-primary btn-block" type="submit" value="Rehbere Ekle">
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

