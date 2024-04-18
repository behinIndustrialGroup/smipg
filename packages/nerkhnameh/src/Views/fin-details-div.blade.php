@if ($data->price === null)
    <div class="alert alert-warning">
        اطلاعات شما توسط تاکنون اتحادیه بررسی نشده است. لطفا تا بررسی اطلاعات توسط اتحادیه منتظر بمانید
    </div>
@elseif($data->fin_validation === 1)
    <div class="alert alert-danger">
        اطلاعات پرداخت شما توسط اتحادیه تایید شده است. از قسمت دانلود نرخنامه اقدام به دانلود نمایید
    </div>
@elseif($data->price_payment_file)
    <div class="alert alert-danger">
    شما قبلا رسید پرداخت را آپلود کرده اید. منتظر تایید واحد مالی باشید
    </div>
@else
    <div class="input-group mb-3">
        {{ __('price payment file') }}<br>
        <input 
            type="file" 
            class="form-control" 
            name="price_payment_file" 
            style="width: 100%">
    </div>
    <div class="input-group mb-3">
        <button
            class="btn btn-success"
            onclick="register()">
        {{__("register")}}
        </button>
    </div>
    <script>
        function register() {
            var form = $('#fin-form')[0]
            var fd = new FormData(form);

            send_ajax_formdata_request(
                "{{ route('nerkhnameh.finPayment.upload') }}",
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
@endif
