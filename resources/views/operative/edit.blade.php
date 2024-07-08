<!-- <form method="POST" action="{{route('operative.update',$operative->id)}}">
@foreach($errors->all() as $error)
          <li>{{$error}}</li>
     @endforeach
    @csrf
  <label for="name">First name:</label><br>
  <input type="text" id="name" value="{{$operative->first_name}}" name="first_name"><br>
  <label for="surname">Surname:</label><br>
  <input type="text" id="surname" value="{{$operative->surname}}" name="surname" ><br>
  <label for="phone">Phone:</label><br>
  <input type="text" id="phone" value="{{$operative->phone}}" name="phone" ><br>
  <label for="address1">Office Address1:</label><br>
  <input type="text" id="address1" value="{{$operative->address1}}" name="address1" ><br>
  <label for="address2">Office Address2:</label><br>
  <input type="text" id="address2" value="{{$operative->address2}}" name="address2" ><br>
  <label for="town">Town:</label><br>
  <input type="text" id="town" value="{{$operative->town}}" name="town" ><br>
  <label for="city">City:</label><br>
  <input type="text" id="city" value="{{$operative->city}}" name="city" ><br>
  <label for="post_code">Post Code:</label><br>
  <input type="text" id="post_code" value="{{$operative->post_code}}" name="post_code" ><br>
  <input type="submit" value="Submit">
</form>  -->



@extends('layouts.master')
@section('content')
<div class="container-fluid inner-from">
    <div class="row">
        <div class="col-lg-12 ">
            <div class="inner_wrapper">


            </div>
        </div>
    </div>
    <form method="POST" id="saveOperativeForm" action="{{route('operative.update',$operative->id)}}" class="row ">

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
        <div class="col-lg-12 creat_new_job  justify-content-end d-flex align-items-center" style="margin-top: 40px;">
            <div class="Create_button ">
                <button class="clientBtn">Save Operative</button>
            </div>
        </div>
        <div class="col-lg-12 mb-3">
            <h3>Edit Operative</h3>
        </div>
        @if(auth()->user()->type == 'super_admin')
        <div class="col-lg-6 creat_job">
            <div class="form_groups mr-3">
                <label for="client_name">Select Depot</label><br>
                <select name="admin_id" id="client-dropdown"  class="js-example-basic-single" required>
                    <option value="" selected="selected" >Select Depot</option>
                @foreach ($admins as $admin)
                    <option  {{$admin->id == $operative->parent_id ? 'selected' : "" }}  value="{{ $admin->id }}">{{ $admin->name }}</option>
                @endforeach
                </select>
            </div>
        </div>
        @endif
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
                <input type="num" id="phone" value="{{$operative->phone}}"  name="phone" placeholder="Phone No." required>
            
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form_groups mr-3">
                <label for="">Email</label>
                <input type="email" readonly id="" value="{{$operative->operativeUsers->email}}" name="email" placeholder="Email" >
            </div>
        </div>
        {{-- <div class="col-lg-12">
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
        </div> --}}
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
                {{-- <input type="num" id="post_code" name="post_code" placeholder=" Post Code" required> --}}
                <input type="text" id="post_code" value="{{$operative->post_code}}" required  name="post_code" placeholder=" Post Code">

            </div>
        </div>
        <div class="col-lg-6">
            <div class="form_groups">
                <label for="password">New Password</label>
                <input  type="password" id="password" value="" name="password" placeholder=" Password">
            </div>
        </div>
    </form>
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
                    } else {
                        error.insertAfter(element);
                    }
                },
            });
        });
    </script>
    @endpush