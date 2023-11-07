<div class="card">
    <form action="javascript:void()" id="create-form" class="form-control">
        @csrf
        {{__('Role Name')}}:
        <input type="text" name="name" id="" class="form-control">

    </form>
    <button class="btn btn-success" onclick="submit()">{{__('Create')}}</button>


</div>
<script>
    function submit() {
        var fd = new FormData($('#create-form')[0]);
        send_ajax_formdata_request(
            "{{ route('atmn.role.create') }}",
            fd,
            function(data) {
                console.log(data);
                show_message("{{__('Created')}}")
                refresh_table();
            }
        )
    }
</script>
