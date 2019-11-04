<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@if ( $pageTitle != NULL ) {{ $pageTitle }} | @endif ManageMyBookings </title>
    <link rel="shortcut icon" href="{{ asset('favicon.png')}}" type="image/x-icon">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('mmb')}}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('mmb')}}/css/animate.css">
    <link rel="stylesheet" href="{{ asset('mmb')}}/js/summernote/dist/summernote.css">
    <link rel="stylesheet" href="{{ asset('mmb')}}/css/Grace.css">
    <link rel="stylesheet" href="{{ asset('mmb')}}/css/line-awesome-font-awesome.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <script src="{{ asset('mmb')}}/js/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/jquery.cookie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script type="text/javascript" src="{{ asset('mmb/js/leo.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mmb')}}/js/bootstrap.js"></script>
    <script type="text/javascript" src="{{ asset('mmb')}}/js/summernote/dist/summernote.js"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/simpleclone.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/datetimepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/parsley.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/form.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/jCombo.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/grace.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/toastr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/slimscroll.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/icheck.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/app.js')}}"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/fancybox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/spin.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/datatables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/confirmation.js') }}"></script>
    <script type="text/javascript" src="{{ asset('mmb/js/theia-sticky-sidebar.js') }}"></script>

    <style>
        .select2-container{
            width: 100% !important;
        }
        .select2-container--open {
            z-index: 9999999
        }
    </style>
</head>
<body class="hold-transition skin-black fixed sidebar-mini">
    <div class="wrapper">
        @include('layouts/top') @include('layouts/left')
        <div class="content-wrapper">
            <div class="pageLoading"></div>
            @yield('content')
        </div>
        @include('layouts/right')
        <div class="control-sidebar-bg"></div>
        <div class="modal fade" id="mmb-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-default">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body" id="mmb-modal-content">

                    </div>
                </div>
            </div>
        </div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b><a href="https://www.managemybookings.net" target="_blank">ManageMyBookings</a> {{Lang::get('core.version')}}</b> 1.0.0
            </div>
            <strong> {{ Lang::get('core.copyright') }} &copy; {{ date('Y')}} {{ CNF_COMNAME }}.</strong> {{Lang::get('core.allrights')}}.
        </footer>
        <div class="control-sidebar-bg"></div>
    </div>
    {{ \App\Library\SiteHelpers::showNotification() }}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            setInterval(function() {
                var noteurl = $('.notif-value').attr('code');
                $.get('{{ url("notification/load") }}', function(data) {
                    $('.notif-alert').html(data.total);
                    var html = '';
                    $.each(data.note, function(key, val) {
                        html += '<li><a href="' + val.url + '"> <div> <i class="' + val.icon + ' fa-fw"></i> ' + val.title + '  <span class="pull-right text-muted small">' + val.date + '</span></div></li>';
                    });
                    $('.notification-menu').html(html);
                });
            }, 60000);
        });;
    </script>

@yield('script')
</body>
</html>
