<div class="card">
    <form action="javascript:void()" id="edit-form">
        @csrf
        <input type="hidden" name="id" id="" value="{{$format->id}}">
        {{__('Name')}}:
        <input type="text" name="name" id="" class="form-control" value="{{ $format->name }}">
        {{__('Format')}}:
        <input type="text" name="format" id="" class="form-control" dir="ltr" value="{{ $format->format }}">
        {{__('start_from')}}:
        <input type="number" name="start_from" id="" class="form-control" value="{{ $format->start_from }}">
    </form>
    <button class="btn btn-success" onclick="submit()">submit</button>


</div>
<script>
    function submit() {
        var fd = new FormData($('#edit-form')[0]);
        send_ajax_formdata_request(
            "{{ route('atmn.numberingFormat.edit') }}",
            fd,
            function(data) {
                console.log(data);
                show_message("{{__('Edited')}}")
                refresh_table();
            }
        )
    }
</script>
