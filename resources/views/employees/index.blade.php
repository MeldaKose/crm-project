@extends('layouts.app')
@section('title','Çalışanlar')
@section('content')
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Çalışanlar</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Anasayfa</a>
                                </li>
                                <li class="breadcrumb-item active "><a href="#">Çalışanlar</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
            <section id="outline-variants">
                <div class="row match-height">
                    @foreach($employees as $employee)
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="text-center">
                                    <div class="card-body">
                                    <img class="rounded-circle  height-150 width-150" src="{{asset('public/images/'.$employee->image)}}"
                                         alt="Card image cap">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">{{$employee->first_name}}</h4>
                                        <p class="card-text"> {{$employee->last_name}}</p>
                                        <p class="card-text">Email: {{$employee->email}}</p>
                                        <p class="card-text">Telefon: {{$employee->phone}}</p>
                                        <p class="card-text">Pozisyon: {{$employee->job_title}}</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
        {{$employees->links()}}
@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection



