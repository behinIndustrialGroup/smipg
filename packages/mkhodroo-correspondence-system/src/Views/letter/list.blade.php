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
                        <th>{{__('name')}}</th>
                        <th>{{__('file')}}</th>
                        <th>{{__('numbering format')}}</th>
                        <th>{{__('created at')}}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var table = create_datatable(
            "data-table",
            "{{ route('atmn.template.list') }}",
            [
                {data : 'id'},
                {data : 'name'},
                {data : 'id', render: function(data){
                    url = "{{ route('atmn.template.download', ['id'=>'id']) }}";
                    url = url.replace('id', data);
                    return `<a href='${url}'>download</a>`;
                }},
                {data : 'numbering_format'},
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
                "{{ route('atmn.template.editForm') }}",
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
                '{{ route("atmn.template.createForm") }}',
                initial_view()
            )
        }
    </script>
@endsection