@extends('layouts.app')
@section('title','Rehber')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Kişiler</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Anasayfa</a>
                            </li>
                            <li class="breadcrumb-item active "><a href="#">Rehber</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="row match-height">
            @foreach($contacts as $contact)
                <div class="col-xl-4 col-md-6 col-sm-6">
                    <div class="card box-shadow-1">
                        <div class="text-center">
                            <div class="card-body">
                                <img src="{{asset('public/images/'.$contact->image)}}" class="rounded-circle  height-150 width-150"
                                     alt="Card image">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title mt-3">{{$contact->first_name, $contact->last_name}}</h4>
                                <p class="card-text">Email: {{$contact->email}}</p>
                                <p class="card-text">Telefon: {{$contact->phone}}</p>
                                @if($contact->customer_id)
                                    <p class="card-text">Çalıştığı
                                        şirket: {{\App\Models\Customer::find($contact->customer_id)->name}}</p>
                                    <p class="card-text">
                                        Adresi: {{\App\Models\Customer::find($contact->customer_id)->adress}}</p>
                                    <p class="card-text">
                                        Websitesi: {{\App\Models\Customer::find($contact->customer_id)->website}}</p>
                                @endif
                            </div>
                            <div class="text-center">
                                <div class="card-footer">
                                    <a title="Düzenle" href="{{route('contacts.update',$contact->id)}}"
                                       class="btn btn-sm btn-primary btn-darken-3"><i class="ft ft-edit-2"></i><a/>
                                        <a contact_id="{{$contact->id}}" title="Sil"
                                           class="btn btn-sm btn-danger remove-click text-white"><i
                                                class="ft ft-delete"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{$contacts->links()}}
    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kontaktı Sil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="body">
                    <div class="alert alert-danger" id="articleAlert">
                        <p>Kontaktı silmek istediğinizden emin misiniz ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <form method="post" action="{{route('contacts.delete')}}">
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
            id = $(this)[0].getAttribute('contact_id');
            $('#deleteId').val(id);
            $('#deleteModal').modal();
        });
    </script>
@endsection
