<div class="box">
    <div class="card">
        <form action="javascript:void(0)" id="jump-form">
            @csrf
            <input type="text" name="inbox_id" id="" value="{{ $inbox_id }}">
            <input type="text" name="letter_id" id="" value="{{ $letter_id }}">
            <table class="table table-stripped" id="data-table">
                <thead>
                    <tr>
                        <th>{{ __('User') }}</th>
                        <th>{{ __('For') }}</th>
                        <th>{{ __('Description') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="user_id[]" id="" class="form-control select2">
                                @foreach ($users as $user)
                                    <option value="{{ $user->user_id ?? '' }}">{{ $user->user ?? '' }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="for[]" id="" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="description[]" id="" class="form-control">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <button class="btn btn-success" onclick="jumpTo()">{{__('Jump')}}</button>
    </div>
</div>

<script>
    function jumpTo() {
        var fd = new FormData($('#jump-form')[0]);
        send_ajax_formdata_request(
            "{{ route('atmn.jump.jump') }}",
            fd,
            function(data) {
                console.log(data);
                show_message("{{__('Jumped')}}")
                // window.close();
            }
        )
    }
</script>