</div>
<footer class="footer footer-static footer-light navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2018 <a class="text-bold-800 grey darken-2" href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent"
                                                                                     target="_blank">PIXINVENT </a>, All rights reserved. </span>
        <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted & Made with <i class="ft-heart pink"></i></span>
    </p>
</footer>
<!-- BEGIN VENDOR JS-->
<script src="{{asset('public/modern-admin-1.0/')}}/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script type="text/javascript" src="{{asset('public/modern-admin-1.0/')}}/app-assets/vendors/js/ui/jquery.sticky.js"></script>
<script type="text/javascript" src="{{asset('public/modern-admin-1.0/')}}/app-assets/vendors/js/charts/jquery.sparkline.min.js"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="{{asset('public/modern-admin-1.0/')}}/app-assets/js/core/app-menu.js" type="text/javascript"></script>
<script src="{{asset('public/modern-admin-1.0/')}}/app-assets/js/core/app.js" type="text/javascript"></script>
<script src="{{asset('public/modern-admin-1.0/')}}/app-assets/js/scripts/customizer.js" type="text/javascript"></script>
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script type="text/javascript" src="{{asset('public/modern-admin-1.0/')}}/app-assets/js/scripts/ui/breadcrumbs-with-stats.js"></script>
<!-- END PAGE LEVEL JS-->

@yield('js')
<script>
    $("input[name='search']").on('keyup',function(){
        var inputSearch=$(this).val();

        $.get( "{{route('search')}}?q="+inputSearch, function( data ) {
            data=JSON.parse(data);
            console.log(data);
            $('.searchResult').show();
            area = $(".searchResult");
            area.html("");
            area.append("<ul>");
            $.each( data, function( key, value ) {
                area.append(`<li data-menu="" class="dropdown-submenu list-group" data-toggle="dropdown"><p class="dropdown-item font-weight float-left list-group-item">Ad: `+value.first_name+`</p></br>
                                            <p class="dropdown-item font-weight float-left list-group-item">Soyad: `+value.last_name+`</p></li>`);
            });
            area.append("</ul>");

        })


    })

</script>
@toastr_js
@toastr_render
</body>
</html>

