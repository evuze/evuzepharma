@extends("voyager::master")

@section('page_title','Import '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> @if(isset($dataTypeContent->id)){{ 'Edit' }}@else{{ 'Import' }}@endif {{ $dataType->display_name_singular }}
        <a href="{{ route('voyager.'. $dataType->slug.".index") }}" class="btn btn-sm btn-warning" style="margin-left: 10px;">Return To List</a>
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section("content")
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-heading" style="padding-left: 15px;">
                        <h3 class="panel-title">@if(isset($dataTypeContent->id)){{ 'Edit' }}@else{{ 'Import' }}@endif {{ $dataType->display_name_plural }}</h3>
                    </div>
                    {!! Form::open(array('route' => 'import-csv-excel', 'method'=>'POST', 'files'=>'true')) !!}
                    {!! Form::hidden('dataType', $dataType->slug) !!}
                    <div class="panel-body">
                        @if( session()->has('error') )
                            <div class="alert alert-danger">
                                {!! session()->pull('error') !!}
                            </div>
                        @endif
                        <div class="form-group">
                            {!! Form::label('file_to_import', 'Select File to Import:', ['class'=>'col-md-12']) !!}
                            <div class="col-md-12">
                                {!! Form::file('file_to_import', array('class' => 'form-control')) !!}
                                {!! $errors->first('file_to_import', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="form-group" style="padding-left: 15px;">
                            {!! Form::submit('Upload',['class'=>'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        var params = {}
        var $image

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if( session()->has('success') )
                toastr.success("{{ session()->pull('success')  }}");
            @endif

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.media.remove') }}', params, function (response) {
                    if ( response
                            && response.data
                            && response.data.status
                            && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $image.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing image.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script src="{{ voyager_asset('lib/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ voyager_asset('js/voyager_tinymce.js') }}"></script>
    <script src="{{ voyager_asset('lib/js/ace/ace.js') }}"></script>
    <script src="{{ voyager_asset('js/voyager_ace_editor.js') }}"></script>
    <script src="{{ voyager_asset('js/slugify.js') }}"></script>
@stop