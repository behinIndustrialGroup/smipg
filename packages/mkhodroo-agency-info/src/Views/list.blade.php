@extends('layouts.app')

@section('content')
    <div class="box">
        <div class="card p-4">
            <button onclick="new_agency()" class="btn btn-primary col-sm-1">{{ __('New') }}</button>
        </div>
        <div class="card p-4">
            <table>
            <form action="javascript:void(0)" id="filter-form1" class="col-sm-12 table-responsive">
                <td>{{ __('guild_catagory') }}</td>
                <td>
                    <select name="guild_catagory" id="" class="form-control">
                        <option value="">{{ __('All') }}</option>
                        @foreach (config('agency_info.agency') as $catagory => $catagory_detail)
                            <option value="{{ $catagory }}">{{ $catagory_detail['catagory_fa'] }}</option>
                        @endforeach
                    </select>
                </td>
                
            
                <td>
                    <input type="text" name="field_value" id="" class="form-control"
                        placeholder="{{ __('Everything') }}">
                </td>
                <td>
                    <button onclick="filter1()" class="btn btn-primary">{{ __('Filter') }}</button>
                </td>
            </table>
            </form>
        </div>
        <div class="card p-4">
            <table class="table table-stripped" id="infos">
                <thead>
                    <tr>
                        <th>{{ __('id') }}</th>
                        <th>{{ __('file number') }}</th>
                        <th>{{ __('firstname') }}</th>
                        <th>{{ __('lastname') }}</th>
                        <th>{{ __('guild_catagory') }}</th>
                        <th>{{ __('catagory') }}</th>
                        <th>{{ __('national id') }}</th>
                        <th>{{ __('province') }}</th>
                        <th>{{ __('status') }}</th>
                        <th>{{ __('created at') }}</th>
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
            function(res) {
                console.log(res);
            }
        )
        var table = create_datatable(
            "infos",
            "{{ route('agencyInfo.list') }}",
            [{
                    data: 'id'
                },
                {
                    data: 'file_number',
                    render: function(data) {
                        return data ? data : '';
                    }
                },
                {
                    data: 'firstname',
                    render: function(data) {
                        return data ? data : '';
                    }
                },
                {
                    data: 'lastname',
                    render: function(data) {
                        return data ? data : '';
                    }
                },
                {
                    data: 'guild_catagory',
                    render: function(data) {
                        return data ? data : '';
                    }
                },
                {
                    data: 'catagory',
                    render: function(data) {
                        return data ? data : '';
                    }
                },
                {
                    data: 'national_id',
                    render: function(data) {
                        return data ? data : '';
                    }
                },
                {
                    data: 'province_detail',
                    render: function(province_detail) {
                        if (province_detail) {
                            return `${province_detail.province} - ${province_detail.city}`;
                        }
                        return '';
                    }
                },
                {
                    data: 'status',
                    render: function(data) {
                        return data ? data : '';
                    }
                },
                {
                    data: 'created_at',
                    render: function(created_at) {
                        return created_at.split("T")[0];
                    }
                }
            ]
        )

        table.on('dblclick', 'tr', function() {
            var data = table.row(this).data();
            console.log(data);
            url = "{{ route('agencyInfo.editForm', ['parent_id' => 'parent_id']) }}";
            url = url.replace('parent_id', data.parent_id);
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

        function new_agency() {
            open_admin_modal(
                "{{ route('agencyInfo.createForm') }}"
            )
        }

        function filter1() {
            var fd = new FormData($('#filter-form1')[0]);

            send_ajax_formdata_request(
                "{{ route('agencyInfo.filterList') }}",
                fd,
                function(res) {
                    console.log(res);
                    update_datatable(res.data);
                }
            )
        }

    </script>
@endsection
