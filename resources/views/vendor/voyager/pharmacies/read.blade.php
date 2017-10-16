@extends('voyager::master')

@section('page_title','View '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> Viewing {{ ucfirst($dataType->display_name_singular) }} &nbsp;
        
            @if (Voyager::can('edit_'.$dataType->name))
            <a href="{{ route('voyager.'.$dataType->slug.'.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>&nbsp;
                Edit
            </a>
            @endif
            @if( request()->has('ph') )
                <a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-warning">
                    <span class="glyphicon glyphicon-list"></span>&nbsp;
                    Return to List
                </a>
            @else
                <a href="{{ url()->previous() }}" class="btn btn-warning">
                    <span class="glyphicon glyphicon-list"></span>&nbsp;
                    Return to List
                </a>
            @endif       
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-8">

                <div class="panel panel-bordered" style="padding-bottom:5px;">

                    <!-- /.box-header -->
                    <!-- form start -->

                    @foreach($dataType->readRows as $row)
                        @php $rowDetails = json_decode($row->details); @endphp

                        <div class="panel-heading" style="border-bottom:0;">
                            <h3 class="panel-title">{{ $row->display_name }}</h3>
                        </div>

                        <div class="panel-body" style="padding-top:0;">
                            @if($row->type == "image")
                                <img class="img-responsive" width="200px"
                                     src="{{ Voyager::image($dataTypeContent->{$row->field}) }}">
                            @elseif($row->type == 'select_dropdown' && property_exists($rowDetails, 'options') &&
                                    !empty($rowDetails->options->{$dataTypeContent->{$row->field}})
                            )

                                <?php echo $rowDetails->options->{$dataTypeContent->{$row->field}};?>
                            @elseif($row->type == 'select_dropdown' && $dataTypeContent->{$row->field . '_page_slug'})
                                <a href="{{ $dataTypeContent->{$row->field . '_page_slug'} }}">{{ $dataTypeContent->{$row->field}  }}</a>
                            @elseif($row->type == 'select_multiple')
                                @if(property_exists($rowDetails, 'relationship'))

                                    @foreach($dataTypeContent->{$row->field} as $item)
                                        @if($item->{$row->field . '_page_slug'})
                                        <a href="{{ $item->{$row->field . '_page_slug'} }}">{{ $item->{$row->field}  }}</a>@if(!$loop->last), @endif
                                        @else
                                        {{ $item->{$row->field}  }}
                                        @endif
                                    @endforeach

                                @elseif(property_exists($rowDetails, 'options'))
                                    @foreach($dataTypeContent->{$row->field} as $item)
                                     {{ $rowDetails->options->{$item} . (!$loop->last ? ', ' : '') }}
                                    @endforeach
                                @endif
                            @elseif($row->type == 'date')
                                {{ $rowDetails && property_exists($rowDetails, 'format') ? \Carbon\Carbon::parse($dataTypeContent->{$row->field})->formatLocalized($rowDetails->format) : $dataTypeContent->{$row->field} }}
                            @elseif($row->type == 'checkbox')
                                @if($rowDetails && property_exists($rowDetails, 'on') && property_exists($rowDetails, 'off'))
                                    @if($dataTypeContent->{$row->field})
                                    <span class="label label-info">{{ $rowDetails->on }}</span>
                                    @else
                                    <span class="label label-primary">{{ $rowDetails->off }}</span>
                                    @endif
                                @else
                                {{ $dataTypeContent->{$row->field} }}
                                @endif
                            @elseif($row->type == 'rich_text_box')
                                @include('voyager::multilingual.input-hidden-bread-read')
                                <p>{{ strip_tags($dataTypeContent->{$row->field}, '<b><i><u>') }}</p>
                            @else
                                @include('voyager::multilingual.input-hidden-bread-read')
                                <p>{{ $dataTypeContent->{$row->field} }}</p>
                            @endif
                        </div><!-- panel-body -->
                        @if(!$loop->last)
                            <hr style="margin:0;">
                        @endif
                    @endforeach

                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Partnered Insurances</h3>
                    </div>
                    <div class="panel-body">
                        @if($dataTypeContent->getInsurance()->count()  > 0 )
                            <ol style="list-style: none; padding: 5px;margin: 0px;">
                            @foreach($dataTypeContent->getInsurance()->get() as $data )
                                <li> 
                                    <label class="label label-primary"> {{ getInsuranceFrom($data->insurance_id) ? getInsuranceFrom($data->insurance_id)->full_name : "Not Assigned !!"  }} </label>                                    
                                    <button class="label label-danger delete" 
                                            title="Destroy Partnership"
                                            data-id="{{ $data->id }}" 
                                            id="delete-{{ $data->id }}"
                                            style="margin-left: 5px; border: none;"> 
                                        <i class="voyager-x" style="padding-top: 5px;"></i> 
                                    </button>
                                </li> 
                            @endforeach
                            </ol>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Are you sure you want to destroy
                        this relationship ?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ url('admin/partnership/desrtoy')  }}" id="delete_form" method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                                 value="Yes, i am sure !!">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')
    @if ($isModelTranslatable)
    <script>
        $(document).ready(function () {
            $('.side-body').multilingual();
            var deleteFormAction;
            $('ol li').on('click', '.delete', function (e) {
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
        });
    </script>
    <script src="{{ voyager_asset('js/multilingual.js') }}"></script>
    @endif
    <script>
        $(document).ready(function () {
            var deleteFormAction;
            $('ol li').on('click', '.delete', function (e) {
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
        });
    </script>
@stop
