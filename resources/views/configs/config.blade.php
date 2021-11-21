@extends('layouts.app')
@section('title','Ayarlar')
@section('content')
    @include('widgets.config_sidebar')
    <div class="content-detached content-right">
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
                                        <form method="post" action="{{route('site_configs.update')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label>Site Başlığı</label>
                                                <input type="text" name="title" class="form-control" value="{{$site_configs->title}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Site Logosu</label>
                                                <input type="file" name="logo" class="form-control" value="{{$site_configs->logo}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Site Faviconu</label>
                                                <input type="file" name="favicon" class="form-control" value="{{$site_configs->favicon}}">
                                            </div>
                                            <div class="form-group">
                                                <input class="btn btn-primary btn-block" type="submit" value="Güncelle">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </div>
    </div>


@endsection
