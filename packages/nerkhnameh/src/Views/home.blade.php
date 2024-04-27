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
                <button class="btn btn-danger col-sm-12 m-1" onclick="goto_page(1)">1- {{ __('register nerkhnameh') }}</button>
                <button class="btn btn-info col-sm-12 m-1" onclick="goto_page(2)">2- {{ __('upload fin payment file') }}</button>
                <button class="btn btn-success col-sm-12 m-1" onclick="goto_page(3)">3- {{ __('download nerkhnameh') }}</button>
                <hr>
                <button class="btn btn-danger col-sm-12 m-1" onclick="goto_page(4)">{{ __('edit request') }}</button>

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
        function goto_page(id){
            if(id == 1){
                window.location.href = "{{ route('nerkhnameh.registerForm') }}"
            }
            if(id == 2){
                window.location.href = "{{ route('nerkhnameh.finPayment.uploadForm') }}"
            }
            if(id == 3){
                window.location.href = "{{ route('nerkhnameh.download.downloadForm') }}"
            }
            if(id == 4){
                window.location.href = "{{ route('nerkhnameh.editRequest.findForm') }}"
            }
        }
    </script>
@endsection
