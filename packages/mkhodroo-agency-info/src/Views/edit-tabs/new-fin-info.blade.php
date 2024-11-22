@if (auth()->user()->access('Show Agency Fin Info'))
    <div class="tab-pane fade" id="new_fin_info" role="tabpanel" aria-labelledby="new_fin_info-tab">
        <form action="javascript:void(0)" id="payment" class="table-responsive">

            <table class="table table-strpped">
                <thead>
                    <tr>
                        <th>{{ trans('Title') }}</th>
                        <th>{{ trans('Price') }}</th>
                        <th>{{ trans('Type') }}</th>
                        <th>{{ trans('Date') }}</th>
                        <th>{{ trans('File') }}</th>
                    </tr>
                </thead>
                @php
                    $payments = $agency_fields->where('key', 'payment');
                @endphp
                @foreach ($payments as $payment)
                    @php
                        $value = json_decode($payment->value);
                    @endphp
                    <tr>
                        <td>
                            <input type="text" name="title[{{$payment->id}}]" class="" value="{{ $value->title ?? '' }}">
                        </td>
                        <td>
                            <input type="text" name="price[{{$payment->id}}]" class="cama-seprator" value="{{ $value->price ?? '' }}">
                        </td>
                        <td>
                            <select name="type[{{$payment->id}}]" id="">
                                @foreach (config('agency_info.payment_type_options') as $option)
                                    <option value="{{$option}}" {{ $option == $value->type ? 'selected' : '' }} >{{$option}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="date[{{$payment->id}}]" id="" value="{{ $value->date ?? '' }}">
                        </td>
                        <td>
                            @if ($value->file)
                                <a href="{{ url("public/$value->file") }}" download="{{ $payment->id }}">{{ trans('Download') }}</a>
                            @endif
                            <input type="file" name="file[{{$payment->id}}]" id="">
                        </td>
                    </tr>
                @endforeach
                <input type="hidden" name="id" id="" value="{{ $customer_type->id ?? '' }}">
                <tbody>
                    <tr>
                        <td><input type="text" name="title_new" class="form-control"></td>
                        <td><input type="text" name="price_new" class="form-control cama-seprator"></td>
                        <td>
                            <select name="type_new" class="form-control">
                                @foreach (config('agency_info.payment_type_options') as $option)
                                    <option value="{{$option}}">{{$option}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" name="date_new" class="form-control persian-date"></td>
                        <td><input type="file" name="file_new" id=""></td>
                    </tr>
                </tbody>
                <button onclick="add()">{{ trans('Add') }}</button>
            </table>
        </form>
    </div>
@endif

<script>
    function add() {
        var fd = new FormData($('#payment')[0]);
        send_ajax_formdata_request(
            "{{ route('agencyInfo.finEdit') }}",
            fd,
            function(res) {
                console.log(res);
                show_message("{{ __('Edited') }}");
                // open_edit_form(res.parent_id, 'fin-info')
                // filter()
            }
        )
    }
</script>
