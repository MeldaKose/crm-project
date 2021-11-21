@extends('layouts.app')
@section('title','Teklifler')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Teklifler</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Anasayfa</a>
                            </li>
                            <li class="breadcrumb-item active "><a href="#">Teklifler</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div id="orderSuccess" style="display:none" class="alert alert-success">
            Başarıyla güncellendi.
        </div>
        <div class="row wrapper">
            @foreach($situations as $situation)
                <div class="card col-md-3 " style="height: 100rem">
                    <div class="card-header">
                        {{$situation->name}}
                        <a data-toggle="collapse" href="#collapseExample{{$situation->id}}" role="button"><i
                                class="la la-plus float-right "></i></a>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="collapse" id="collapseExample{{$situation->id}}">
                            <form method="post" action="{{route('offer.create')}}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                           placeholder="Ad" name="name" value="{{old('name')}}">
                                </div>

                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user" id="exampleJob"
                                           placeholder="Beklenen Fiyat" name="price" value="{{old('price')}}" step=".01">
                                </div>

                                <div class="form-group">
                                    <label>Müşteri</label>
                                    <select class="form-control" name="customer" value="{{old('customer')}}" required>
                                        <option value="">Seçim Yapınız</option>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ürün</label>
                                    <select class="form-control" name="product_id" value="{{old('product_id')}}"  required>
                                        <option value="">Seçim Yapınız</option>
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->name}} {{$product->bottom_cost}}-{{$product->top_cost}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="situation_id" value="{{$situation->id}}">
                                <input class="btn btn-primary btn-user btn-block" type="submit" value="Ekle">
                                <hr>
                            </form>
                        </div>

                        @foreach($offers as $offer)
                            @if($offer->situation_id==$situation->id)
                                <div class="orders_offer" id="card-drag-area" style="cursor:move">
                                    <div id="situation_{{$offer->situation_id}}" class="col-xl-12 col-md-12 mb-4 ">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            {{$offer->name}}
                                                        </div>
                                                        <p> Müşteri: {{\App\Models\Customer::whereId($offer->customer_id)->first()->name}}</p>
                                                        <p> Ürün: {{\App\Models\Product::whereId($offer->product_id)->first()->name}}</p>
                                                        <p> {{\App\Models\Product::whereId($offer->product_id)->first()->bottom_cost}}TL-
                                                            {{\App\Models\Product::whereId($offer->product_id)->first()->top_cost}}TL</p>
                                                        <div
                                                            class="h5 mb-0 font-weight-bold text-gray-800">Beklenen Fiyat:{{$offer->price}}
                                                            TL
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a title="Düzenle" offer_id="{{$offer->id}}"
                                                   class="btn btn-sm btn-primary text-white edit-click"><i class="ft ft-edit-2"></i><a/>
                                                    <a offer_id="{{$offer->id}}" title="Sil"
                                                       class="btn btn-sm btn-danger remove-click text-white"><i
                                                            class="ft ft-delete"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div id="editModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Teklifi Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('offer.update')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user"
                                   placeholder="Ad" id="name" name="name" >
                        </div>
                        <input type="hidden" id="id" name="id" >
                        <div class="form-group">
                            <input type="number" class="form-control form-control-user"
                                   placeholder="Beklenen Fiyat" id="price" name="price" step=".01">
                        </div>

                        <div class="form-group">
                            <label>Müşteri</label>
                            <select class="form-control" name="customer" id="customer"  required>
                                <option value="">Seçim Yapınız</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ürün</label>
                            <select class="form-control" name="product_id" id="product_id"  required>
                                <option value="">Seçim Yapınız</option>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}} {{$product->bottom_cost}}-{{$product->top_cost}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Durum</label>
                            <select class="form-control" id="situation_id" name="situation_id"  required>
                                <option value="">Seçim Yapınız</option>
                                @foreach($situations as $situation)
                                    <option value="{{$situation->id}}">{{$situation->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        <input type="submit" class="btn btn-primary" value="Kaydet">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Teklifi Sil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="body">
                    <div class="alert alert-danger" id="articleAlert">
                        <p>Teklifi silmek istediğinizden emin misiniz ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <form method="post" action="{{route('offer.delete')}}">
                        @csrf
                        <input type="hidden" name="id" id="deleteId">
                        <input id="deleteButton" type="submit" class="btn btn-primary" value="Sil">
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--        </div>--}}
    {{--    </div>--}}

@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script>
        $('.remove-click').click(function () {
            id = $(this)[0].getAttribute('offer_id');
            $('#deleteId').val(id);
            $('#deleteModal').modal();
        });

        $('.orders_offer').draggable({
            containment:".wrapper",
            update: function () {
                var siralama = $('.orders_offer').draggable('serialize');
                $.get("{{route('offer.orders')}}?" + siralama, function (data, status) {
                    $('#orderSuccess').show().delay(1000).fadeOut();
                });
            }
        });
        $('.orders_offer').droppable();
        $('.edit-click').click(function(){
            var id = $(this)[0].getAttribute('offer_id');
         $.ajax({
             type:'GET',
             url:'{{route('offer.getdata')}}',
             data:{id:id},
             success:function(data){
                 console.log(data);
                 $('#name').val(data.name);
                 $('#price').val(data.price);
                 $('#id').val(data.id);
                 $('#customer').val(data.customer_id);
                 $('#situation_id').val(data.situation_id);
                 $('#product_id').val(data.product_id);
                 $('#editModal').modal('show');
             }
         });
        });
    </script>
@endsection
