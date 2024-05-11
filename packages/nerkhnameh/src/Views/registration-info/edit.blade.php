<form action="javascript:void(0)" method="post" id="info-form">
    <input type="hidden" name="id" id="" value="{{$data->id}}">
    <div>
        <div class="input-group mb-3">
            <div class="col-sm-3">{{ __('guild name') }}</div>
            <input type="text" class="form-control" name="guild_name" placeholder="{{ __('guild name') }}"
            value="{{ $data->guild_name }}">
        </div>
        <div class="input-group mb-3">
            <div class="col-sm-3">{{ __('fullname') }}</div>
            <input type="text" class="form-control" name="fullname" placeholder="{{ __('fullname') }}"
            value="{{ $data->fullname }}">
        </div>
        <div class="input-group mb-3">
            <div class="col-sm-3">{{ __('national id') }}</div>
            <input type="text" class="form-control" name="national_id" placeholder="{{ __('national id') }}"
            value="{{ $data->national_id }}">
        </div>
        <div class="input-group mb-3">
            <div class="col-sm-3">{{ __('catagory') }}</div>
            <input type="text" class="form-control" name="catagory" placeholder="{{ __('catagory') }}"
            value="{{ $data->catagory }}">
        </div>
        <div class="input-group mb-3">
            <div class="col-sm-3">{{ __('city') }}</div>
            <input type="text" class="form-control" name="city"
                placeholder="{{ __('city') }}"
                value="{{ $data->province . ' - ' . $data->city }}"
                disabled>
        </div>
        <div class="input-group mb-3">
            <div class="col-sm-3">{{ __('guild number') }}</div>
            <input type="text" class="form-control" name="guild_number"
                placeholder="{{ __('guild number') }}"
                value="{{ $data->guild_number }}">
        </div>
        <div class="input-group mb-3">
            <div class="col-sm-3">{{ __('phone') }}</div>
            <input type="text" class="form-control" name="tel" placeholder="{{ __('phone') }}"
            value="{{ $data->tel }}">
        </div>
        <div class="input-group mb-3">
            <div class="col-sm-3">{{ __('mobile') }}</div>
            <input type="text" class="form-control" name="mobile" placeholder="{{ __('mobile') }}"
            value="{{ $data->mobile }}">
        </div>
        <div class="input-group mb-3">
            <div class="col-sm-3">{{ __('address') }}</div>
            <textarea type="text" class="form-control" name="address" placeholder="{{ __('address') }}"
            >{{ $data->address }}</textarea>
        </div>
        <div class="input-group mb-3">
            <div class="col-sm-3">{{ __('personal image file') }}</div>
            @if($data->personal_image_file)
                <a href="{{ url($data->personal_image_file) }}">{{ __('download') }}</a>
            @endif
        </div>
        <div class="input-group mb-3">
            <div class="col-sm-3">{{ __('operation license') }}</div>
            @if($data->operation_license)
                <a href="{{ url($data->operation_license) }}">{{ __('download') }}</a>
            @endif
        </div>
        <div class="input-group mb-3">
            <div class="col-sm-3">{{ __('commitment file') }}</div>
            @if($data->commitment_file)
                <a href="{{ url($data?->commitment_file) }}">{{ __('download') }}</a>
            @endif
        </div>
        <div class="input-group mb-3">
            <div class="col-sm-3">{{ __('fin detail') }}</div>
            <div class="col-sm-9">
                <textarea type="text" class="form-control" name="fin_detail" placeholder="{{ __('fin detail') }}"
                >{{ $data->fin_detail }}</textarea>
            </div>
        </div>
        <div class="input-group mb-3">
            <div class="col-sm-3">{{ __('price') }}</div>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="price" placeholder="{{ __('price') }}"
                value="{{ $data->price }}">
                <p>
                    در این قسمت قیمتی را که با متقاضی توافق کرده اید تا پرداخت کند، وارد کنید. با وارد کردن این قسمت امکان آپلود رسید برای متقاضی فعال خواهد شد.
                </p>
            </div>
        </div>
        <div class="input-group mb-3">
            <button class="btn btn-success" onclick="edit_info()">{{ __('Edit') }}</button>
        </div>
    </div>

