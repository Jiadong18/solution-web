<form method="POST" id="editForm"
      accept-charset="UTF-8" class="form-horizontal" parsley-validate="" novalidate=" "
      enctype="multipart/form-data" action="{{route('tickets.update',$ticket->ticketID)}}">
    @csrf
    <div class="col-md-12">
        <fieldset>
            <legend>  {{ Lang::get('core.tickets') }}</legend>
        <div class="form-group  ">
            <label for="Airlines"
                   class=" control-label col-md-4 text-left">{{__('core.airlines')}} <span
                        class="asterix"> * </span></label>
            <div class="col-md-7">

                <select name="airlinesID[]" multiple="" rows="5" id="editAirlinesID"
                        class="select2   parsley-validated" required=""
                        tabindex="-1" aria-hidden="true">
                    <option value="">-- Please Select --</option>
                    @php
                        $airlineIds = json_decode($ticket->airlinesID);
                    @endphp
                    @foreach($airlines as $airline)
                        <option {{ in_array($airline->airlineID,$airlineIds)?'selected':''}} value="{{$airline->airlineID}}">{{$airline->airline}}</option>
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
                           @if($ticket['returnn'] == '1') checked="checked" @endif > {{__('core.yes')}}
                </label>
                <label class='radio radio-inline'>
                    <input type='radio' name='returnn' value='0' required
                           @if($ticket['returnn'] == '0') checked="checked" @endif > {{__('core.no')}}
                </label><br>

            </div>
        </div>
        {{--                            <div class="form-group  ">--}}
        {{--                                <label for="Airline" class=" control-label col-md-4 text-left">{{__('core.airline')}}--}}
        {{--                                    <span--}}
        {{--                                            class="asterix"> * </span></label>--}}
        {{--                                <div class="col-md-7">--}}
        {{--                                    <select name="airlineID" rows="5" id="airlineID"--}}
        {{--                                            class="select2" required=""--}}
        {{--                                            tabindex="-1" aria-hidden="true">--}}
        {{--                                        <option value="">-- Please Select --</option>--}}
        {{--                                        @foreach($airlines as $airline)--}}
        {{--                                            <option value="{{$airline->airlineID}}">{{$airline->airline}}</option>--}}
        {{--                                        @endforeach--}}
        {{--                                    </select>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        <div class="form-group  ">
            <label for="Class" class=" control-label col-md-4 text-left"> {{__('core.class')}} <span
                        class="asterix"> * </span></label>
            <div class="col-md-8">

                <label class='radio radio-inline'>
                    <input type='radio' name='class' value='1' required
                           @if($ticket['class'] == '1') checked="checked" @endif > {{__('core.economy')}}
                </label><br>
                <label class='radio radio-inline'>
                    <input type='radio' name='class' value='2' required
                           @if($ticket['class'] == '2') checked="checked" @endif > {{__('core.premiumeconomy')}}
                </label><br>
                <label class='radio radio-inline'>
                    <input type='radio' name='class' value='3' required
                           @if($ticket['class'] == '3') checked="checked" @endif > {{__('core.business')}}
                </label><br>
                <label class='radio radio-inline'>
                    <input type='radio' name='class' value='4' required
                           @if($ticket['class'] == '4') checked="checked" @endif > {{__('core.first')}}
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
                        tabindex="-1" aria-hidden="true">
                    <option value="">-- Please Select --</option>
                    @foreach($airports as $airport)
                        <option {{$airport->airportID==$ticket->depairportID?'selected':''}} value="{{$airport->airportID}}">{{$airport->airport_name}}</option>
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
                           name="departing" type="text" value="{{$ticket->departing}}">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-3">
                <input type="text" name="arrFlightNO" id="arrFlightNO"  required=""
                       class="form-control  parsley-validated" placeholder="Flight No" value="{{$ticket->arrFlightNO}}">
            </div>
        </div>
        <div class="form-group  ">
            <label for="Arrival Airport" class=" control-label col-md-4 text-left"> Arrival Airport
                <span class="asterix"> * </span></label>
            <div class="col-md-7">
                <select name="arrairportID" rows="5" id="arrairportID"
                        class="select2  select2-hidden-accessible parsley-validated" required=""
                        tabindex="-1" aria-hidden="true">
                    <option value="">-- Please Select --</option>
                    @foreach($airports as $airport)
                        <option {{$airport->airportID==$ticket->arrairportID?'selected':''}} value="{{$airport->airportID}}">{{$airport->airport_name}}</option>
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
                           name="returning" type="text" value="{{$ticket->returning}}">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-3">
                <input type="text" name="depFlightNO" id="depFlightNO" value="{{$ticket->depFlightNO}}" required=""
                       class="form-control  parsley-validated" placeholder="Flight No">
            </div>
        </div>

        <div class="form-group ">
            <label for="price"
                   class=" control-label col-md-4 text-left"> {{__('core.price')}} </label>
            <div class="col-md-7">
                <input type="number" name="price" id="price" value="{{$ticket->price}}" required=""
                       class="form-control  parsley-validated" placeholder="{{__('core.price')}}">
            </div>
        </div>

        <div class="form-group ">
            <label for="seats"
                   class=" control-label col-md-4 text-left"> {{__('core.seats')}} </label>
            <div class="col-md-7">
                <input class="form-control"
                       name="seats" type="number" value="{{$ticket->seats}}">
            </div>

        </div>
        <div class="form-group ">
            <label for="available_seats"
                   class=" control-label col-md-4 text-left"> {{__('core.seatsavailable')}} </label>
            <div class="col-md-7">
                <input type="number" name="available_seats" id="available_seats" value="{{$ticket->available_seats}}"
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

<script>
	$('#editAirlinesID').select2();
</script>