@extends('layouts.app')
@section('title','Aktiviteler')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Aktiviteler</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Anasayfa</a>
                            </li>
                            <li class="breadcrumb-item active "><a href="#">Aktiviteler</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>

        <div class="content-body">
            <!-- Full calendar basic example section start -->
            <section id="basic-examples">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Aktiviteler</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <p class="card-text"></p>
                                    <div id='fc-basic-views'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/modern-admin-1.0/')}}/app-assets/vendors/css/calendars/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/modern-admin-1.0/')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/modern-admin-1.0/')}}/app-assets/css/plugins/calendars/fullcalendar.css">
@endsection
@section('js')
    <script src="{{asset('public/modern-admin-1.0/')}}/app-assets/vendors/js/extensions/moment.min.js"
            type="text/javascript"></script>
    <script src="{{asset('public/modern-admin-1.0/')}}/app-assets/vendors/js/extensions/fullcalendar.min.js"
            type="text/javascript"></script>

    <!-- END PAGE VENDOR JS-->
    <script>
        $(document).ready(function () {
            var calendar= $('#fc-basic-views').fullCalendar({
                // defaultDate: '2016-06-12',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events:  "{{route('activities.calendar')}}",
                editable: true,
                eventLimit: true,
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {
                    var title = prompt('Aktivite Adı:');
                    var description = prompt('Aktivite Açıklaması:');
                    var customer_id= prompt('Müşteri :');
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                        var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
                        $.ajax({
                            url: "{{route('activities.action')}}",
                            type: "POST",
                            headers: {"X-CSRF-TOKEN": '{{csrf_token()}}'},
                            data: {
                                title: title,
                                description: description,
                                start: start,
                                end: end,
                                customer_id:customer_id,
                                type: 'add',
                            },
                            success: function (data) {
                                calendar.fullCalendar('refechEvents');
                                alert("Etkinlik başarıyla oluşturuldu.");
                            }
                        })
                    }

                },
                eventResize: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss ");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    var title=event.title;
                    var customer_id=event.customer_id;
                    var description=event.description;
                    var id=event.id;
                    $.ajax({
                        url: "{{route('activities.action')}}",
                        type: "POST",
                        headers: {"X-CSRF-TOKEN": '{{csrf_token()}}'},
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            customer_id:customer_id,
                            description:description,
                            id: id,
                            type: 'update'
                        },
                        success: function (response) {
                            calendar.fullCalendar('refechEvents');
                        }

                    });},
                eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss ");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    var title=event.title;
                    var description=event.description;
                    var customer_id=event.customer_id;
                    var id=event.id;
                    $.ajax({
                        url: "{{route('activities.action')}}",
                        type: "POST",
                        headers: {"X-CSRF-TOKEN": '{{csrf_token()}}'},
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            customer_id:customer_id,
                            description:description,
                            id: id,
                            type: 'update'
                        },
                        success: function (response) {
                            calendar.fullCalendar('refechEvents');
                            alert("Etkinlik başarıyla güncellendi.");
                        }
                    });
                },
                eventClick: function (event) {
                    if (confirm("Silmek istediğinize emin misiniz ?")) {
                        var id=event.id;
                        $.ajax({
                            url: "{{route('activities.action')}}",
                            type: "POST",
                            headers: {"X-CSRF-TOKEN": '{{csrf_token()}}'},
                            data: {
                                id: id,
                                type: 'delete'
                            },
                            success: function (response) {
                                calendar.fullCalendar('removeEvents');
                                alert("Event Deleted Successfully");
                            }
                        });
                    }
                }
            })
        });
    </script>
@endsection
