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
                <img src="{{ url('public/logo.png?v0.1') }}" class="col-sm-12" alt="">
            </div>
            <div class="card-body">
                <h4>
                    فرم تقاضای نرخنامه
                </h4>
                <form action="javascript:void(0)" method="post" id="register-form" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="guild_name" placeholder="{{ __('guild name') }}">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="fullname" placeholder="{{ __('fullname') }}">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="national_id" placeholder="{{ __('national id') }}">
                    </div>
                    <div class="input-group mb-3">
                        {{ __('catagory') }}
                        <select name="catagory" class="select2" id="catagory" onchange="operation_license_visibility()">
                            @foreach (config('nerkhnameh_config.catagory') as $item)
                                <option value="{{$item}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3" id="operation-license-div"  style="display: none">
                        {{ __('operation license file') }}<br>
                        <input type="file" class="form-control" name="operation_license" style="width: 100%">
                    </div>
                    <div class="input-group mb-3">
                        {{ __('province and city') }}
                        <select name="city_id" id="" class="select2">
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->province }} - {{ $city->city }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="guild_number"
                            placeholder="{{ __('guild number') }}">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="tel" placeholder="{{ __('phone') }}">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="mobile" placeholder="{{ __('mobile') }}">
                    </div>
                    <div class="input-group mb-3">
                        <textarea type="text" class="form-control" name="address" placeholder="{{ __('address') }}"></textarea>
                    </div>

                    <div class="input-group mb-3">
                        {{ __('personal image file') }}<br>
                        <input type="file" class="form-control" name="personal_image_file" style="width: 100%">
                    </div>
                    <div class="input-group mb-3">
                        <input type="checkbox" name="commitment_file">
                        <p>
                            اینجانب ضمن رعایت ماده 17قانون نظام صنفی متعهد خواهم شد کالا و خدمات خود را بر اساس نرخ نامه 1403 اتحادیه ارائه نمایم و در غیر این صورت برابر مقررات جاری و مطابق با مواد 58 و 59 قانون نظام صنفی مشمول اعمال قانون خواهم شد.
همچنین بر همین اساس نسبت به عدم سوء استفاده و انتشار نرخ نامه برای دیگران نیز متعهد خواهم بود.
                        </p>
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-success" onclick="register()">{{ __('register') }}</button>
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

        function register() {
            var form = $('#register-form')[0]
            var fd = new FormData(form);

            send_ajax_formdata_request(
                "{{ route('nerkhnameh.register') }}",
                fd,
                function(response) {
                    console.log(response);
                    show_message("اطلاعات با موفقیت ثبت شد")
                    location.reload()
                },
                function(response) {
                    // console.log(response);
                    show_error(response)
                    hide_loading();
                }
            )
        }

        function operation_license_visibility(){
            var c = $('#catagory');
            var s = $('#operation-license-div');
            if( c.val() == "{{ config('nerkhnameh_config.catagory')[4] }}"){
                s.show();
            }else{
                s.hide()
            }
        }
    </script>
@endsection
