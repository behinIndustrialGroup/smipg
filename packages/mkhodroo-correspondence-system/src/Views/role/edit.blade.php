<div class="card">
    <form action="javascript:void()" id="edit-form">
        @csrf
        <input type="hidden" name="id" id="" class="form-control" value="{{$role->id}}">
        {{__('Role Name')}}:
        <input type="text" name="name" id="" class="form-control" value="{{$role->name ?? ''}}">

    </form>
    <button class="btn btn-success" onclick="submit()">submit</button>


</div>
<script>
    function submit() {
        var fd = new FormData($('#edit-form')[0]);
        send_ajax_formdata_request(
            "{{ route('atmn.role.edit') }}",
            fd,
            function(data) {
                console.log(data);
                show_message("{{__('Edited')}}")
                refresh_table();
            }
        )
    }
</script>
