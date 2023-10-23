@extends('layouts.app')

@section('content')
    <div class="box">
        <div class="card p-4">
            <button onclick="new_agency()" class="btn btn-primary col-sm-1">{{__('New')}}</button>
        </div>
        <div class="card p-4">
            <table class="table table-stripped"  id="infos">
                <thead>
                    <tr>
                        <th>{{__('id')}}</th>
                        <th>{{__('firstname')}}</th>
                        <th>{{__('lastname')}}</th>
                        <th>{{__('guild_catagory')}}</th>
                        <th>{{__('catagory')}}</th>
                        <th>{{__('national id')}}</th>
                        <th>{{__('province')}}</th>
                        <th>{{__('status')}}</th>
                        <th>{{__('created at')}}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        send_ajax_get_request(
            "{{ route('agencyInfo.list') }}",
            function(res){
                console.log(res);
            }
        )
        var table = create_datatable(
            "infos",
            "{{ route('agencyInfo.list') }}",
            [
                {data : 'id'},
                {data : 'firstname'},
                {data : 'lastname'},
                {data : 'guild_catagory'},
                {data : 'catagory'},
                {data : 'national_id'},
                {data : 'province', render: function(province){
                    return province;
                    if(province_detail != null){
                        return `${province_detail.province} - ${province_detail.city}`;
                    }
                    return '';
                }},
                {data : 'status'},
                {data : 'created_at', render: function(created_at){
                    return created_at.split("T")[0];
                }}
            ]
        )

        table.on('dblclick', 'tr', function(){
            var data = table.row( this ).data();
            url = "{{ route('agencyInfo.editForm', ['parent_id' => 'parent_id']) }}";
            url = url.replace('parent_id', data.id);
            open_admin_modal(
                url
            )
            // show_edit_modal(data.id);
        })

        // function show_edit_modal(id){
        //     var fd = new FormData();
        //     fd.append('id', id);
        //     send_ajax_formdata_request(
        //         "{{ route('role.get') }}",
        //         fd,
        //         function(body){
        //             open_admin_modal_with_data(body);
        //         },
        //         function(data){
        //             show_error(data);
        //             console.log(data);
        //         }
        //     )
        // }

        function new_agency(){
            open_admin_modal(
                "{{ route('agencyInfo.createForm') }}"
            )
        }
    </script>
@endsection