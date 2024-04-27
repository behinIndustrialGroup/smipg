@extends('layouts.app')

@section('content')
    <div class=" table-responsive">
        <table class="table table-stripped" id="nerkhnameh-registration">
            <thead>
                <tr>
                    <th>{{ __('id') }}</th>
                    <th>{{ __('updated_at') }}</th>
                    <th>{{ __('fullname') }}</th>
                    <th>{{ __('national id') }}</th>
                    <th>{{ __('mobile') }}</th>
                    <th>{{ __('guild number') }}</th>
                    <th>{{ __('guild name') }}</th>
                    <th>{{ __('catagory') }}</th>
                    <th>{{ __('address') }}</th>
                    <th>{{ __('created at') }}</th>
                    <th>{{ __('price') }}</th>
                    <th>{{ __('fin payment file') }}</th>
                    <th>{{ __('fin validation') }}</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('script')
    <script>
        var table = create_datatable(
            'nerkhnameh-registration',
            "{{ route('nerkhnameh.registration.list') }}",
            [
                { data: 'id'},
                { data: 'updated_at', render: function(data){
                    datetime = new Date(data);
                    date = datetime.toLocaleDateString('fa-IR');
                    time = datetime.toLocaleTimeString('fa-IR');
                    return '<span dir="auto" style="float: left">' + date + ' ' + time + '</span>';
                }},
                { data: 'fullname'},
                { data: 'national_id'},
                { data: 'mobile'},
                { data: 'guild_number'},
                { data: 'guild_name'},
                { data: 'catagory'},
                { data: 'address'},
                { data: 'created_at', render: function(data){
                    datetime = new Date(data);
                    date = datetime.toLocaleDateString('fa-IR');
                    time = datetime.toLocaleTimeString('fa-IR');
                    return '<span dir="auto" style="float: left">' + date + ' ' + time + '</span>';
                }},
                { data: 'price'},
                { data: 'fin_payment_file', render: function(data){
                    if(data){
                        return 'آپلود شده';
                    }else{
                        return '';
                    }
                }},
                { data: 'fin_validation'},

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
