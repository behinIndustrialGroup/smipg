<div class="card">
    <form action="javascript:void()" id="edit-form">
        @csrf
        <input type="hidden" name="id" id="" value="{{$sign->id}}">
        {{__('Username')}}:
        <input type="text" name="username" id="" class="form-control" value="{{ $username }}" disabled>
        {{__('Name')}}:
        <input type="text" name="name" id="" class="form-control" value="{{ $sign->name }}">
        {{__('File')}}:
        <input type="file" name="file" id="" class="form-control" dir="ltr">
        <img src="data:image/png;base64,{{$sign->file}}" alt="">
        
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
