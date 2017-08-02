@extends('dashboard.master')

@section('content')
    <div class="page-title">
        <h3 class="title">Welcome!</h3>
    </div>
    <!--Widget-1 -->
    <div class="row text-center">
        <div class="col-sm-6 col-md-3">
            <div class="panel">
                <div class="h2 text-success">Drugs</div>
                <span class="h3 text-muted">15852</span>
                <div class="text-right">
                    <i class="fa fa-medkit fa-2x text-success"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="panel">
                <div class="h2 text-success">Sales</div>
                <span class="h3 text-muted">956</span>
                <div class="text-right">
                    <i class="fa fa-shopping-cart fa-2x text-success"></i>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="panel">
                <div class="h2 text-success">Purchase</div>
                <span class="h3 text-muted">1</span>
                <div class="text-right">
                    <i class="fa fa-credit-card fa-2x text-success"></i>
                </div>
            </div>
        </div>

    </div> <!-- end row -->

    <div class="row text-center">
        <div class="col-sm-6 col-md-3">
            <div class="panel">
                <div class="h2 text-success">Bills</div>
                <span class="h3 text-muted">100</span>
                <div class="text-right">
                    <i class="fa fa-tag fa-2x text-success"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="panel">
                <div class="h2 text-success">Insurance</div>
                <span class="h3 text-muted">5</span>
                <div class="text-right">
                    <i class="fa fa-heartbeat fa-2x text-success"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="panel">
                <div class="h2 text-success">Stock</div>
                <span class="h3 text-muted">10000</span>
                <div class="text-right">
                    <i class="fa fa-signal fa-2x text-success"></i>
                </div>
            </div>
        </div>
    </div>
@endsection