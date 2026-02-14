@extends('marketingcard::layouts.master')

@section('content')
<div class="card m-2">
    <a href="{{ route('marketingcard.create') }}"
                class="btn btn-primary">
            <i class="fa fa-plus"></i>
            ایجاد رکورد جدید
            </a>
</div>
    <div class="card m-2">
        <div class="row table-responsive">
            

            <table class="table table-bordered" id="peopleTable">
                <thead>
                    <tr>
                        <th>کدملی</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>نام پدر</th>
                        <th>تاریخ صدور</th>
                        <th>تاریخ انقضا</th>
                        <th>اقدام</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($people as $person)
                        <tr>
                            <td>{{ $person->nationalId }}</td>
                            <td>{{ $person->firstName }}</td>
                            <td>{{ $person->lastName }}</td>
                            <td>{{ $person->fatherName }}</td>
                            <td>{{ $person->issueDate('persian') }}</td>
                            <td>{{ $person->expiryDate('persian') }}</td>
                            <td><a
                                    href="{{ route('marketingcard.edit', ['marketingcard' => $person->id]) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#peopleTable').DataTable({
                'language': {
                    'url': 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/fa.json'
                }
            });
        });
    </script>
@endSection
