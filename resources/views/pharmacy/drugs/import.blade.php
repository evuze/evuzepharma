@extends('dashboard.breadmaster')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content-bread')
    <div class="panel">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if( session()->has('import_error') )
            @php
                $errors = session()->get('import_error');
            @endphp
            @if( is_array($errors) )
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors['rows'] as $key => $row)
                            <li>Error on row <u><b>{{ $row }}</b></u> : {{ $errors['errors'][$key] }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endif

        @if( session()->has('import_error_duplicate') )
            @php
                $errors = session()->get('import_error');
            @endphp
            @if( is_array($errors) )
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors as $row)
                            <li>Error: Duplicate on <u><b>{{ $row }}</b></u></li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endif

        <form role="form"
              class="form-edit-add"
              action="{{ route('import.drugs') }}"
              id="my-awesome-dropzone"
              method="POST" enctype="multipart/form-data">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="panel-title">
                            Importing Document
                        </h1>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary pull-right import disabled" disabled>Import</button>
                    </div>
                </div>                                
            </div>
                <!-- CSRF TOKEN -->
                {{ csrf_field() }}
            <div class="panel-body">
                <div class="form-group" style="margin: auto; width: 35%;">
                    <input type="file" id="file_import" name="file_import" style="display: block; margin: auto;opacity: 0.00;" />                    
                    <label for="file_import">  
                        <div style="cursor: pointer;" for="file_import">
                            <h1 align="center" style="text-align: center;">
                                <i class="glyphicon glyphicon-upload" for="file_import"></i>
                            </h1>
                            <h2 align="center" style="text-align: center;" for="file_import">Click to Upload Excel file.</h2>
                        </div>
                    </label>
                    <div style="text-align: left;" id="file_import_fake_value"> 
                        <label class="label label-default hidden" style="margin-right: 5px;">Selected File: </label>
                        <span class=""></span>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('javascript')    
    <script>    
        $(document).ready(function(){
            $(document).on("change", "#file_import",function(e){
                var name = $(this).val();
                var name = name.split('\\');
                var span = $("#file_import_fake_value span");
                //var ext = name.split('.').pop();
                var to = name.pop();
                var tmp = to;
                $("#file_import_fake_value label").removeClass("hidden").css({
                    'font-size' : '12px'
                });
                if( to.split(".").pop() == "xlsx" ){
                    span.removeClass('label label-warning')
                    span.addClass('label label-success');
                    $(".import").removeClass("disabled").attr("disabled", false);
                }
                else{
                    $(".import").addClass("disabled").attr("disabled", true);
                    span.removeClass('label label-success');
                    span.addClass('label label-warning');
                    alert("Not an excel file !!!");
                    //$(this).val("");
                }
                span.text(tmp).css({
                    'font-size' : '12px'
                });
            });
        });
    </script>
@endsection