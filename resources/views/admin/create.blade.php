@extends('layouts.master')
@section('content')
    <div class="container-fluid inner-from">
        <form method="POST" id="saveadminForm" name="registration " action="{{ route('admin.store') }}" class="row mt-5">
            @csrf
            @if ($message = Session::get('error'))
                <div class=" successAlertMsg alert">
                    <p class="successAlertText">
                        {{ $message }}
                    </p>
                </div>
            @endif
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

            <div class="col-lg-12 justify-content-end d-flex align-items-center">
                <div class="Create_button ">
                    <button class="clientBtn">Save Depot</button>
                </div>
            </div>
            <div class="col-lg-12 mb-4 ">
                <h3>Add Depot</h3>
            </div>
            <div class="col-lg-6">
                <div class="form_groups mr-3">
                    <label for="name">Depot Name</label>
                    <input type="text" id="name" name="name" placeholder="Depot Name" autocomplete="off"
                        required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form_groups">
                    <label for="email"> Depot Email</label>
                    <input type="email" id="email" name="email" placeholder=" Depot Email" autocapitalize="off"
                        required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form_groups">
                    <label for="email">Depot Address </label>
                    <input type="text" id="address" name="address" placeholder=" Depot Address" autocapitalize="off"
                        required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form_groups">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" autocomplete="off"
                        required>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="manage_checkbox">
                    <div class="form_id_err mb-3"></div>
                    @foreach ($permissions as $permission)
                        <div class="d-flex justify-content-between mb-4">
                            <p>{{ $permission->name ?? '' }} </p>
                            <div>
                                <input type="checkbox" class="ml-5" name="permissions[]" value="{{ $permission->id }} "
                                    required>
                                <label>
                                    <span class="custom-checkbox"></span>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts-end')
    <script>
        $(document).ready(function() {

            $('#saveadminForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                errorPlacement: function(error, element) {
                    console.log(element.attr("name"));
                    if (element.attr("name") == "stage") {
                        $("#stageError").html(
                            `<label id="stage-error" class="error" for="stage">This field is required.</label>`
                        );
                    } else if (element.attr("name") == "permissions[]") {
                        $(".form_id_err").html(
                            `<label class="error">Please Select the Forms to Continue.</label>`);
                    } else {
                        error.insertAfter(element);
                    }
                },
            });
        });
    </script>
@endpush
