<div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="guild_name" placeholder="{{ __('guild name') }}"
        value="{{ $data->guild_name }}">
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="fullname" placeholder="{{ __('fullname') }}"
        value="{{ $data->fullname }}">
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="national_id" placeholder="{{ __('national id') }}"
        value="{{ $data->national_id }}">
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="catagory" placeholder="{{ __('catagory') }}"
        value="{{ $data->catagory }}">
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="city"
            placeholder="{{ __('city') }}"
            value="{{ $data->city_id }}">
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="guild_number"
            placeholder="{{ __('guild number') }}"
            value="{{ $data->guild_number }}">
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="tel" placeholder="{{ __('phone') }}"
        value="{{ $data->tel }}">
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="mobile" placeholder="{{ __('mobile') }}"
        value="{{ $data->mobile }}">
    </div>
    <div class="input-group mb-3">
        <textarea type="text" class="form-control" name="address" placeholder="{{ __('address') }}"
        value="{{ $data->address }}"></textarea>
    </div>
</div>

<hr>
<form action="javascript:void(0)" method="post" id="fin-form" enctype="multipart/form-data">
    <input type="hidden" name="id" id="" value="{{$data->id}}">
    <div class="input-group mb-3">
        {{__('fin validation')}}
        <select name="fin_validation" class="form-control" id="">
            <option value="0">{{__('declined')}}</option>
            <option value="1">{{__('approved')}}</option>
        </select>
    </div>
    <div class="input-group mb-3">
        <button class="btn btn-success" onclick="fin_validate()">{{ __('save') }}</button>
    </div>
</form>
<script>
    function fin_validate(){
        var form = $('#fin-form')[0]
        var fd = new FormData(form);

        send_ajax_formdata_request(
            "{{ route('nerkhnameh.registration.edit') }}",
            fd,
            function(response) {
                console.log(response);
                show_message("{{ __('edited') }}")
            },
            function(response) {
                // console.log(response);
                show_error(response)
                hide_loading();
            }
        )
    }
</script>

<hr>
<form action="javascript:void(0)" method="post" id="nerkhnameh-form" enctype="multipart/form-data">
    <input type="hidden" name="id" id="" value="{{$data->id}}">
    <div class="input-group mb-3">
        {{__('nerkhnameh file')}}
        @if ($data->nerkhnameh_file)
            <a href="{{ url($data->nerkhnameh_file) }}">{{__('download')}}</a>
        @endif
        <input type="file" class="form-control" name="nerkhnameh_file" id="">
    </div>
    <div class="input-group mb-3">
        <button class="btn btn-success" onclick="create_nerkhnameh()">{{ __('save') }}</button>
    </div>
</form>

<div class="row" id="qr-code">
    {{ $qrCode ?? '' }}
</div>
<script>
    function fin_validate(){
        var form = $('#fin-form')[0]
        var fd = new FormData(form);

        send_ajax_formdata_request(
            "{{ route('nerkhnameh.registration.edit') }}",
            fd,
            function(response) {
                console.log(response);
                show_message("{{ __('edited') }}")
            },
            function(response) {
                // console.log(response);
                show_error(response)
                hide_loading();
            }
        )
    }

    function create_nerkhnameh(){
        var form = $('#nerkhnameh-form')[0]
        var fd = new FormData(form);

        send_ajax_formdata_request(
            "{{ route('nerkhnameh.registration.createNerkhnameh') }}",
            fd,
            function(response) {
                console.log(response);
                show_message("{{ __('edited') }}")
            },
            function(response) {
                // console.log(response);
                show_error(response)
                hide_loading();
            }
        )
    }
</script>
