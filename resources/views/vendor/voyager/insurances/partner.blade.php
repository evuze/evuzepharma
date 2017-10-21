@extends('voyager::master')

@section('page_title','Add partnership with '.$insurance->full_name)

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-umbrella"></i> {{ $insurance->full_name }}
        <a href="{{ route('voyager.insurances.index') }}" class="btn btn-sm btn-warning" style="margin-left: 10px;"><i class="voyager-list"></i>List to list</a>
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add Partnership With</h3>
                    </div>
                    <!-- form start -->
                    <form role="form"
                          class="form-edit-add"
                          action="{{ route('submit.partnership', $insurance->id) }}"
                          method="POST">
                          {{ csrf_field() }}
                          <input type="hidden" name="insurance" value="{{ $insurance->id }}" >
                        <div class="panel-body">
                          <div class="row" style="padding-left: 15px; padding-right: 15px;">                          
                          @foreach($resetpharm as $pharmacy)
                            @if( ! $newnew )
                                @php
                                    $pharmacy = json_decode($pharmacy);
                                @endphp
                            @endif
                            <div class="col-md-3" style="width: fit-content !important;margin-right: 5px;background-color: #ECF0F1; border-radius: 0.2em;">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="pharmacies[]" value="{{ $pharmacy->id }}" > {{ strtoupper($pharmacy->name) }}
                                    </label>
                                </div>
                            </div>
                          @endforeach
                          </div>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection