<div class="card">
    <form action="javascript:void()" id="edit-form">
        @csrf
        <input type="hidden" name="id" id="" value="{{ $access->id }}">
        {{ __('Template') }}:
        <select name="template_id" id="" class="select2 form-control">
            @foreach ($templates as $template)
                <option value="{{ $template->id }}" {{ $access->template_id === $template->id ? 'selected' : '' }}>
                    {{ $template->name }}</option>
            @endforeach
        </select>
        {{ __('Role') }}:
        <select name="role_id" id="" class="select2 form-control">
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ $access->role_id === $role->id ? 'selected' : '' }}>
                    {{ $role->name }}</option>
            @endforeach
        </select>
        {{ __('Create') }} <input type="checkbox" name="create" id="" {{ $access->create ? 'checked' : '' }}><br>
        {{ __('Numbering') }} <input type="checkbox" name="numbering" id="" {{ $access->numbering ? 'checked' : '' }}><br>
        {{ __('Signing') }} <input type="checkbox" name="signing" id="" {{ $access->signing ? 'checked' : '' }}><br>
    </form>
    <button class="btn btn-success" onclick="submit()">submit</button>


</div>
<script>
    function submit() {
        var fd = new FormData($('#edit-form')[0]);
        send_ajax_formdata_request(
            "{{ route('atmn.templateAccess.edit') }}",
            fd,
            function(data) {
                console.log(data);
                show_message("{{ __('Edited') }}")
                refresh_table();
            }
        )
    }
</script>
