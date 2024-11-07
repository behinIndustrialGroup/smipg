@extends('marketingcard::layouts.master')

@section('content')
    <div class="row table-responsive">
        <a href="{{ route('marketingcard.create') }}" class="btn btn-primary">{{ trans('marketingTrans::msg.create') }}</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ trans('marketingTrans::msg.national_code') }}</th>
                    <th>{{ trans('marketingTrans::msg.first_name') }}</th>
                    <th>{{ trans('marketingTrans::msg.last_name') }}</th>
                    <th>{{ trans('marketingTrans::msg.father_name') }}</th>
                    <th>{{ trans('marketingTrans::msg.issue_date') }}</th>
                    <th>{{ trans('marketingTrans::msg.expiry_date') }}</th>
                    <th>{{ trans('marketingTrans::msg.show') }}</th>
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
                                href="{{ route('marketingcard.edit', ['marketingcard' => $person->id]) }}">{{ trans('marketingTrans::msg.show') }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
@endsection
