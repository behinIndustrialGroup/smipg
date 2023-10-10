<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="{{ url('public/dashboard/plugins/font-awesome/css/font-awesome.min.css') . '?' . config('app.version') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet"
        href="{{ url('public/dashboard/dist/css/adminlte.min.css') . '?' . config('app.version') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- bootstrap rtl -->
    <link rel="stylesheet"
        href="{{ url('public/dashboard/dist/css/bootstrap-rtl.min.css') . '?' . config('app.version') }}">
    <!-- template rtl version -->
    <link rel="stylesheet"
        href="{{ url('public/dashboard/dist/css/custom-style.css') . '?' . config('app.version') }}">
    <link rel="stylesheet" href="{{ url('public/dashboard/dist/css/custom.css') . '?' . config('app.version') }}">

    {{-- <link rel="stylesheet" href="{{ url('public/dashboard/dist/css/custom.css')  . '?' . config('app.version') }}"> --}}
    <link rel="stylesheet" type="text/css"
        href="{{ url('public/dashboard/plugins/datatables/dataTables.bootstrap4.css') . '?' . config('app.version') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @yield('style')

    <script src="{{ url('public/dashboard/plugins/jquery/jquery.min.js') . '?' . config('app.version') }}"></script>
    <script src="{{ url('public/dashboard/plugins/datatables/jquery.dataTables.js') . '?' . config('app.version') }}">
    </script>
    <script src="{{ url('public/dashboard/plugins/datatables/dataTables.bootstrap4.js') . '?' . config('app.version') }}">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{ url('public/js/ajax.js') . '?' . config('app.version') }}"></script>
    <script src="{{ url('public/js/dataTable.js') . '?' . config('app.version') }}"></script>
    <script src="{{ url('public/js/dropzone.js') . '?' . config('app.version') }}"></script>

</head>

<body class="login-page">
    @yield('content')



    <footer class="main-footer" style="margin: 0">
        <strong> &copy; {{date('Y')}} - تمامی حقوق محفوظ است - <a href="https://smipg.ir">اتحادیه کشوری فروشندگان و تولیدکنندگان گازهای طبی و صنعتی</a></strong>
    </footer>


    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script
        src="{{ url('public/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') . '?' . config('app.version') }}">
    </script>
    <!-- Morris.js charts -->
    <script src="{{ url('public/dashboard/dist/js/adminlte.js') . '?' . config('app.version') }}"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

    <script>
        // $(document).ready(function() {
        //     $('#table').DataTable({
        //         dom: 'Bfltip',
        //         buttons: [{
        //             'extend': 'excel',
        //             'text': 'Excel',
        //             className: 'btn btn-info'
        //         }],
        //         'ajax': ''
        //     });
        //     $('table').attr('style', 'font-weight:bold; font-size: 12px')

        //     initial_view();
        //     hide_loading();
        // });

        function initial_view() {
            $('.select2').select2();
            $(".persian-date").persianDatepicker({
                viewMode: 'year',
                format: 'YYYY-MM-DD',
                initialValueType: 'persian'
            });
        }
    </script>

    <script>
        $('form').keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
            }
        });
    </script>
    <script src="{{ url('public/js/loader.js') . '?' . config('app.version') }}"></script>
    <script src="{{ url('public/js/clearcach.js') . '?' . config('app.version') }}"></script>
    <script src="{{ url('public/js/scripts.js') . '?' . config('app.version') }}"></script>

    @yield('script')
    </div>



</body>

</html>
