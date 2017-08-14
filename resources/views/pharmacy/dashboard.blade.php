@extends('dashboard.master')

@section('content')
    <div class="row p-t-10">
        <div class="col-md-10 col-md-offset-1">
            <div class="row text-center">
                <div class="col-sm-6 col-md-4">
                <a href="{{ route('drugs.index', [], false) }}">
                    <div class="panel">
                        <div class="h2 text-success">Drugs</div>

                        <span class="h3 text-muted">{{ getDrugsNumber()  }}</span>
                        <div class="text-right">
                            <i class="fa fa-medkit fa-2x text-success"></i>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-sm-6 col-md-4">
                <a href="#">
                    <div class="panel">
                        <div class="h2 text-success">Sales</div>
                        <span class="h3 text-muted">956</span>
                        <div class="text-right">
                            <i class="fa fa-shopping-cart fa-2x text-success"></i>
                        </div>
                    </div>
                </a>
                </div>

                <div class="col-sm-6 col-md-4">
                <a href="#">
                    <div class="panel">
                        <div class="h2 text-success">Purchase</div>
                        <span class="h3 text-muted">1</span>
                        <div class="text-right">
                            <i class="fa fa-credit-card fa-2x text-success"></i>
                        </div>
                    </div>
                </a>
                </div>

            </div> <!-- end row -->

            <div class="row text-center">
                <div class="col-sm-6 col-md-4">
                <a href="#">
                    <div class="panel">
                        <div class="h2 text-success">Bills</div>
                        <span class="h3 text-muted">100</span>
                        <div class="text-right">
                            <i class="fa fa-tag fa-2x text-success"></i>
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-sm-6 col-md-4">
                <a href="#">
                    <div class="panel">
                        <div class="h2 text-success">Insurance</div>
                        <span class="h3 text-muted">5</span>
                        <div class="text-right">
                            <i class="fa fa-heartbeat fa-2x text-success"></i>
                        </div>
                    </div>
                </a>
                </div>
                <div class="col-sm-6 col-md-4">
                <a href="#">
                    <div class="panel">
                        <div class="h2 text-success">Stock</div>
                        <span class="h3 text-muted">10000</span>
                        <div class="text-right">
                            <i class="fa fa-signal fa-2x text-success"></i>
                        </div>
                    </div>
                </a>
                </div>
            </div>
        </div>
    </div>
@endsection