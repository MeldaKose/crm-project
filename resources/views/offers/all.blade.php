@extends('layouts.app')
@section('title','Tüm Teklifler')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Tüm Teklifler</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Anasayfa</a>
                            </li>
                            <li class="breadcrumb-item active "><a href="#">Tüm Teklifler</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <section class="row">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Ad</th>
                                    <th>Beklenen Ücret</th>
                                    <th>Müşteri</th>
                                    <th>Durum</th>
                                    <th>Ürün</th>
                                    <th>Ürün Fiyat Aralığı</th>
                                    <th>Çalışan Adı</th>
                                    <th>Çalışan Maili</th>
                                    <th>Oluşturulma Tarihi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($offers as $offer)
                                    <tr>
                                        <td>{{$offer->name}}</td>
                                        <td>{{$offer->price}}</td>
                                        <td>{{\App\Models\Customer::find($offer->customer_id)->name}}</td>
                                        <td>{{\App\Models\Situation::find($offer->situation_id)->name}} </td>
                                        <td>{{\App\Models\Product::find($offer->product_id)->name}}</td>
                                        <td>{{\App\Models\Product::find($offer->product_id)->bottom_cost}} TL-
                                            {{\App\Models\Product::find($offer->product_id)->top_cost}} TL
                                        </td>
                                        <td>{{\App\Models\Employee::find($offer->employee_id)->first_name}} </td>
                                        <td>{{\App\Models\Employee::find($offer->employee_id)->email}} </td>
                                        <td>{{$offer->created_at->diffforhumans()}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>


    </div>
@endsection
@section('css')
    <link href="{{asset('public/back/')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="{{asset('public/back/')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/back/')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="{{asset('public/back/')}}/js/demo/datatables-demo.js"></script>
@endsection
