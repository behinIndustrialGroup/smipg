<h4>
    اصلاح اطلاعات مرکز : {{ $agency_fields->where('key', 'firstname')->first()?->value }}
    {{ $agency_fields->where('key', 'lastname')->first()?->value }}
    @php
        $catagory = $agency_fields->where('key', 'guild_catagory')->first();
    @endphp
</h4>

<div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home"
                    role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">{{ __('Agency Info') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile"
                    role="tab" aria-controls="custom-tabs-one-profile"
                    aria-selected="false">{{ __('Agency Fin Info') }}</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel"
                aria-labelledby="custom-tabs-one-home-tab">
                <form action="javascript:void(0)" id="edit-form">
                    @php
                        $catagory = $agency_fields->where('key', 'guild_catagory')->first();
                    @endphp
                    <input type="hidden" name="id" id="" value="{{ $catagory->id ?? '' }}">
                    <table class="table table-striped ">
                        @foreach (config("agency_info.agency.$catagory->value")['fields'] as $field_key => $field_detail)
                            @php
                                $value = $agency_fields->where('key', $field_key)->first()?->value;
                            @endphp
                            <tr>
                                <td>
                                    {{ __($field_key) }}
                                </td>
                                <td>
                                    @if ($field_detail['type'] == 'text')
                                        @php
                                            $required = $field_detail['required'] ? 'required' : '';
                                        @endphp
                                        <input type="text" name="{{ $field_key }}" value="{{ $value }}"
                                            class="form-control" id="">
                                    @endif
                                    @if ($field_detail['type'] == 'select')
                                        <select name="{{ $field_key }}" class="form-control select2 col-sm-12"
                                            id="">
                                            @if (!empty($field_detail['option-url']))
                                                @php
                                                    $url = $field_detail['option-url'];
                                                @endphp
                                                <script>
                                                    send_ajax_get_request(
                                                        "{{ Route::has($url) ? route($url) : url($url) }}",
                                                        function(res) {
                                                            selec_element = $('select[name={{ $field_key }}]')
                                                            res.forEach(function(item) {
                                                                var opt = new Option(item.province + ' - ' + item.city, item.id)
                                                                selec_element.append(opt)
                                                            })
                                                            selec_element.val('{{ $value }}').trigger('change')
                                                        }
                                                    )
                                                </script>
                                            @endif
                                            @if (is_array($field_detail['options']))
                                                @foreach ($field_detail['options'] as $opt)
                                                    <option value="{{ $opt['value'] }}">{{ $opt['label'] }}</option>
                                                @endforeach
                                                <script>
                                                    selec_element = $('select[name={{ $field_key }}]')
                                                    selec_element.val('{{ $value }}').trigger('change')
                                                </script>
                                            @endif

                                        </select>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <button class="btn btn-primary" onclick="edit()">{{ __('Edit') }}</button>
                </form>
            </div>
            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                aria-labelledby="custom-tabs-one-profile-tab">
                <form action="javascript:void(0)" id="fin-form" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="" value="{{ $catagory->id ?? '' }}">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th>سال</th>
                                <th>مبلغ پرداختی</th>
                                <th>تاریخ پرداخت</th>
                                <th>فایل پرداخت</th>
                            </tr>
                        </thead>
                        @foreach (config("agency_info.agency.$catagory->value")['fin_fileds'] as $field_key => $field_detail)
                            <tr>
                                <td>
                                    {{ __($field_key) }}
                                </td>
                                @foreach ($field_detail as $item)
                                    @php
                                        $value = $agency_fields->where('key', $item)->first()?->value;
                                    @endphp
                                    <td style="text-align: center">
                                        @if (str_contains($item, 'file'))
                                            @if ($value)
                                                <a href="{{ url("public/$value") }}" download="{{ __($item) }}">{{ __($item) }}</a>
                                                <i class="fa fa-trash" onclick="delete_fin_pay_file('{{$item}}')" style="float: left; color: red; cursor: pointer"></i>
                                            @else
                                                <input type="file" name="{{ $item }}" id=""
                                                class="form-control">
                                            @endif
                                        @else
                                            <input type="text" name="{{ $item }}"
                                                value="{{ $value }}" class="form-control {{ str_contains($item, 'pay') ? '' : 'cama-seprator' }}" id="">
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                    <button class="btn btn-primary" onclick="fin_edit()">{{ __('Edit') }}</button>
                </form>
            </div>
        </div>
    </div>

</div>


<script>
    function edit() {
        send_ajax_request(
            "{{ route('agencyInfo.edit') }}",
            $('#edit-form').serialize(),
            function(res) {
                show_message("{{ __('Edited') }}");
                refresh_table()
            }
        )
    }

    function fin_edit() {
        var fd = new FormData($('#fin-form')[0]);
        send_ajax_formdata_request(
            "{{ route('agencyInfo.finEdit') }}",
            fd,
            function(res) {
                console.log(res);
                show_message("{{ __('Edited') }}");
                refresh_table()
            }
        )
        
    }
    function delete_fin_pay_file(key) {
        var fd = new FormData();
        fd.append('parent_id', $($('input[name=id]')[1]).val());
        fd.append('key', key);
        send_ajax_formdata_request_with_confirm(
            "{{ route('agencyInfo.deleteByKey') }}",
            fd,
            function(res) {
                console.log(res);
                show_message("{{ __('Deleted') }}");
            },
            null
            ,
            "{{__('Are you sure?')}}"
        )
        
    }
    initial_view()
    runCamaSeprator('cama-seprator')
    camaSeprator('cama-seprator')
</script>
