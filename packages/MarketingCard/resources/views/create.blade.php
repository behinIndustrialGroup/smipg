@extends('marketingcard::layouts.master')


@section('content')
    <div class="container">
        <h2>ایجاد رکورد جدید</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('marketingcard.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="national_code">{{ __('marketingTrans::msg.national_code') }}</label>
                <input type="text" name="nationalId" id="nationalId" class="form-control" value="{{ old('nationalId') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="first_name">{{ __('marketingTrans::msg.first_name') }}</label>
                <input type="text" name="firstName" id="firstName" class="form-control" value="{{ old('firstName') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="last_name">{{ __('marketingTrans::msg.last_name') }}</label>
                <input type="text" name="lastName" id="lastName" class="form-control" value="{{ old('lastName') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="father_name">{{ __('marketingTrans::msg.father_name') }}</label>
                <input type="text" name="fatherName" id="fatherName" class="form-control" value="{{ old('fatherName') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="issue_date">{{ __('marketingTrans::msg.issue_date') }}</label>
                <input type="text" name="issueDate" id="issueDate" value="{{ old('issueDate') }}">
                <input type="text" name="" id="issueDateValue" class="form-control"
                    value="{{ old('issueDate') }}" required>
            </div>

            <div class="form-group">
                <label for="expiry_date">{{ __('marketingTrans::msg.expiry_date') }}</label>
                <input type="text" name="expirtDate" id="expirtDate" value="{{ old('expirtDate') }}">
                <input type="text" name="" id="expirtDateValue" class="form-control"
                    value="{{ old('expirtDate') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">ایجاد</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        initial_view()
        $("#issueDateValue").persianDatepicker({
            format: 'YYYY-MM-DD',
            observer: true,
            altField: '#issueDate',
        });
        $("#expiryDateValue").persianDatepicker({
            format: 'YYYY-MM-DD',
            observer: true,
            altField: '#expiryDate',
        });
    </script>
@endsection
