@extends('layouts.guest')

@section('style')
    <style>
        body {
            background: url('{{ url('public/packages/nerkhnameh/bg.jpg') }}') !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
            background-position: center center;
        }

        @keyframes fadeInOut {
            0% {
                top: -50px
            }

            /* Start with transparency */
            50% {
                top: 0
            }

            /* Fully visible halfway through */
        }

        #etelaeie {
            position: relative;
            animation-name: fadeInOut;
            animation-duration: 3s;
            /* Animation duration (in seconds) */
        }
    </style>
@endsection

@section('content')
    <div class="register-box" style="margin: 2% auto !important">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <img src="{{ url('public/logo.png') }}" class="col-sm-12" alt="">
            </div>
            <div class="card-body">
                <p>
                    جهت دانلود نرخنامه اطلاعات زیر را وارد کنید
                </p>
                @include('NerkhnamehView::partial-view.find-inputs')
                

            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        var register_box_h = parseInt(($('.register-box').css('height')).split('px')[0])
        var login_page_h = parseInt(($('.login-page').css('height')).split('px')[0])
        var footer_h = parseInt(($('footer').css('height')).split('px')[0])
        $('.register-box').css('height', login_page_h + footer_h + 150 + 'px')
        initial_view()

        function check() {
            var form = $('#find-form')[0]
            var fd = new FormData(form);

            send_ajax_formdata_request(
                "{{ route('nerkhnameh.download.check') }}",
                fd,
                function(response) {
                    console.log(response);
                    show_message("{{ trans('Data Founded') }}")
                    fin_details_div = $('#details-div')
                    fin_details_div.html('') // clear the div 
                    fin_details_div.html(response)
                },
                function(response) {
                    // console.log(response);
                    show_error(response)
                    hide_loading();
                }
            )
        }
    </script>
@endsection