</form>

<hr>
@if (auth()->user()->access('Show nerkhnameh fin info form'))
<form action="javascript:void(0)" method="post" id="fin-form" class="row">
    <input type="hidden" name="id" id="" value="{{$data->id}}">
    <div class="col-sm-4">
        {{__('fin validation')}}
    </div>
    <div class="col-sm-4">
        <p>{{__('price payment file')}}</p>
        @if ($data->price_payment_file)
            <a href="{{ url($data->price_payment_file) }}" target="_blank">{{__('download')}}</a>
        @else
            <p style="color: red">
            هنوز آپلود نشده است
            </p>
        @endif
    </div>
    <div class="col-sm-4">
        {{__('fin validation')}}
        <select name="fin_validation" class="form-control" id="">
            <option value="0">{{__('declined')}}</option>
            <option value="1" @if($data->fin_validation) selected @endif>{{__('approved')}}</option>
        </select>
        <button class="btn btn-success" onclick="fin_validate()">{{ __('save') }}</button>
    </div>
</form>
@endif


<hr>
<form action="javascript:void(0)" method="post" id="nerkhnameh-form" enctype="multipart/form-data">
    <input type="hidden" name="id" id="" value="{{$data->id}}">
    <div class="row">
        <div class="col-sm-4">
            @if ($data->nerkhnameh_word_file)
                <a href="{{ url($data->nerkhnameh_word_file) }}">{{__('download word file')}}</a><br>
            @else
                <button class="btn btn-danger" onclick="create_nerkhnameh()">{{ __('create nerkhnameh') }}</button>
            @endif
            @if ($data->nerkhnameh_file)
                <a href="{{ url($data->nerkhnameh_file) }}">{{__('download pdf file')}}</a><br>
            @endif
        </div>
        <div class="col-sm-4">
            {{__('nerkhnameh pdf file upload')}}

            <input type="file" class="form-control col-sm-12" name="nerkhnameh_file" id="">
            <button class="btn btn-success" onclick="save_nerkhnameh()">{{ __('save') }}</button>

        </div>
    </div>
</form>

<hr>
<form action="javascript:void(0)" method="post" id="delete-form">
    <input type="hidden" name="id" id="" value="{{$data->id}}">
    <button class="btn btn-danger" onclick="delete_nerkhnameh()">{{ __('delete') }}</button>
</form>


<script>
    function edit_info(){
        var form = $('#info-form')[0]
        var fd = new FormData(form);

        send_ajax_formdata_request(
            "{{ route('nerkhnameh.registration.edit') }}",
            fd,
            function(response) {
                console.log(response);
                show_message("{{ __('edited') }}")
                refresh_table()
            },
            function(response) {
                // console.log(response);
                show_error(response)
                hide_loading();
            }
        )
    }


    function fin_validate(){
        var form = $('#fin-form')[0]
        var fd = new FormData(form);

        send_ajax_formdata_request(
            "{{ route('nerkhnameh.registration.edit') }}",
            fd,
            function(response) {
                console.log(response);
                show_message("{{ __('edited') }}")
                refresh_table()
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
                show_edit_modal("{{ $data->id }}")
            },
            function(response) {
                // console.log(response);
                show_error(response)
                hide_loading();
            }
        )
    }

    function save_nerkhnameh(){
        var form = $('#nerkhnameh-form')[0]
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

    function delete_nerkhnameh(){
        var form = $('#delete-form')[0]
        var fd = new FormData(form);

        send_ajax_formdata_request_with_confirm(
            "{{ route('nerkhnameh.registration.delete') }}",
            fd,
            function(response) {
                show_message("{{ __('deleted') }}")
                refresh_table()
            },
            function(response) {
                // console.log(response);
                show_error(response)
                hide_loading();
            }
        )
    }
</script>
