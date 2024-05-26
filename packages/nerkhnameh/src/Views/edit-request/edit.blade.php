<form action="javascript:void(0)" method="post" id="info-form" enctype="multipart/form-data">
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
            value="{{ $data->catagory }}"
            disabled>
        </div>
        <div class="input-group mb-3">
            <div class="col-sm-3">{{ __('city') }}</div>
            <div class="input-group mb-3">
                <div class="col-sm-3">{{ __('city') }}</div>
                <div class="col-sm-9">
                    <select name="city_id" id="" class="select2">
                        @foreach ($cities as $city)
                            <option value="{{$city->id}}" {{ $city->id === $data->city_id ? 'selected': '' }} >{{$city->province}} - {{ $city->city }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
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
                <a href="{{ url($data->personal_image_file) }}" target="_blank">{{ __('download') }}</a><br>
            @endif
            <input type="file" name="personal_image_file" id="" class="form-control">
        </div>
        @if ($data->catagory === config('nerkhnameh_config.catagory')[4])
            <div class="input-group mb-3">
                <div class="col-sm-3">{{ __('operation license') }}</div>
                @if($data->operation_license)
                    <a href="{{ url($data->operation_license) }}">{{ __('download') }}</a>
                @endif
                    <input type="file" name="operation_license" id="">                
            </div>
        @endif
        <div class="input-group mb-3">
            <button class="btn btn-success" onclick="edit_info()">{{ __('Edit') }}</button>
        </div>
    </div>

</form>


<script>
    initial_view()
    function edit_info(){
        var form = $('#info-form')[0]
        var fd = new FormData(form);

        send_ajax_formdata_request(
            "{{ route('nerkhnameh.editRequest.edit') }}",
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
</script>
