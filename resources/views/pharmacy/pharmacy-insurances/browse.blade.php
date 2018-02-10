@extends('dashboard.breadmaster')

@section('content-bread')
    <div class="panel">
        <div class="panel-heading">
            <h1 class="panel-title"> {{ ucwords(str_replace(":", ucfirst(getCurrentPharmacy()->name), $dataType->display_name_plural)." list") }} </h1>
        </div>
        <div class="panel-body">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Short Name</th>
                    <th class="actions" width="100px">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dataTypeContent as $data)
                    @php
                        $id = getInsuranceFrom($data->insurance_id) ? getInsuranceFrom($data->insurance_id)->id : "";
                        $name = getInsuranceFrom($data->insurance_id) ? getInsuranceFrom($data->insurance_id)->full_name : "";
                        $short = getInsuranceFrom($data->insurance_id) ? getInsuranceFrom($data->insurance_id)->short_name : "";
                    @endphp
                    <tr style="cursor: pointer;">
                        <td>
                            <a href="{{ route('voyager.'.$dataType->slug.'.show', $id) }}" title="{{ strtoupper($name) }}">{{ strtoupper($name) }}</a>
                        </td>
                        <td>{{ strtoupper($short) }}</td>
                        <td class="no-sort no-click" id="bread-actions" >
                            <a href="{{ route('get.insurance.drugs', $id) }}" title="Drugs" class="btn btn-sm btn-success pull-left insurance"
                                data-id="{{ $id }}" id="insurance-{{ $id }}" style="margin-right: 5px;" >
                                <i class="voyager-droplet"></i> <span class="hidden-xs hidden-sm">Drugs</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @if (isset($dataType->server_side) && $dataType->server_side)
                <div class="pull-left">
                    <div role="status" class="show-res" aria-live="polite">Showing {{ $dataTypeContent->firstItem() }}
                        to {{ $dataTypeContent->lastItem() }} of {{ $dataTypeContent->total() }} entries
                    </div>
                </div>
                <div class="pull-right">
                    {{ $dataTypeContent->links() }}
                </div>
            @endif
        </div>
    </div>
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Are you sure you want to delete
                        this {{ strtolower($dataType->display_name_singular) }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="Yes, delete this {{ strtolower($dataType->display_name_singular) }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection


@section('javascript')
    <!-- DataTables -->
    @if(!$dataType->server_side && config('dashboard.data_tables.responsive'))
        <script src="{{ voyager_asset('lib/js/dataTables.responsive.min.js') }}"></script>
    @endif
    @if($isModelTranslatable)
        <script src="{{ voyager_asset('js/multilingual.js') }}"></script>
    @endif
    <script>
        $(document).ready(function () {
                    @if (!$dataType->server_side)
            var table = $('#dataTable').DataTable({
                        "order": []
                        @if(config('dashboard.data_tables.responsive')), responsive: true @endif
                    });
            @endif

            @if ($isModelTranslatable)
                $('.side-body').multilingual();
            @endif
            $("#dataTable_filter").addClass('pull-right');
        });

        var deleteFormAction;
        $('td').on('click', '.delete', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) { // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction.match(/\/[0-9]+$/)
                    ? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
                    : deleteFormAction + '/' + $(this).data('id');
            console.log(form.action);

            $('#delete_modal').modal('show');
        });
    </script>
@stop