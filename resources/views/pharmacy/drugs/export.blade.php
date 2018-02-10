@extends('dashboard.breadmaster')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('dashboard/assets/rcswitcher/css/rcswitcher.css') }}">
    <style>
        .dataTables_filter {
            float: right;
        }
    </style>
@stop

@section('content-bread')
    <div class="panel">
        <div class="panel-heading">
            <h1 class="panel-title">
                Exporting Options
            </h1>
        </div>
        <div class="panel-body">
            <!-- form start -->
            <form role="form"
                  class="form-edit-add"
                  action="{{ route('exportformat.drugs') }}"
                  method="POST" enctype="multipart/form-data">

            <!-- CSRF TOKEN -->
                {{ csrf_field() }}

                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="options" id="optionsRadios1" value="1" data-toggle="radio" checked>
                                        All Drugs List
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="options" id="optionsRadios2" value="2" data-toggle="radio" >
                                        All less 35% in store
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="options" id="optionsRadios4" value="4" data-toggle="radio" >
                                        All expired
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="options" id="optionsRadios3" value="3" data-toggle="radio" >
                                        Custom List
                                    </label>
                                </div>
                                <div class="well count-checked hidden" style="padding: 5px;margin-left: 20px;">
                                    <i class="glyphicon glyphicon-check"></i>
                                    <span>0</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 iframe hidden" style="height: 500px;overflow: auto;">
                            <table id="dataTable" class="table">
                                <thead>
                                    <th width="50px" align="center" style="vertical-align: middle;">
                                        <input type="checkbox" name="all" value="100" id="all-chechbox" disabled>
                                    </th>
                                    <th style="vertical-align: middle">Medecine</th>
                                </thead>
                                @php
                                    $drugs = \App\Drug::all(['id', 'full_name']);
                                @endphp
                                <tbody>
                                    
                                    @if($drugs != null)
                                        @foreach($drugs as $drug)
                                        <tr>
                                            <td width="50px" align="center" style="vertical-align: middle;">
                                                <input type="checkbox" 
                                                       name="medecine[]" 
                                                       value="{{ $drug->id }}" 
                                                       id="all-chechbox-{{ $drug->id }}" 
                                                       class="thebox">
                                            </td>
                                            <td style="vertical-align: middle;cursor: pointer;">
                                                <label for="all-chechbox-{{ $drug->id }}" style="cursor: pointer;">
                                                    {{ strtoupper($drug->full_name) }}
                                                </label>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- panel-body -->

                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary save">Export</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Delete File Modal -->
@endsection

@section('javascript')
    <script src="{{ voyager_asset('lib/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/rcswitcher/js/rcswitcher.js') }}"></script>

    <script>
        var params = {}
        var $image

        $('document').ready(function () {
            // Checkboxes and Radio buttons
            var table = $('#dataTable').DataTable({
                "order": [],
                pageLength: 5,
                responsive: true
            });
            var countChecked = function($table, checkboxClass) {
                if ($table) {
                    // Find all elements with given class
                    var chkAll = $table.rows()
                                        .nodes()
                                        .to$()
                                        .find(checkboxClass);

                    // Count checked checkboxes
                    var bo = chkAll.filter(':checked');
                    var checked = chkAll.filter(':checked').length;
                    // Count total
                    var total = chkAll.length;    
                    // Return an object with total and checked values
                    return {
                        total: total,
                        checked: checked,
                        checkboxs: bo
                    }
                }
            }
            $('[data-toggle="radio"]').rcSwitcher({
                onText: 'YES',
                offText: 'NO',
                theme: 'flat',
            })
            .on( 'turnon.rcSwitcher', function( e, data){
                var inputID = data.$input[0].id;
                var iframe = $(".iframe");
                var bp = $(".count-checked");
                if( inputID === "optionsRadios3" ){
                    iframe.removeClass('hidden');
                    bp.removeClass('hidden');
                    var $checkboxes = iframe.find('* .thebox');
                    $(document).on('change', '.thebox', function() {
                        var result = countChecked(table, '.thebox');
                        bp.find('span').text(result.checked + " - "+ result.total);
                    });
                    $("form").submit(function(e) {
                        var form = this;
                        var result = countChecked(table, '.thebox');
                        params = result.checkboxs.serializeArray();
                        // Iterate over all form elements
                        $.each(params, function(){
                            // If element doesn't exist in DOM
                            if(!$.contains(document, form[this.name])){
                                // Create a hidden element
                                $(form).append(
                                $('<input>')
                                    .attr('type', 'hidden')
                                    .attr('name', this.name)
                                    .val(this.value)
                                );
                            }
                        });
                        console.log(params);
                    });

                }else{
                    table.rows()
                         .nodes()
                         .to$()      // Convert to a jQuery object
                         .find('input[type="checkbox"].thebox:checked').prop('checked', false);
                    bp.find('span').text("0");
                    bp.addClass('hidden');
                    iframe.addClass('hidden');
                }
			});

            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                }
            });
            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop