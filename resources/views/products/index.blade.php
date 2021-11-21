@extends('layouts.app')
@section('title','Ürünler')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Ürünler</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Anasayfa</a>
                            </li>
                            <li class="breadcrumb-item active "><a href="#">Ürünler</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <section id="outline-variants">
            <div class="row match-height">
                @foreach($products as $product)
                    <div class="col-md-6 col-sm-12">
                        <div class="card border-success text-center bg-transparent">
                            <div class="card-content">
                                <div class="card-body">
                                    <h3 class="card-title">{{$product->name}}</h3>
                                    <p class="card-text">{{$product->description}}</p>
                                    <h5>{{$product->bottom_cost}} TL- {{$product->top_cost}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
    {{$products->links()}}

@endsection



