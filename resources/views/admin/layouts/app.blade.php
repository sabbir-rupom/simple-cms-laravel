@extends('admin.layouts.master')

@section('content')
    <!-- page-wrapper start -->
    <div class="page-wrapper">
        @include('admin.layouts.partials.topnav')
        @include('admin.layouts.partials.sidenav')

        <div class="main-content">
            <div class="page-inner">

                @include('admin.layouts.partials.breadcrumb')

                @yield('panel')

            </div><!-- bodywrapper__inner end -->
        </div><!-- body-wrapper end -->
    </div>

@endsection

