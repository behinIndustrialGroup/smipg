<div class="card">
    <form action="javascript:void()" id="create-form" class="form-control">
        @csrf
        {{__('Name')}}:
        <input type="text" name="name" id="" class="form-control">
        {{__('File')}}:
        <input type="file" name="file" id="" class="form-control" dir="ltr">
        {{__('user')}}:
        <select name="user_id" id="" class="select2 form-control">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </form>
    <button class="btn btn-success" onclick="submit()">{{__('Create')}}</button>


</div>
<script>
    function submit() {
        var fd = new FormData($('#create-form')[0]);
        send_ajax_formdata_request(
            "{{ route('atmn.sign.create') }}",
            fd,
            function(data) {
                console.log(data);
                show_message("{{__('Created')}}")
                refresh_table();
            }
        )
    }
</script>
