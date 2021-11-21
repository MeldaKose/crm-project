@extends('layouts.app')
@section('title','Müşteriler')
@section('content')
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Müşteriler</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Anasayfa</a>
                                </li>
                                <li class="breadcrumb-item active "><a href="#">Müşteriler</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section id="outline-variants">
                <div class="row match-height">
                    @foreach($customers as $customer)
                        <div class="col-xl-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="text-center">
                                    <div class="card-body">
                                    <img class="rounded-circle  height-150 width-150" src="{{asset('public/images/'.$customer->image)}}"
                                         alt="Card image cap">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">{{$customer->name}}</h4>
                                        <p class="card-text">Adress: {{$customer->adress}}</p>
                                        <p class="card-text">Websitesi: {{$customer->website}}</p>
                                        <p class="card-text">Kaynak: {{$customer->source}}</p>
                                    </div>
                                    <div class="card-footer">
                                        <a title="Düzenle" href="{{route('customers.edit',$customer->id)}}"
                                           class="btn btn-sm btn-primary"><i class="ft ft-edit-2"></i><a/>
                                            <a customer_id="{{$customer->id}}" title="Sil"
                                               class="btn btn-sm btn-danger remove-click text-white"><i class="ft ft-delete"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
        {{$customers->links()}}
        <div id="deleteModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Müşteriyi Sil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="body">
                        <div class="alert alert-danger" id="articleAlert">
                            <p>Müşteriyi silmek istediğinizden emin misiniz ?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        <form method="post" action="{{route('customers.delete')}}">
                            @csrf
                            <input type="hidden" name="id" id="deleteId">
                            <input id="deleteButton" type="submit" class="btn btn-primary" value="Sil">
                        </form>
                    </div>
                </div>
            </div>
        </div>


@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $('.remove-click').click(function () {
            id = $(this)[0].getAttribute('customer_id');
            $('#deleteId').val(id);
            $('#deleteModal').modal();
        });
    </script>
@endsection



