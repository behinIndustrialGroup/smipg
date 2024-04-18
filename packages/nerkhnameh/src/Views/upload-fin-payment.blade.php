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
                    جهت مشاهده وضعیت پرداخت اطلاعات زیر را تکمیل کنید
                </p>
                <form action="javascript:void(0)" method="post" id="fin-form" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="national_id" placeholder="{{ __('national id') }}">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="guild_number"
                            placeholder="{{ __('guild number') }}">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="mobile" placeholder="{{ __('mobile') }}">
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-success" onclick="check()">{{ __('check') }}</button>
                    </div>
                    <div class="col-sm-12" id="fin-datails-div">

                    </div>
                </form>

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
            var form = $('#fin-form')[0]
            var fd = new FormData(form);

            send_ajax_formdata_request(
                "{{ route('nerkhnameh.finPayment.check') }}",
                fd,
                function(response) {
                    console.log(response);
                    show_message("{{ __('Data Founded') }}")
                    fin_details_div = $('#fin-datails-div')
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
