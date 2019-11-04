@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1> {{ Lang::get('core.tickets') }}</h1>
    </section>

    <div class="content">
        <div class="box box-primary">

            <div class="box-header with-border">
{{--                @php--}}
{{--                    $setting =[--}}
{{--                         "gridtype" => "",--}}
{{--                         "orderby" => "airlineID",--}}
{{--                         "ordertype" => "asc",--}}
{{--                         "perpage" => "10",--}}
{{--                         "frozen" => "false",--}}
{{--                         "form-method" => "modal",--}}
{{--                         "view-method" => "modal",--}}
{{--                         "inline" => "false"--}}
{{--                       ];--}}
{{--                @endphp--}}
{{--                @include( 'mmb/toolbar')--}}
            </div>
            <a href="#" id="addBtn"><i class="fa fa-plus-square-o fa-2x"></i></a>
            <div class="table-responsive" style="min-height:300px; padding-bottom:60px; border: none !important">


                <table class="table table-striped ">
                    <thead>
                    <tr>
                        <th width="20"> No</th>
                        <th width="70">{{Lang::get('core.btn_action')}}</th>
                        <th>{{Lang::get('core.airlines')}}</th>
                        <th>{{Lang::get('core.from')}}</th>
                        <th>{{Lang::get('core.to')}}</th>
                        <th>{{Lang::get('core.departuredate')}}</th>
                        <th>{{Lang::get('core.flightNO')}}</th>
                        <th>{{Lang::get('core.returndate')}}</th>
                        <th>{{Lang::get('core.flightNO')}}</th>
                        <th>{{Lang::get('core.seats')}}</th>
                        <th>{{Lang::get('core.seatsavailable')}}</th>
                        <th>{{Lang::get('core.class')}}</th>
                        <th width="30">{{Lang::get('core.status')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $i=>$row)
                        <tr class="editable" id="form-{{ $row->bookflightID }}">
                            <td class="number"> <?php echo ++$i;?>  </td>
                            <td>

                                <div class=" action ">
                                    <a href="javascript:" data-id="{{$row->ticketID}}"
                                       class="tips edit" title="" data-original-title="Edit"><i
                                                class="fa fa-edit fa-2x"></i></a></div>
                            </td>
                            <td>


                                @foreach($row->airlines() as $a)
                                    <span>{{$a->airline??''}}</span>
                                @endforeach
                            </td>
                            <td>{{$row->from->airport_name}}</td>
                            <td>{{$row->to->airport_name}}</td>
                            <td>{{$row->departing}}</td>
                            <td>{{$row->depFlightNO}}</td>
                            <td>{{$row->returning}}</td>
                            <td>{{$row->arrFlightNO}}</td>
                            <td>{{$row->seats}}</td>
                            <td>{{$row->available_seats}}</td>
                            <td>
                                @if($row->class == '1')
                                    {{ __('core.economy')}}
                                @elseif($row->class == '2')
                                    {{ __('core.premiumeconomy')}}
                                @elseif($row->class == '3')
                                    {{ __('core.business') }}
                                @elseif($row->class == '4')
                                    {{ __('core.first')}}
                                @endif

                            </td>
                            <td>

                                @if($row['status'] == '2')
                                    <span class="label label-warning">{{ __('core.fr_pending') }}</span>
                                @elseif($row['status'] == '1')
                                    <span class="label label-success">{{ __('core.confirmed') }}</span>
                                @elseif($row['status'] == '0')
                                    <span class="label label-danger">{{ __('core.cancelled') }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>
    <!-- End Content -->




    <div class="modal fade in" id="mmb-modal"  role="dialog" style=" padding-right: 16px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-default">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">{{ __('core.addnew') }}</h4>
                </div>
                <div class="modal-body" id="mmb-modal-content">
                    <form method="POST" id="addForm"
                          accept-charset="UTF-8" class="form-horizontal" parsley-validate="" novalidate=" "
                          enctype="multipart/form-data" action="{{route('tickets.store')}}">
                        @csrf
                        <div class="col-md-12">
                            <fieldset>
                                <legend>  {{ Lang::get('core.tickets') }}</legend>

                            <div class="form-group  ">
                                <label for="Airlines"
                                       class=" control-label col-md-4 text-left">{{__('core.airlines')}} <span
                                            class="asterix"> * </span></label>
                                <div class="col-md-7">

                                    <select name="airlinesID[]" multiple="" rows="5" id="airlinesID"
                                            class="select2  select2-hidden-accessible parsley-validated" required=""
                                             aria-hidden="true">
                                        <option value="">-- Please Select --</option>
                                        @foreach($airlines as $airline)
                                            <option value="{{$airline->airlineID}}">{{$airline->airline}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  return">
                                <label for="Round Trip"
                                       class=" control-label col-md-4 text-left"> {{__('core.roundtrip')}}<span
                                            class="asterix"> * </span></label>
                                <div class="col-md-7">
                                    <label class='radio radio-inline'>
                                        <input type='radio' name='returnn' value='1' required
                                               @if($airline['returnn'] == '1') checked="checked" @endif > {{__('core.yes')}}
                                    </label>
                                    <label class='radio radio-inline'>
                                        <input type='radio' name='returnn' value='0' required
                                               @if($airline['returnn'] == '0') checked="checked" @endif > {{__('core.no')}}
                                    </label><br>

                                </div>
                            </div>
                            <div class="form-group  ">
                                <label for="Class" class=" control-label col-md-4 text-left"> {{__('core.class')}} <span
                                            class="asterix"> * </span></label>
                                <div class="col-md-8">

                                    <label class='radio radio-inline'>
                                        <input type='radio' name='class' value='1' required
                                               @if($airline['class'] == '1') checked="checked" @endif > {{__('core.economy')}}
                                    </label><br>
                                    <label class='radio radio-inline'>
                                        <input type='radio' name='class' value='2' required
                                               @if($airline['class'] == '2') checked="checked" @endif > {{__('core.premiumeconomy')}}
                                    </label><br>
                                    <label class='radio radio-inline'>
                                        <input type='radio' name='class' value='3' required
                                               @if($airline['class'] == '3') checked="checked" @endif > {{__('core.business')}}
                                    </label><br>
                                    <label class='radio radio-inline'>
                                        <input type='radio' name='class' value='4' required
                                               @if($airline['class'] == '4') checked="checked" @endif > {{__('core.first')}}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group  ">
                                <label for="Departure Airport"
                                       class=" control-label col-md-4 text-left"> {{__('core.departureairport')}} <span
                                            class="asterix"> * </span></label>
                                <div class="col-md-7">
                                    <select name="depairportID" rows="5" id="depairportID"
                                            class="select2  select2-hidden-accessible parsley-validated" required=""
                                             aria-hidden="true">
                                        <option value="">-- Please Select --</option>
                                        @foreach($airports as $airport)
                                            <option value="{{$airport->airportID}}">{{$airport->airport_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  ">
                                <label for="Depart Date"
                                       class=" control-label col-md-4 text-left">{{__('core.departure')}} <span
                                            class="asterix"> * </span></label>
                                <div class="col-md-4">
                                    <div class="input-group m-b" style="width:150px !important;">
                                        <input class="form-control datetime" style="width:150px !important;"
                                               name="departing" type="text" value="">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="arrFlightNO" id="arrFlightNO" value="marc" required=""
                                           class="form-control  parsley-validated" placeholder="Flight No">
                                </div>
                            </div>
                            <div class="form-group  ">
                                <label for="Arrival Airport" class=" control-label col-md-4 text-left"> Arrival Airport
                                    <span class="asterix"> * </span></label>
                                <div class="col-md-7">
                                    <select name="arrairportID" rows="5" id="arrairportID"
                                            class="select2  select2-hidden-accessible parsley-validated" required=""
                                             aria-hidden="true">
                                        <option value="">-- Please Select --</option>
                                        @foreach($airports as $airport)
                                            <option value="{{$airport->airportID}}">{{$airport->airport_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  returndate" style="display: block;">
                                <label for="Return Date"
                                       class=" control-label col-md-4 text-left"> {{__('core.return')}} </label>
                                <div class="col-md-4">
                                    <div class="input-group m-b" style="width:150px !important;">
                                        <input class="form-control datetime" style="width:150px !important;"
                                               name="returning" type="text" value="">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="depFlightNO" id="depFlightNO" value="" required=""
                                           class="form-control  parsley-validated" placeholder="Flight No">
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="price"
                                       class=" control-label col-md-4 text-left"> {{__('core.price')}} </label>
                                <div class="col-md-7">
                                    <input type="number" name="price" id="depFlightNO" value="" required=""
                                           class="form-control  parsley-validated" placeholder="{{__('core.price')}}">
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="seats"
                                       class=" control-label col-md-4 text-left"> {{__('core.seats')}} </label>
                                <div class="col-md-7">
                                    <input class="form-control"
                                           name="seats" type="number" value="">
                                </div>

                            </div>
                            <div class="form-group ">
                                <label for="available_seats"
                                       class=" control-label col-md-4 text-left"> {{__('core.seatsavailable')}} </label>
                                <div class="col-md-7">
                                    <input type="number" name="available_seats" id="available_seats" value=""
                                           class="form-control  parsley-validated">
                                </div>

                            </div>
                            <div class="form-group  status">
                                <label for="Status"
                                       class=" control-label col-md-4 text-left"> {{ __('core.status') }}</label>
                                <div class="col-md-8">
                                    <label class='radio radio-inline'>
                                        <input type='radio' name='status' value='2' required
                                               @if($airline['status'] == '2') checked="checked" @endif > {{ __('core.fr_pending') }}
                                    </label>
                                    <label class='radio radio-inline'>
                                        <input type='radio' name='status' value='1' required
                                               @if($airline['status'] == '1') checked="checked" @endif > {{ __('core.confirmed') }}
                                    </label>
                                    <label class='radio radio-inline'>
                                        <input type='radio' name='status' value='0' required
                                               @if($airline['status'] == '0') checked="checked" @endif > {{ __('core.cancelled') }}
                                    </label>
                                </div>
                            </div>
                                </fieldset>
                        </div>
                        <div style="clear:both"></div>

                        <div class="form-group">
                            <label class="col-sm-4 text-right">&nbsp;</label>
                            <div class="col-sm-8">
                                <button type="submit" id="storeBtn"
                                        class="btn btn-success btn-sm "> {{__('core.sb_save') }} </button>
                                <button type="button"
                                        class="btn btn-danger btn-sm"> {{ __('core.sb_cancel') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade in" id="edit-modal"  role="dialog" style=" padding-right: 16px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-default">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">{{__('core.edit')}}</h4>
                </div>
                <div class="modal-body" id="edit-modal-content">


                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $('#airlinesID').select2();
        $(document).on('click', '#addBtn', function () {
            $('#mmb-modal').modal('show');
        });
        $(document).on('click', '.edit', function () {
            var loader = $('.pageLoading');
            loader.show();
            var id = $(this).data('id');
            $.ajax({
                url: "{{route('tickets.getEdit')}}",
                method: "get",
                data: {id: id}
            })
                .done(function (data) {
                    if (data.status == 'success') {
                        $('#edit-modal-content').html(data.view);
                        $('#edit-modal').modal('show');

                    } else {
                        notyMessageError(data.message);
                        return false;
                    }
                    loader.hide();
                }).always(function () {
                loader.hide();
            });
        });


        $(document).on('submit', '#editForm', function (e) {
            var $this = $(this);
            var form = $this[0];
            e.preventDefault();
            if (form.checkValidity()) {
                var loader = $('.pageLoading');
                loader.show();
                $.ajax({
                    url: $this.attr('action'),
                    method: "post",
                    data: $('#editForm').serialize()
                })
                    .done(function (data) {
                        if (data.status == 'success') {
                            notyMessage(data.message);
                            $('#edit-modal').modal('hide');
                            setTimeout(location.reload.bind(location), 3000);

                        } else {
                            notyMessageError(data.message);
                            return false;
                        }

                        loader.hide();
                    }).always(function () {
                    loader.hide();
                });
            }


        });
        $(document).on('submit', '#addForm', function (e) {
            var form = $(this)[0];
            e.preventDefault();
            if (form.checkValidity()) {
                var loader = $('.pageLoading');
                loader.show();
                $.ajax({
                    url: "{{route('tickets.store')}}",
                    method: "post",
                    data: $('#addForm').serialize()
                })
                    .done(function (data) {
                        if (data.status == 'success') {
                            notyMessage(data.message);
                            $('#mmb-modal').modal('hide');
                            setTimeout(location.reload.bind(location), 3000);

                        } else {
                            notyMessageError(data.message);
                            return false;
                        }

                        loader.hide();
                    }).always(function () {
                    loader.hide();
                });
            }


        });


    </script>
@endsection