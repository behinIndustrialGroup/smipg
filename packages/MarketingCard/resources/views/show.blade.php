@extends('layouts.guest')

@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #e0f7fa, #e3f2fd);
            /* ترکیب رنگ آبی ملایم */
            font-family: 'IRANSans', Arial, sans-serif;
            /* فونت فارسی */
        }

        h1 {
            color: #0277bd;
            /* رنگ آبی تیره */
            font-size: 1.5rem;
        }

        .custom-container {
            background: #ffffff;
            /* زمینه سفید برای محتوا */
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .table {
            font-size: 1rem;
        }

        .custom-alert {
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 10px;
        }

        .table-primary {
            background-color: #81d4fa;
            /* رنگ آبی ملایم برای جدول */
        }

        .table-bordered th,
        .table-bordered td {
            vertical-align: middle;
        }

        .bg-danger {
            background-color: #ef5350 !important;
            /* قرمز ملایم */
        }

        .text-center {
            text-align: center;
        }
    </style>
    <div class="container mt-5 p-4 custom-container">
        <div class="card-header text-center" >
            <img src="{{url('public/logo.png')}}" class="col-sm-12" alt="" style="width: 270px">
        </div>
        <h1 class="text-center mb-4">استعلام کارت بازاریابی اتحادیه کشوری تولیدکنندگان و فروشندگان گازهای طبی و صنعتی</h1>

        <!-- نمایش خطا در صورت عدم یافتن شخص -->
        @if (!$person->firstName)
            <div class="alert alert-danger text-center custom-alert">
                {{ trans('marketingTrans::msg.not_found') }}
            </div>
        @else
            @if ($person->expired)
                <div class="alert alert-danger text-center custom-alert">
                    {{ trans('marketingTrans::msg.expired') }}
                </div>
            @else
                <div class="alert alert-success text-center custom-alert">
                    {{ trans('marketingTrans::msg.valid') }}
                </div>
            @endif

            <!-- نمایش اطلاعات شخص -->
            <table class="table table-bordered table-striped mt-4 text-center">
                <thead>
                    <tr class="table-primary">
                        <th>عنوان</th>
                        <th>اطلاعات</th>
                    </tr>
                </thead>
                <tbody>
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
                        <th>واحد صنفی</th>
                        <td>{{ $person->guildUnit }}</td>
                    </tr>
                    <tr>
                        <th>شماره صنفی</th>
                        <td>{{ $person->guildNumber }}</td>
                    </tr>
                    <tr>
                        <th>استان</th>
                        <td>{{ $person->province }}</td>
                    </tr>
                    <tr>
                        <th>تاریخ صدور</th>
                        <td>{{ $person->issueDate('persian') }}</td>
                    </tr>
                    <tr class="{{ $person->expired ? 'bg-danger text-white' : '' }}">
                        <th>تاریخ انقضا</th>
                        <td>{{ $person->expiryDate('persian') }}</td>
                    </tr>
                </tbody>
            </table>
            <div style="height: 50px">

            </div>
        @endif
    </div>
@endsection
