@extends('layouts.master')
@section('content')
<div class="container-fluid inner-from">
    <form method="POST" id="saveClientForm" name="registration " action="{{ route('client.store') }}" class="row mt-5">
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
                <button class="clientBtn">Save Client</button>
            </div>
        </div>
        <div class="col-lg-12 mb-4 ">
            <h3>Add Client</h3>
        </div>

        @if (auth()->user()->type == 'super_admin')
        <div class="col-lg-6 creat_job">
            <div class="form_groups mr-3">
                <label for="">Select Depot</label><br>
                <select name="admin_id" id="" class="js-example-basic-single" required>
                    <option value="" selected="selected">Select Depot</option>
                    @foreach ($admins as $admin)
                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                    @endforeach
                </select>
                <div id="admin_id_error"></div>
            </div>
        </div>
        @endif
        <div class="col-lg-6">
            <div class="form_groups mr-3">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Client Name" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form_groups">
                <label for="contact">Contact No</label>
                <input type="num" id="phone" name="contact" placeholder=" Client Contact" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form_groups mr-3">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form_groups">
                <label for="phone">Phone No</label>
                <input type="num" id="phone" name="phone" placeholder="Phone No." required>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form_groups">
                <label for="address1">Office Address 1</label>
                <input type="text" id="address1" name="address1" placeholder="Office Address 1" required>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form_groups">
                <label for="address2">Office Address 2</label>
                <input type="text" id="address2" name="address2" placeholder="Office Address 2" >
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form_groups mr-3">
                <label for="town">Town</label>
                <input type="text" id="town" name="town" placeholder="Town" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form_groups">
                <label for="city">City</label>
                <input type="text" id="city" name="city" placeholder=" City" required>
            </div>
        </div>
        <div class="col-lg-6 ">
            <div class="form_groups  mr-3">
                <label for="post_code">Post Code</label>
                <input type="text" id="post_code" required name="post_code" placeholder=" Post Code">
            </div>
        </div>
        <label for="sites"> Enter Sites</label>
        <div class="col-lg-12">
            <div id="row">
                <div class="input-group m-3" name="site_id">
                    <input type="text" id="sites" name="sites[0][name]" class="form-control m-input" placeholder="Site">
                    <input type="text" id="site_address" name="sites[0][site_address]" class="form-control m-input" placeholder="Site Address">
                    <input type="email" id="site_email" name="sites[0][site_email]" class="form-control m-input" placeholder="Email">
                    <input type="text" id="phone" name="sites[0][site_phone]" class="form-control m-input" placeholder="Phone No.">
                    <input type="text" id="site_contact" name="sites[0][site_contact]" class="form-control m-input" placeholder="Contact">
                    <div class="input-group-prepend">
                        <img src="{{ asset('assets/images/delete_icon.png') }}" id="DeleteRow" alt="img">
                    </div>
                    <div id="site_id_error"></div>
                </div>
               
            </div>
        </div>
        <div id="newinput"></div>
        <button id="rowAdder" type="button" class="btn btn-dark">
            <span class="bi bi-plus-square-dotted"></span> ADD
        </button>
    </form>
</div>
@endsection

@push('scripts-end')
<script>
    $(document).ready(function() {
        $('#saveClientForm').validate({
            rules: {
                stage: {
                    required: true,
                },
                
            },
            errorPlacement: function(error, element) {
                console.log(element.attr("name"));
                if (element.attr("name") == "stage") {
                    $("#stageError").html(
                        `<label id="stage-error" class="error" for="stage">This field is required.</label>`
                    );
                } else if (element.attr("name") == "admin_id") {
                    $("#admin_id_error").html(`<label id="admin_id-error" class="error" for="admin_id">This field is required.</label>`);
                } 
                 else if (element.attr("name") == "site_id") {
                    $("#site_id_error").html(`<label id="site_id-error" class="error" for="site_id">Site is required.</label>`);
                }else {
                    error.insertAfter(element);
                }
            },
        });
        let counter = 1;
        $("#rowAdder").click(function() {

            newRowAdd =
                '<div id="row"> <div class="input-group m-3">' +
                '<input type="text" id="sites" name="sites[' + counter +
                '][name]" class="form-control m-input" placeholder="  Site" >' +
                '<input type="text" id="site_address" name="sites[' + counter +
                '][site_address]" class="form-control m-input" placeholder="  Site Address" >' +
                '<input type="email" id="site_email" name="sites[' + counter +
                '][site_email]" class="form-control m-input" placeholder=" Email" >' +
                '<input type="text" id="phone" name="sites[' + counter +
                '][site_phone]" class="form-control m-input" placeholder="Phone No." >' +
                '<input type="text" id="contact" name="sites[' + counter +
                '][site_contact]" class="form-control m-input" placeholder="Contact" >' +
                '<div class="input-group-prepend">' +
                '<img src="{{ asset('assets/images/delete_icon.png')}}" id="DeleteRow" alt="img">' +
                '</div></div></div>';

            $('#newinput').append(newRowAdd);
            console.log(counter)
            counter++;
        });

        $("body").on("click", "#DeleteRow", function() {
            $(this).parents("#row").remove();
        })
    });
</script>
@endpush