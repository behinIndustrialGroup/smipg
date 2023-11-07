<div class="card">
    <form action="javascript:void()" id="edit-form">
        @csrf
        <input type="hidden" name="id" id="" value="{{$user_role->id}}">
        {{__('User Name')}}:
        <select name="user_id" id="" class="select2 form-control">
            @foreach ($users as $user)
                <option value="{{$user->id}}"  {{ $user->id === $user_role->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select>

        {{__('Role Name')}}:
        <select name="role_id" id="" class="select2 form-control">
            @foreach ($roles as $role)
                <option value="{{$role->id}}" {{ $role->id === $user_role->role_id ? 'selected' : '' }}>{{ $role->name }}</option>
            @endforeach
        </select>
    </form>
    <button class="btn btn-success" onclick="submit()">submit</button>


</div>
<script>
    function submit() {
        var fd = new FormData($('#edit-form')[0]);
        send_ajax_formdata_request(
            "{{ route('atmn.userRole.edit') }}",
            fd,
            function(data) {
                console.log(data);
                show_message("{{__('Edited')}}")
                refresh_table();
            }
        )
    }
</script>
