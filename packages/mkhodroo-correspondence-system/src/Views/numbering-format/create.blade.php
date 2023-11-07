<div class="card">
    <form action="javascript:void()" id="create-form" class="form-control">
        @csrf
        {{__('Name')}}:
        <input type="text" name="name" id="" class="form-control">
        {{__('Format')}}:
        <input type="text" name="format" id="" class="form-control" dir="ltr">
        {{__('start_from')}}:
        <input type="number" name="start_from" id="" class="form-control">
    </form>
    <button class="btn btn-success" onclick="submit()">{{__('Create')}}</button>


</div>
<script>
    function submit() {
        var fd = new FormData($('#create-form')[0]);
        send_ajax_formdata_request(
            "{{ route('atmn.numberingFormat.create') }}",
            fd,
            function(data) {
                console.log(data);
                show_message("{{__('Created')}}")
                refresh_table();
            }
        )
    }
</script>
