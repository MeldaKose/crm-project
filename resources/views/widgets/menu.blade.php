<!-- ////////////////////////////////////////////////////////////////////////////-->
<div
    class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow"
    role="navigation" data-menu="menu-wrapper">
    <div class="navbar-container main-menu-content container center-layout" data-menu="menu-container">
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item">
                <a class="nav-link @if(request()->segment(2)=="dashboard") active @endif" href="{{route('dashboard')}}"><i class="la la-home"></i>
                    <span>Grafikler</span>
                </a>
            </li>
            <li class="dropdown nav-item @if(request()->segment(2)=="teklifler") active @endif" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#"
                                                                  data-toggle="dropdown"><i
                        class="ft ft-clipboard"></i><span>Teklifler</span></a>
                <ul class="dropdown-menu">

                    <li data-menu=""><a class="dropdown-item @if(request()->segment(2)=="teklifler"& request()->segment(3)=="")active @endif" href="{{route('offer.index')}}" data-toggle="dropdown"><i
                                class="ft ft-copy"></i>
                            Tekliflerim</a>
                    </li>
                    <li data-menu=""><a class="dropdown-item @if(request()->segment(2)=="musteriler"& request()->segment(3)=="tumu")active @endif" href="{{route('offer.all')}}"
                                        data-toggle="dropdown"><i
                                class="ft ft-layers"></i>Tüm Teklifler</a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item @if(request()->segment(2)=="aktiviteler") active @endif" ><a class=" nav-link" href="{{route('activities.index')}}"><i class="ft ft-calendar"></i>
                    <span>Aktiviteler</span></a>

            </li>
            <li class="dropdown nav-item @if(request()->segment(2)=="musteriler") active @endif" data-menu="dropdown"><a
                    class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="ft ft-user"></i><span>Müşteriler</span></a>
                <ul class="dropdown-menu">
                    <li class="@if(request()->segment(2)=="musteriler"& request()->segment(3)=="")active @endif"
                        data-menu="">
                        <a class="dropdown-item " href="{{route('customers.index')}}" data-toggle="dropdown"><i
                                class="ft ft-users"></i>Tüm Müşteriler</a>
                    </li>
                    <li class="@if(request()->segment(2)=="musteriler"& request()->segment(3)=="olustur")active @endif"
                        data-menu="">
                        <a class="dropdown-item" href="{{route('customers.create')}}" data-toggle="dropdown"><i
                                class="ft ft-user-plus"></i>Müşteri Ekle</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown nav-item @if(request()->segment(2)=="rehber") active @endif" data-menu="dropdown"><a
                    class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i
                        class="la la-file-text"></i><span>Rehber</span></a>
                <ul class="dropdown-menu">
                    <li data-menu="">
                        <a class="dropdown-item @if(request()->segment(2)=="rehber"& request()->segment(3)=="") active @endif"
                           href="{{route('contacts.index')}}" data-toggle="dropdown"><i class="la la-check-square"></i>Tüm
                            Rehber</a>
                    </li>
                    <li data-menu="">
                        <a class="dropdown-item @if(request()->segment(2)=="rehber" & request()->segment(3)=="olustur") active @endif"
                           href="{{route('contacts.create')}}" data-toggle="dropdown"><i class="ft ft-file-plus"></i>Rehbere
                            Ekle</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->segment(2)=="urunler") active @endif" href="{{route('product.index')}}"><i class="la la-th-list"></i>
                    <span>Ürünler</span>
                </a>
            </li>
            <li class="nav-item" ><a
                    class="nav-link  @if(request()->segment(2)=="calisanlar") active @endif" href="{{route('employees.index')}}"
                    ><i class="ft ft-user"></i><span>Çalışanlar</span></a>
            </li>
            @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
                <li class=" nav-item @if(request()->segment(2)=="ayarlar") active @endif" ><a class=" nav-link" href="{{route('configs')}}"><i
                            class="ft ft-settings"></i><span>Ayarlar</span></a>
                </li>
            @endif
        </ul>

    </div>
</div>
<div class="app-content container center-layout mt-2">

