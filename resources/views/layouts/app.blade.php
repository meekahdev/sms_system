<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show

<body class="skin-blue sidebar-mini">
<div class="wrapper">

    @include('layouts.partials.mainheader')

    @include('layouts.partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">  
            
            @yield('custom-css')
            
            <div class="panel panel-default">
                <div class="panel-heading">  <!-- Your Page Header Here -->
                @yield('header-content')
                </div>
                    <!-- Your Page Content Here -->
                <div class="panel-body">
                @yield('main-content')
                </div>
                <!-- /.content -->
            </div>
        </section>
    </div><!-- /.content-wrapper -->

    @include('layouts.partials.controlsidebar')

    @include('layouts.partials.footer')

</div><!-- ./wrapper -->

@section('scripts')
    @include('layouts.partials.scripts')
@show
@yield('custom-scripts')
</body>
</html>
