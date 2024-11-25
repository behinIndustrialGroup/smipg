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
                <label for="bornDate">{{ __('marketingTrans::msg.bornDate') }}</label>
                <input type="text" name="bornDate" id="bornDate" class="form-control" value="{{ old('bornDate') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="guildUnit">{{ __('marketingTrans::msg.guildUnit') }}</label>
                <input type="text" name="guildUnit" id="guildUnit" class="form-control" value="{{ old('guildUnit') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="guildNumber">{{ __('marketingTrans::msg.guildNumber') }}</label>
                <input type="text" name="guildNumber" id="guildNumber" class="form-control" value="{{ old('guildNumber') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="province">{{ __('marketingTrans::msg.province') }}</label>
                <input type="text" name="province" id="province" class="form-control" value="{{ old('province') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="city">{{ __('marketingTrans::msg.city') }}</label>
                <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="issue_date">{{ __('marketingTrans::msg.issue_date') }}</label>
                <input type="hidden" name="issueDate" id="issueDate" value="{{ old('issueDate') }}">
                <input type="text" name="" id="issueDateValue" class="form-control"
                    value="{{ old('issueDate') }}" required>
            </div>

            <div class="form-group">
                <label for="expiry_date">{{ __('marketingTrans::msg.expiry_date') }}</label>
                <input type="hidden" name="expiryDate" id="expiryDate" value="{{ old('expiryDate') }}">
                <input type="text" name="" id="expiryDateValue" class="form-control"
                    value="{{ old('expiryDate') }}" required>
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
