@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1> {{ Lang::get('core.staffs') }}</h1>
    </section>

    <div class="content">
        <div class="box box-primary">
            <a href="#" id="addBtn"><i class="fa fa-plus-square-o fa-2x"></i></a>
            <div class="table-responsive" style="min-height:300px; padding-bottom:60px; border: none !important">


                <table class="table table-striped ">
                    <thead>
                    <tr>
                        <th width="20"> No</th>
                        <th width="30"><input type="checkbox" class="checkall"/></th>
                        <th width="50"><?php echo Lang::get('core.btn_action');?></th>
                        <th><?php echo Lang::get('core.stafftype');?></th>
                        <th><?php echo Lang::get('core.staffname');?></th>
                        <th><?php echo Lang::get('core.email');?></th>
                        <th><?php echo Lang::get('core.phone');?></th>
                        <th><?php echo Lang::get('core.address');?></th>
                        <th><?php echo Lang::get('core.city');?></th>
                        <th><?php echo Lang::get('core.country');?></th>
                        <th width="30"><?php echo Lang::get('core.status');?></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $i=>$row)
                        <tr class="editable" id="form-{{ $row->staffID }}">
                            <td class="number"> <?php echo ++$i;?>  </td>
                            <td>

                                <div class=" action ">
                                    <a href="javascript:" data-id="{{$row->staffID}}"
                                       class="tips edit" title="" data-original-title="Edit"><i
                                                class="fa fa-edit fa-2x"></i></a></div>
                            </td>
                            <td>

                            </td>
                            <td>{{$row->staffType->staff_type}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->phone}}</td>
                            <td>{{$row->address}}</td>
                            <td>{{$row->city->city_name}}</td>
                            <td>{{$row->country->country_name}}</td>
                            <td>
                                @if($row->status == 0)
                                    {{ __('core.fr_minactive')}}
                                @elseif($row->status == 1)
                                    {{ __('core.fr_mactive')}}
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




    <div class="modal fade in" id="mmb-modal" role="dialog" style=" padding-right: 16px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-default">
                    <button type="button " class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">{{ __('core.addnew') }}</h4>
                </div>
                <div class="modal-body" id="mmb-modal-content">

                    <form method="POST" id="addForm"
                          accept-charset="UTF-8" class="form-horizontal" parsley-validate="" novalidate=" "
                          enctype="multipart/form-data" action="{{route('staffs.store')}}">
                        @csrf
                        <div class="col-md-12">
                            <fieldset>
                                <legend> {{ Lang::get('core.staffs') }}</legend>
                                <div class="form-group  ">
                                    <label for="Staff type"
                                           class=" control-label col-md-4 text-left">{{ Lang::get('core.stafftype') }}
                                        <span
                                                class="asterix"> * </span></label>
                                    <div class="col-md-6">
                                        <select name='stafftypeID' rows='5' id='stafftypeID' class='select2 ' required>

                                            <option value="">-- Please Select --</option>
                                            @foreach($staff_types as $staff)
                                                <option value="{{$staff->stafftypeID}}">{{$staff->staff_type}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-2">

                                    </div>
                                </div>
                                <div class="form-group  ">
                                    <label for="Supplier Name"
                                           class=" control-label col-md-4 text-left"> {{ Lang::get('core.staffname') }}
                                        <span class="asterix"> * </span></label>
                                    <div class="col-md-6">
                                        <input type='text' name='name' id='name'
                                               required class='form-control '/>
                                    </div>
                                    <div class="col-md-2">

                                    </div>
                                </div>
                                <div class="form-group  ">
                                    <label for="Email"
                                           class=" control-label col-md-4 text-left"> {{ Lang::get('core.email') }}
                                        <span
                                                class="asterix"> * </span></label>
                                    <div class="col-md-6">
                                        <input type='text' name='email' id='email' value=''
                                               required class='form-control '/>
                                    </div>
                                    <div class="col-md-2">

                                    </div>
                                </div>
                                <div class="form-group  ">
                                    <label for="Phone"
                                           class=" control-label col-md-4 text-left"> {{ Lang::get('core.phone') }} </label>
                                    <div class="col-md-6">
                                        <input type='text' name='phone' id='phone' value=''
                                               class='form-control '/>
                                    </div>
                                    <div class="col-md-2">

                                    </div>
                                </div>
                                <div class="form-group  ">
                                    <label for="Address"
                                           class=" control-label col-md-4 text-left"> {{ Lang::get('core.address') }} </label>
                                    <div class="col-md-6">
										  <textarea name='address' rows='5' id='address' class='form-control '
                                          ></textarea>
                                    </div>
                                    <div class="col-md-2">

                                    </div>
                                </div>
                                <div class="form-group  ">
                                    <label for="Country"
                                           class=" control-label col-md-4 text-left"> {{ Lang::get('core.country') }}
                                        <span
                                                class="asterix"> * </span></label>
                                    <div class="col-md-6">
                                        <select name='countryID' rows='5' id='countryID' class='select2 ' required>

                                            <option value="">-- Please Select --</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->countryID}}">{{$country->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">

                                    </div>
                                </div>
                                <div class="form-group  ">
                                    <label for="City"
                                           class=" control-label col-md-4 text-left"> {{ Lang::get('core.city') }} <span
                                                class="asterix"> * </span></label>
                                    <div class="col-md-6">
                                        <select name='cityID' rows='5' id='cityID' class='select2 ' required>

                                            <option value="">-- Please Select --</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->cityID}}">{{$city->city_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">

                                    </div>
                                </div>
                                <div class="form-group  ">
                                    <label for="Status"
                                           class=" control-label col-md-4 text-left"> {{ Lang::get('core.status') }}
                                        <span
                                                class="asterix"> * </span></label>
                                    <div class="col-md-6">

                                        <label class='radio radio-inline'>
                                            <input type='radio' name='status' value='0' required
                                            > {{ Lang::get('core.fr_minactive') }}
                                        </label>
                                        <label class='radio radio-inline'>
                                            <input type='radio' name='status' value='1' required
                                            > {{ Lang::get('core.fr_mactive') }}
                                        </label>
                                    </div>
                                    <div class="col-md-2">

                                    </div>
                                </div>
                            </fieldset>
                        </div>


                        <div style="clear:both"></div>

                        <div class="form-group">
                            <label class="col-sm-4 text-right">&nbsp;</label>
                            <div class="col-sm-8">
                                <button type="submit" id="storeBtn" class="btn btn-primary btn-sm "><i
                                            class="fa fa-play-circle"></i> {{ Lang::get('core.sb_save') }} </button>
                                <button type="button"  onclick="modalClose('add')" class="btn btn-danger btn-sm"><i
                                            class="fa fa-remove "></i> {{ Lang::get('core.sb_cancel') }} </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade in" id="edit-modal" role="dialog" style=" padding-right: 16px;">
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
        $('#stafftypeID').select2();

        $(document).on('click', '#addBtn', function () {
            $('#mmb-modal').modal('show');
        });
        $(document).on('click', '.edit', function () {
            var loader = $('.pageLoading');
            loader.show();
            var id = $(this).data('id');
            $.ajax({
                url: "{{route('staffs.edit')}}",
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
                    url: "{{route('staffs.store')}}",
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