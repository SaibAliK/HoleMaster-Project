
@extends('layouts.master')
@section('content')
<div class="container-fluid inner-from">
    <div class="row">
        <div class="col-lg-12 ">
            <div class="inner_wrapper">


            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-lg-12 ">
            <h3>Edit Profile</h3>

        </div>
    </div>
        <form method="POST"  id= "saveOperativeDetails" action="{{route('operative.updatedetail',['id'=>auth()->user()->id])}}" class="row">
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
            <div class="creat_new_job  justify-content-end d-flex align-items-center">
                <div class="Create_button ">
                    <button class="clientBtn">Save Profile</button>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form_groups mr-3">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" value="{{$operative->first_name}}" name="first_name" placeholder="First Name" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form_groups">
                    <label for="surname">Surname</label>
                    <input type="num" id="surname" value="{{$operative->surname}}" name="surname" placeholder=" Surname" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form_groups">
                    <label for="phone">Phone No.</label>
                    <input type="num" id="phone" value="{{$operative->phone}}" name="phone" placeholder="Phone No." required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form_groups">
                    <label for="address1">Office Address 1</label>
                    <input type="text" id="address1" value="{{$operative->address1}}" name="address1" placeholder="Office Address 1" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form_groups">
                    <label for="address2">Office Address 2</label>
                    <input type="text" id="address2" value="{{$operative->address2}}" name="address2" placeholder="Office Address 2" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form_groups mr-3">
                    <label for="town">Town</label>
                    <input type="text" id="town" value="{{$operative->town}}" name="town" placeholder="Town" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form_groups">
                    <label for="city">City</label>
                    <input type="text" id="city" value="{{$operative->city}}" name="city" placeholder=" City" required>
                </div>
            </div>
            <div class="col-lg-6 ">
                <div class="form_groups  mr-3">
                    <label for="post_code">Post Code</label>
                    <input type="text" id="post_code" value="{{$operative->post_code}}" name="post_code" placeholder=" Post Code" required>
                </div>
            </div>
        </form>

    @endsection
    @push('scripts-end')
<script>
    $(document).ready(function() {

        $('#saveOperativeDetails').validate({
            rules: {
                stage: {
                    required: true,
                }
            },
            errorPlacement: function(error, element) {
                console.log(element.attr("name"));
                if (element.attr("name") == "stage") {
                    $("#stageError").html(`<label id="stage-error" class="error" for="stage">This field is required.</label>`);
                } else {
                    error.insertAfter(element);
                }
            },
        });
    });
</script>
@endpush