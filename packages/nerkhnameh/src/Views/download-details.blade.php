@if ($data->nerkhnameh_file === null)
    <div class="alert alert-warning">
        نرخنامه شما هنوز آماده نشده است. با توجه به حجم بالای درخواست ها لطفا منتظر بمانید.
    </div>
@else
    <a href="{{ url($data->nerkhnameh_file) }}">{{__('downlaod nerkhnameh')}}</a>
@endif
