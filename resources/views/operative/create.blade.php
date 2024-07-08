@extends('layouts.master')
@section('content')


<div class="container-fluid inner-from">


    <form method="POST" id="saveOperativeForm" action="{{route('operative.store')}}" class="row mt-5">

        @csrf
        @if ($message = Session::get('error'))
        <div class="successAlertMsg alert">
            <p class="successAlertText">
                {{ $message }}
            </p>
        </div>
        @endif
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach

        <div class="col-lg-12 justify-content-end d-flex align-items-center">
            <div class="Create_button ">
                <button class="clientBtn">Save Operative</button>
            </div>
        </div>
        <div class="col-lg-12 mb-4">
            <h3>Add Operative</h3>
        </div>
        @if(auth()->user()->type == 'super_admin')
        <div class="col-lg-6 creat_job">
            <div class="form_groups mr-3">
                <label for="client_name">Select Depot</label><br>
                <select name="admin_id" id="client-dropdown" class="js-example-basic-single" required>
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
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" placeholder="First Name" required>

            </div>
        </div>
        <div class="col-lg-6">
            <div class="form_groups">
                <label for="surname">Surname</label>
                <input type="num" id="surname" name="surname" placeholder=" Surname" required>

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
                <label for="phone">Phone No.</label>
                <input type="num" id="phone" name="phone" placeholder="Phone No." required>

            </div>
        </div>
        {{-- <div class="col-lg-12">
            <div class="form_groups">
                <label for="address1">Office Address 1</label>
                <input type="text" id="address1" name="address1" placeholder="Office Address 1" >
                @error('address1')
                <h1 class="valdiation">*This field is required"</h1>
                @enderror
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form_groups">
                <label for="address2">Office Address 2</label>
                <input type="text" id="address2" name="address2" placeholder="Office Address 2" >

            </div>
        </div> --}}
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
    </form>

</div>
@endsection

@push('scripts-end')
<script>
    $(document).ready(function() {

        $('#saveOperativeForm').validate({
            rules: {
                stage: {
                    required: true,
                }
            },
            errorPlacement: function(error, element) {
                console.log(element.attr("name"));
                if (element.attr("name") == "stage") {
                    $("#stageError").html(`<label id="stage-error" class="error" for="stage">This field is required.</label>`);
                } else if (element.attr("name") == "admin_id") {
                    $("#admin_id_error").html(`<label id="admin_id-error" class="error" for="admin_id">This field is required.</label>`);
                } else {
                    error.insertAfter(element);
                }
            },
        });
    });
</script>
@endpush