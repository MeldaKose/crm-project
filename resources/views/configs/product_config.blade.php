@extends('layouts.app')
@section('title','Ayarlar')
@section('content')
    @include('widgets.config_sidebar')
    <div class="content-detached content-right">
        <div class="content-body">
            <section id="description" class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="card-title">Ürün Ayarları</h4></div>
                    <div class="float-right">
                        Ürün Ekle
                        <a title="Ekle" class="btn btn-sm btn-success add-click"><i
                                class="ft ft-plus text-white"></i></a>
                    </div>
                </div>
                <div id="switchSuccess" style="display:none" class="alert alert-success">
                    Ürünün durumu güncellendi.
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
                                            <th>Açıklama</th>
                                            <th>Fiyat Aralığı</th>
                                            <th>Oluşturulma Tarihi</th>
                                            <th>İşlemler</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <td>{{$product->name}}</td>
                                                <td>{{$product->description}}</td>
                                                <td>{{$product->bottom_cost}} TL - {{$product->top_cost}}</td>
                                                <td>{{$product->created_at->diffforhumans()}}</td>
                                                <td>
                                                    <a title="Düzenle" product_id="{{$product->id}}"
                                                       class="btn btn-sm btn-primary edit-click"><i
                                                            class="ft ft-edit-2 text-white"></i><a/>
                                                        <a product_id="{{$product->id}}" title="Sil"
                                                           class="btn btn-sm btn-danger remove-click"><i
                                                                class="ft ft-trash-2 text-white"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </div>
        <div id="deleteModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ürünü Sil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="body">
                        <div class="alert alert-danger" id="articleAlert">
                            <p> Ürünü silmek istediğinizden emin misiniz ?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        <form method="post" action="{{route('product.delete')}}">
                            @csrf
                            <input type="hidden" name="id" id="deleteId">
                            <input id="deleteButton" type="submit" class="btn btn-primary" value="Sil">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="editModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Kullancıya yetki ver</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="body">
                        <form method="post" action="{{route('edit.product')}}">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user"
                                       placeholder="Ad" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label>Açıklama:</label>
                                <textarea type="text" class="form-control form-control-user"
                                          id="description" name="description"></textarea>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user"
                                           placeholder="İlk Fiyat" id="bottom_cost" name="bottom_cost" step=".01">
                                </div>
                                <h1>-</h1>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user"
                                           placeholder="Son Fiyat" id="top_cost" name="top_cost" step=".01">
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <input id="editButton" type="submit" class="btn btn-primary" value="Gönder">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="addModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Yeni Ürün Ekle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="body">
                        <form method="post" action="{{route('add.product')}}">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user"
                                       placeholder="Ad" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <textarea type="text" class="form-control form-control-user"
                                          placeholder="Açıklama" id="description" name="description"></textarea>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user"
                                           placeholder="İlk Fiyat" id="bottom_cost" name="bottom_cost" step=".01">
                                </div>
                                <h1>-</h1>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user"
                                           placeholder="Son Fiyat" id="top_cost" name="top_cost" step=".01">
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <input id="editButton" type="submit" class="btn btn-primary" value="Gönder">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    </div>
                </div>
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
    <script>

        $('.remove-click').click(function () {
            id = $(this)[0].getAttribute('product_id');
            $('#deleteId').val(id);
            $('#deleteModal').modal();
        })
        $('.edit-click').click(function () {
            id = $(this)[0].getAttribute('product_id');
            $.ajax({
                type: 'GET',
                url: '{{route('product.getdata')}}',
                data: {id: id},
                success: function (data) {
                    console.log(data);
                    $('#name').val(data.name);
                    $('#bottom_cost').val(data.bottom_cost);
                    $('#top_cost').val(data.top_cost);
                    $('#id').val(data.id);
                    $('#description').val(data.description);
                    $('#editModal').modal('show');
                }
            });
        });
        $('.add-click').click(function () {
            $('#addModal').modal();
        });
    </script>
@endsection
