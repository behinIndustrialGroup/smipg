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
                @if (!$data->id)
                    <div class="alert alert-danger">
                        این نرخنامه معتبر نیست
                    </div>
                @else
                    <div class="col-sm-12">
                        این نرخنامه متعلق است به: 
                    </div>
                    <div class="col-sm-12">{{$data->guild_name}}</div>
                    <div class="col-sm-12">{{$data->fullname}}</div>
                    <div class="col-sm-12">{{$data->tel}}</div>
                    <div class="col-sm-12">{{$data->address}}</div>
                @endif
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
        }
    </script>
@endsection
