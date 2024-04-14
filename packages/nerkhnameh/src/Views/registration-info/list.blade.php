@extends('layouts.app')

@section('content')
    <table class="table table-stripped" id="nerkhnameh-registration">
        <thead>
            <tr>
                <th>{{ __('id') }}</th>
                <th>{{ __('fullname') }}</th>
                <th>{{ __('national id') }}</th>
                <th>{{ __('mobile') }}</th>
                <th>{{ __('guild number') }}</th>
                <th>{{ __('guild name') }}</th>
                <th>{{ __('catagory') }}</th>
                <th>{{ __('address') }}</th>
                <th>{{ __('personal image file') }}</th>
                <th>{{ __('commitment file') }}</th>
            </tr>
        </thead>
    </table>
@endsection

@section('script')
    <script>
        var table = create_datatable(
            'nerkhnameh-registration',
            "{{ route('nerkhnameh.registration.list') }}",
            [
                { data: 'id'},
                { data: 'fullname'},
                { data: 'national_id'},
                { data: 'mobile'},
                { data: 'guild_number'},
                { data: 'guild_name'},
                { data: 'catagory'},
                { data: 'address'},
                { data: 'personal_image_file', render: function(data){
                    return `<a href='{{ url('${data}') }}'>{{ __('download') }}</a>`;
                }},
                { data: 'commitment_file', render: function(data){
                    return `<a href='{{ url('${data}') }}'>{{ __('download') }}</a>`;
                }},
            ]
        )
        table.on('dblclick', 'tr', function(){
            var data = table.row( this ).data();
            show_edit_modal(data.id);
        })

        function show_edit_modal(id){
            var fd = new FormData();
            fd.append('id', id);
            send_ajax_formdata_request(
                "{{ route('nerkhnameh.registration.getView') }}",
                fd,
                function(body){
                    open_admin_modal_with_data(body);
                },
                function(data){
                    show_error(data);
                    console.log(data);
                }
            )
        }

    </script>
@endsection
