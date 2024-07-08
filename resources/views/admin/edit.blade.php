@extends('layouts.master')
@section('content')
<div class="container-fluid inner-from">

    <form method="post" id="updateadminForm" action="{{ route('admin.update', $admin->id) }}" class="row">

        @csrf
        @if ($message = Session::get('error'))
        <div class="successAlertMsg alert">
            <p class="successAlertText">
                {{ $message }}
            </p>
        </div>
        @endif
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        <div class="creat_new_job  justify-content-end d-flex align-items-center">
            <div class="Create_button ">

                <button class="clientBtn">Save Depot</button>
            </div>
        </div>

        <div class="col-lg-12  mb-3 ">
            <h3>Edit Depot</h3>
        </div>

        <div class="col-lg-6">
            <div class="form_groups mr-3">
                <label for="name">Name</label>
                <input type="text" id="name" value="{{ $admin->name }}" name="name" placeholder="Client Name" required>

            </div>
        </div>
        <div class="col-lg-6">
            <div class="form_groups">
                <label for="email">Contact Email</label>
                <input type="email" id="email" value="{{ $admin->email }}" name="email" placeholder="Email" required>
            </div>
        </div>
       
        <div class="col-lg-6">
            <div class="form_groups">
                <label for="address">Address</label>
                <input type="address" id="address" value="{{ $admin->address }}" name="address" placeholder="Enter Address" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form_groups">
                <label for="password">Password</label>
                <input  type="password" id="password" value="" name="password" placeholder=" Password">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="manage_checkbox">
                <div class="form_id_err mb-3"></div>

                @foreach ($permissions as $permission)
                <div class="d-flex justify-content-between mb-4">
                    <p>
                     {{$permission->name ?? ''}}
                    </p>
                    <div>
                    <input type="checkbox" class="ml-5" {{in_array($permission->id,$permission_ids) ? 'checked' : ''}} name="permissions[]" value="{{$permission->id}}" required>
                    <label>
                        <span class="custom-checkbox"></span> 
                    </label>
                </div>
            </div>
                    @endforeach
                </div>
            </div>
        </div>

    </form>
    @endsection

    @push('scripts-end')
    <script>
        $(document).ready(function() {

            $('#updateadminForm').validate({
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
                            `<label class="error">Please Select Permission  to Continue.</label>`);
                    } 
                 else {
                        error.insertAfter(element);
                    }
                },
            });
        });
    </script>
    @endpush