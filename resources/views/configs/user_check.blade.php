@extends('layouts.app')
@section('title','Ayarlar')
@section('content')
    @include('widgets.config_sidebar')
    <div class="content-detached content-right">
        <div class="content-body">
            <section id="description" class="card">
                <div class="card-header">
                    <h4 class="card-title">Kullanıcı Onayı</h4>
                </div>
                <div id="switchSuccess" style="display:none" class="alert alert-success">
                    Kullanıcının durumu güncellendi.
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
                                            <th>Soyad</th>
                                            <th>Email</th>
                                            <th>Telefon</th>
                                            <th>Meslek</th>
                                            <th>Rol</th>
                                            <th>Oluşturulma Tarihi</th>
                                            <th>Erişimi Yönet</th>
                                            <th>Sil</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{$user->first_name}}</td>
                                                <td>{{$user->last_name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->phone}}</td>
                                                <td>{{$user->job_title}}</td>
                                                <td>{{\App\Models\Role::find($user->role_id)->name}}
                                                    <a title="Düzenle" user_id="{{$user->id}}"
                                                       class="btn btn-sm btn-primary edit-click"><i class="ft ft-edit-2 text-white"></i><a/>
                                                </td>
                                                <td>{{$user->created_at->diffforhumans()}}</td>
                                                <td>
                                                    <input class="switch" user-id="{{$user->id}}" type="checkbox" data-on="aktif"
                                                           data-off="pasif" data-offstyle="danger" @if($user->accept==1) checked @endif data-toggle="toggle">
                                                </td>
                                                <td>
                                                    <a user_id="{{$user->id}}" title="Sil"
                                                       class="btn btn-sm btn-danger remove-click"><i class="ft ft-trash-2 text-white"></i></a>
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
                        <h5 class="modal-title">Çalışanı Sil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="body">
                        <div class="alert alert-danger" id="articleAlert">
                            <p> Kullanıcıyı silmek istediğinizden emin misiniz ?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                        <form method="post" action="{{route('user.delete')}}">
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
                        <form method="post" action="{{route('user.edit.role')}}">
                            @csrf
                            <input type="hidden" name="id" id="editId">
                            <select class="form-control" id="role_id" name="role_id"  required>
                                <option value="">Seçim Yapınız</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                            <input id="editButton" type="submit" class="btn btn-primary" value="Gönder">
                        </form>
                    </div>
                    <div class="modal-footer">
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
                $('.switch').change(function(){
                    id=$(this)[0].getAttribute('user-id');
                    accept = $(this).prop('checked');
                    $.get('{{route('user.switch')}}', {id:id, accept:accept}, function (data,status) {
                        console.log(data);
                        $('#switchSuccess').show().delay(1000).fadeOut();
                    });
                })
                $('.remove-click').click(function () {
                     id = $(this)[0].getAttribute('user_id');
                    $('#deleteId').val(id);
                    $('#deleteModal').modal();
                })
                $('.edit-click').click(function(){
                   id=$(this)[0].getAttribute('user_id');
                   $('#editId').val(id);
                   $('#editModal').modal();
                });
            </script>
        @endsection
