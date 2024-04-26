<form action="javascript:void(0)" method="post" id="find-form" enctype="multipart/form-data">
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
        <select name="catagory" class="select2" id="">
            @foreach (config('nerkhnameh_config.catagory') as $item)
                <option value="{{$item}}">{{$item}}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group mb-3">
        <button class="btn btn-success" onclick="check()">{{ __('check') }}</button>
    </div>
    <div class="col-sm-12" id="details-div">

    </div>
</form>