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
                        <th>{{__('inbox id')}}</th>
                        <th>{{__('letter id')}}</th>
                        <th>{{__('Title')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('For')}}</th>
                        <th>{{__('Number')}}</th>
                        <th>{{__('created at')}}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        send_ajax_get_request("{{ route('atmn.inbox.list') }}", function(data){
            console.log(data);
        });
        var table = create_datatable(
            "data-table",
            "{{ route('atmn.inbox.list') }}",
            [
                {data : 'id'},
                {data : 'letter_id'},
                {data : 'letter_info', render:function(data){
                    return `${data.title}`;
                }},
                {data : 'status'},
                {data : 'for'},
                {data : 'letter_info', render:function(data){
                    return `${data.number}`;
                }},
                {data : 'created_at'}
            ],
            function(row){
                $(row).css('cursor', 'pointer')
            }
        )

        table.on('dblclick', 'tr', function(){
            var data = table.row( this ).data();
            show_edit_modal(data.id,data.letter_id);
        })

        function show_edit_modal(inbox_id, letter_id){
            var fd = new FormData();
            url = "{{ route('atmn.inbox.showLetter', ['letter_id' => 'letter_id', 'inbox_id', 'inbox_id']) }}";
            url = url.replace('letter_id', letter_id)
            url = url.replace('inbox_id', inbox_id)
            window.open(url, '_blank').focus();
            // send_ajax_formdata_request(
            //     url,
            //     fd,
            //     function(body){
            //         window.open(url, '_blank').focus();
            //         open_admin_modal_with_data(body);
            //     },
            //     function(data){
            //         show_error(data);
            //         console.log(data);
            //     }
            // )
        }

        function show_create_form(){
            open_admin_modal(
                '{{ route("atmn.template.createForm") }}',
                initial_view()
            )
        }
    </script>
@endsection