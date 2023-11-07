<div class="card">
    <form action="javascript:void()" id="create-form" class="form-control">
        @csrf
        {{__('Template')}}:
        <select name="template_id" id="" class="select2 form-control">
            @foreach ($templates as $template)
                <option value="{{ $template->id }}">{{ $template->name }}</option>
            @endforeach
        </select>
        {{__('Role')}}:
        <select name="role_id" id="" class="select2 form-control">
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
        {{__('Create')}} <input type="checkbox" name="create" id=""><br>
        {{__('Numbering')}} <input type="checkbox" name="numbering" id=""><br>
        {{__('Signing')}} <input type="checkbox" name="signing" id=""><br>
    </form>
    <button class="btn btn-success" onclick="submit()">{{__('Create')}}</button>


</div>
<script>
    function submit() {
        var fd = new FormData($('#create-form')[0]);
        send_ajax_formdata_request(
            "{{ route('atmn.templateAccess.create') }}",
            fd,
            function(data) {
                console.log(data);
                show_message("{{__('Created')}}")
                refresh_table();
            }
        )
    }
</script>
