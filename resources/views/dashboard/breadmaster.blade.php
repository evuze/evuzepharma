@extends('dashboard.master')

@section('content')
    @if( getPharmacyMenus($dataType->slug) )
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel p-0">
                <div class="panel-body p-t-10 p-b-0" style="padding-left: 10px;padding-bottom: 5px;">
                    @include(getPharmacyMenus($dataType->slug))
                </div>
            </div>
        </div>
    </div>
    @endif

    @yield('content-bread')
@endsection