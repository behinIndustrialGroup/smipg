<div class="card">
    <form action="javascript:void()" id="edit-form">
        @csrf
        <input type="hidden" name="id" id="" value="{{$template->id}}">
        {{__('Name')}}:
        <input type="text" name="name" id="" class="form-control" value="{{ $template->name }}">
        {{__('File')}}:
        <input type="file" name="file" id="" class="form-control" dir="ltr">
        <a href="{{$template->file}}">{{ $template->file-> }}</a><br>
        {{__('numbering format')}}:
        <select name="numbering_format_id" id="" class="select2 form-control">
            @foreach ($numbering_formats as $numbering_format)
                <option value="{{ $numbering_format->id }}" {{ $template->numbering_format_id === $numbering_format->id ? 'selected' : '' }}>{{ $numbering_format->name }}</option>
            @endforeach
        </select>
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
