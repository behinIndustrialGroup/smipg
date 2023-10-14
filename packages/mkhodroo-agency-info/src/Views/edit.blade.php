<form action="javascript:void(0)" id="edit-form">
    @php
        $catagory = $agency_fields->where('key', 'catagory')->first();
    @endphp
    <input type="hidden" name="id" id="" value="{{ $catagory->id }}">
    <table class="table table-striped ">

        @foreach (config("agency_info.agency.$catagory->value")['fields'] as $field_key => $field_detail)
            @php
                $value = $agency_fields->where('key', $field_key)->first()?->value;
            @endphp
            <tr>
                <td>
                    {{ $field_key }}
                </td>
                <td>
                    @if ($field_detail['type'] == 'text')
                        <input type="text" name="{{ $field_key }}" value="{{ $value }}" class="form-control"
                            id="">
                    @endif
                    @if ($field_detail['type'] == 'select')
                        <select name="{{ $field_key }}" class="form-control" id="">
                            @if (is_array($field_detail['options']))
                                @foreach ($field_detail['options'] as $opt)
                                    <option value="{{ $opt['value'] }}">{{ $opt['label'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    <button class="btn btn-primary" onclick="edit()">{{ __('Edit') }}</button>
</form>

<script>
    function edit(){
        send_ajax_request(
            "{{ route('agencyInfo.edit') }}",
            $('#edit-form').serialize(),
            function(res){
                console.log(res);
            }
        )
    }
</script>
