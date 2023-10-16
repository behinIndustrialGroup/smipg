<form action="javascript:void(0)" id="new-agency-form" class="col-sm-12 table-responsive">
    <table class="table table-striped">
        <tbody>
            <tr>
                <td>{{ __('catagory') }}</td>
                <td>
                    <select name="catagory" id="" class="form-control">
                        @foreach (config('agency_info.agency') as $catagory => $catagory_detail)
                            <option value="{{$catagory}}">{{$catagory_detail['catagory_fa']}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    <button onclick="create()" class="btn btn-primary">{{ __('Create') }}</button>
</form>

<script>
    function create(){
        send_ajax_request(
            "{{ route('agencyInfo.create')}}",
            $('#new-agency-form').serialize(),
            function(res){
                console.log(res);
            }
        )
    }
</script>
