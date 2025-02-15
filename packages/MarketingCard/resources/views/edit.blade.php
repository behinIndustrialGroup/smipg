@extends('marketingcard::layouts.master')


@section('content')
    <div class="container row">
        <h2 class="col-sm-12">ویرایش رکورد </h2>

        <div class="col-sm-9">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="javascript:void(0)" id="form" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="national_code">{{ __('marketingTrans::msg.national_code') }}</label>
                    <input type="text" name="nationalId" id="nationalId" class="form-control"
                        value="{{ $row->nationalId }}" required>
                </div>

                <div class="form-group">
                    <label for="first_name">{{ __('marketingTrans::msg.first_name') }}</label>
                    <input type="text" name="firstName" id="firstName" class="form-control" value="{{ $row->firstName }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="last_name">{{ __('marketingTrans::msg.last_name') }}</label>
                    <input type="text" name="lastName" id="lastName" class="form-control" value="{{ $row->lastName }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="father_name">{{ __('marketingTrans::msg.father_name') }}</label>
                    <input type="text" name="fatherName" id="fatherName" class="form-control"
                        value="{{ $row->fatherName }}" required>
                </div>

                <div class="form-group">
                    <label for="bornDate">{{ __('marketingTrans::msg.bornDate') }}</label>
                    <input type="text" name="bornDate" id="bornDate" class="form-control" value="{{ $row->bornDate }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="guildUnit">{{ __('marketingTrans::msg.guildUnit') }}</label>
                    <input type="text" name="guildUnit" id="guildUnit" class="form-control" value="{{ $row->guildUnit }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="guildNumber">{{ __('marketingTrans::msg.guildNumber') }}</label>
                    <input type="text" name="guildNumber" id="guildNumber" class="form-control" value="{{ $row->guildNumber }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="province">{{ __('marketingTrans::msg.province') }}</label>
                    <input type="text" name="province" id="province" class="form-control" value="{{ $row->province }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="city">{{ __('marketingTrans::msg.city') }}</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ $row->city }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="issue_date">{{ __('marketingTrans::msg.issue_date') }}</label>
                    <input type="hidden" name="issueDate" id="issueDate" value="{{ $row->issueDate }}">
                    <input type="text" name="" id="issueDateValue" class="form-control" value="{{ $row->issueDate() }}" required>
                </div>

                <div class="form-group">
                    <label for="expiry_date">{{ __('marketingTrans::msg.expiry_date') }}</label>
                    <input type="hidden" name="expiryDate" id="expiryDate" value="{{ $row->expiryDate }}">
                    <input type="text" name="" id="expiryDateValue" class="form-control" value="{{ $row->expiryDate() }}" required>
                </div>

                <button type="submit" class="btn btn-primary" onclick="edit()">ویرایش</button>
            </form>
        </div>

        <div class="col-sm-3">
            @if ($row->qrCodeFilePath)
                <img src="{{ $row->qrCodeFilePath }}" alt="" width="150">
            @endif
            <!-- دکمه دانلود QR Code به صورت PNG -->
            <a
                href="{{ $row->qrCodeFilePath }}" download>{{ trans('marketingTrans::msg.download_qr_code_file') }}</a>
        </div>

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

        function edit(){
            form = $('#form')
            fd = new FormData(form[0])
            send_ajax_formdata_request(
                '{{ route('marketingcard.update', ['marketingcard' => $row->id]) }}',
                fd,
                function(response){
                    show_message(response)
                }
            )
        }
    </script>
@endsection
