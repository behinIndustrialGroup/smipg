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
    <input type="text" class="form-control" name="catagory" placeholder="{{ __('catagory') }}">
</div>
<div class="input-group mb-3">
    <select name="city_id" id="" class="select2">
       
    </select>
</div>
<div class="input-group mb-3">
    <input type="text" class="form-control" name="guild_number"
        placeholder="{{ __('guild number') }}">
</div>
<div class="input-group mb-3">
    <input type="text" class="form-control" name="phone" placeholder="{{ __('phone') }}">
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
    {{ __('commitment file') }} 
    <a href="{{ url('public/packages/nerkhnameh/nerkhnameh_commitment.docx') }}">
        {{ __('download template') }}
    </a>
    <input type="file" class="form-control" name="commitment_file" style="width: 100%">
</div>