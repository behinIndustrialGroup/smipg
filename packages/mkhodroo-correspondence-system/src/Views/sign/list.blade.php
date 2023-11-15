@extends('layouts.app')

@section('content')
    <div class="box">
        <div class="card">
            <button class="btn btn-info" onclick="show_create_form()">{{__('Create')}}</button>
        </div>
        <div class="card">
            <table class="table table-stripped"  id="data-table">
                <thead>
                    <tr>
                        <th>{{__('id')}}</th>
                        <th>{{__('username')}}</th>
                        <th>{{__('name')}}</th>
                        <th>{{__('file')}}</th>
                        <th>{{__('created at')}}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $.get("{{ route('atmn.sign.list') }}", function(res){
            console.log(res);
        })
        var table = create_datatable(
            "data-table",
            "{{ route('atmn.sign.list') }}",
            [
                {data : 'id'},
                {data : 'username'},
                {data : 'name'},
                {data : 'file', render: function(data){
                    return `<img src="data:image/png;base64, ${data}">`;
                }},
                {data : 'created_at'}
            ],
            function(row){
                $(row).css('cursor', 'pointer')
            }
        )

        table.on('dblclick', 'tr', function(){
            var data = table.row( this ).data();
            show_edit_modal(data.id);
        })

        function show_edit_modal(id){
            var fd = new FormData();
            fd.append('id', id);
            send_ajax_formdata_request(
                "{{ route('atmn.sign.editForm') }}",
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

        function show_create_form(){
            open_admin_modal(
                '{{ route("atmn.sign.createForm") }}',
                initial_view()
            )
        }
    </script>
@endsection