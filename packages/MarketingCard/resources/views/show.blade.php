@extends('layouts.guest')


@section('content')
    <div class="container mt-5">
        <h1>استعلام کارت بازاریابی اتحادیه کشوری تولیدکنندگان و فروشندگان کازهای طبی و صنعتی</h1>

        <!-- نمایش خطا در صورت عدم یافتن شخص -->
        @if (!$person->firstName)
            <div class="alert alert-danger">
                {{ trans('marketingTrans::msg.not_found') }}
            </div>
        @else
            @if ($person->expired)
                <div class="alert alert-danger">{{ trans('marketingTrans::msg.expired') }}</div>
            @else
                <div class="alert alert-success">{{ trans('marketingTrans::msg.valid') }}</div>
            @endif


            <!-- نمایش اطلاعات شخص -->
            <table class="table table-bordered mt-4">
                <tr>
                    <th>کدملی</th>
                    <td>{{ $person->nationalId }}</td>
                </tr>
                <tr>
                    <th>نام</th>
                    <td>{{ $person->firstName }}</td>
                </tr>
                <tr>
                    <th>نام خانوادگی</th>
                    <td>{{ $person->lastName }}</td>
                </tr>
                <tr>
                    <th>نام پدر</th>
                    <td>{{ $person->fatherName }}</td>
                </tr>
                <tr>
                    <th>تاریخ صدور</th>
                    <td>{{ $person->issueDate('persian') }}</td>
                </tr>
                <tr class="{{ $person->expired ? 'bg-danger' : '' }}">
                    <th>تاریخ انقضا</th>
                    <td>{{ $person->expiryDate('persian') }}</td>
                </tr>
            </table>
        @endif
    </div>
@endsection
