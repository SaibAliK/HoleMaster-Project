@extends('layouts.master')
@section('content')
<div class="container-fluid inner-from">

    <form method="post" id="updateClientForm" action="{{ route('client.update', $client->id) }}" class="row">

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

                <button class="clientBtn">Save Client</button>
            </div>
        </div>
{{-- {{dd($admins)}} --}}
        <div class="col-lg-12  mb-3 ">
            <h3>Edit Client</h3>
        </div>
        @if(auth()->user()->type == 'super_admin')
        <div class="col-lg-6 creat_job">
            <div class="form_groups mr-3">
                <label for="client_name">Select Depot</label><br>
                <select name="admin_id" id="client-dropdown"  class="js-example-basic-single" required>
                    <option value="" selected="selected" >Select Depot</option>
                @foreach ($admins as $admin)
                    <option  {{$admin->id == $client->parent_id ? 'selected' : "" }}  value="{{ $admin->id }}">{{ $admin->name }}</option>
                @endforeach
                </select>
            </div>
        </div>
    @endif
        <div class="col-lg-6">
            <div class="form_groups mr-3">
                <label for="name">Name</label>
                <input type="text" id="name" value="{{ $client->client_name }}" name="name" placeholder="Client Name" required>

            </div>
        </div>
        <div class="col-lg-6">
            <div class="form_groups">
                <label for="contact">Contact</label>
                <input type="text" id="contact" value="{{ $client->client_contact }}" name="contact" placeholder=" Client Contact" required>

            </div>
        </div>
        <div class="col-lg-6 ">
            <div class="form_groups mr-3">
                <label for="phone">Phone No</label>
                <input type="num" id="phone" value="{{ $client->phone }}" name="phone" placeholder="Phone No." required>

            </div>
        </div>
        <div class="col-lg-12">
            <div class="form_groups">
                <label for="address1">Office Address 1</label>
                <input type="text" id="address1" value="{{ $client->address1 }}" name="address1" placeholder="Office Address 1" required>

            </div>
        </div>
        <div class="col-lg-12">
            <div class="form_groups">
                <label for="address2">Office Address 2</label>
                <input type="text" id="address2" value="{{ $client->address2 }}" name="address2" placeholder="Office Address 2">

            </div>
        </div>
        <div class="col-lg-6">
            <div class="form_groups mr-3">
                <label for="town">Town</label>
                <input type="text" id="town" value="{{ $client->town }}" name="town" placeholder="Town" required>

            </div>
        </div>
        <div class="col-lg-6">
            <div class="form_groups">
                <label for="city">City</label>
                <input type="text" id="city" value="{{ $client->city }}" name="city" placeholder=" City" required>

            </div>
        </div>
            <div class="col-lg-6 ">
                <div class="form_groups  mr-3">
                    <label for="post_code">Post Code</label>
                    <input type="text" id="post_code" required  name="post_code" value="{{ $client->post_code }}"
                        placeholder=" Post Code">
                </div>
        </div>
        <label for="sites"> Enter Sites</label>
        @foreach ($client->sites as $site_value) 
        <div class="col-lg-12">
            <div id="row">
                <div class="input-group m-3">
                    <input type="text" id="sites" value ="{{ $site_value->site }} " name="sites[0][name]" class="form-control m-input"
                        placeholder=" Enter Site" >
                    <input type="text" id="site_address" value ="{{ $site_value->site_address }}" name="sites[0][site_address]" class="form-control m-input"
                        placeholder=" Enter Site Addrees">
                    <input type="email" id="site_email" value ="{{ $site_value->site_email }} " name="sites[0][site_email]" class="form-control m-input"
                        placeholder=" Enter Email">
                    <input type="text" id="phone" value ="{{ $site_value->site_phone }} " name="sites[0][site_phone]" class="form-control m-input"
                        placeholder="Enter Site">
                        <input type="text" id="contact" value ="{{ $site_value->site_contact }} " name="sites[0][site_contact]" class="form-control m-input"
                        placeholder="Enter Contact">
                    <div class="input-group-prepend">
                        <img src="{{ asset('assets/images/delete_icon.png') }}" id="DeleteRow" alt="img">
                    </div>
                </div>
            </div>
        </div>
        @endforeach

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

            $('#updateClientForm').validate({
                rules: {
                    stage: {
                        required: true,
                    },
                    sites: {
                        required: true,
                    }
                },
                errorPlacement: function(error, element) {
                    console.log(element.attr("name"));
                    if (element.attr("name") == "stage") {
                        $("#stageError").html(
                            `<label id="stage-error" class="error" for="stage">This field is required.</label>`
                        );
                    } else {
                        error.insertAfter(element);
                    }
                },
            });

            let counter = 1;
            $("#rowAdder").click(function() {
                newRowAdd =
                '<div id="row"> <div class="input-group m-3">' +
                    '<input type="text" id="sites" name="sites[' + counter +
                    '][name]" class="form-control m-input" placeholder=" Enter Site">' +
                    '<input type="text" id="site_address" name="sites[' + counter +
                    '][site_address]" class="form-control m-input" placeholder=" Enter site_address" >' +
                    '<input type="email" id="site_email" name="sites[' + counter +
                    '][site_email]" class="form-control m-input" placeholder=" Enter email" >' +
                    '<input type="text" id="phone" name="sites['+ counter +'][site_phone]" class="form-control m-input" placeholder="Phone No." >' +
                    '<input type="text" id="contact" name="sites['+ counter +'][site_contact]" class="form-control m-input" placeholder="Contact." >' +

                    '<div class="input-group-prepend">'+
                        '<img src="{{asset('assets/images/delete_icon.png')}}" id="DeleteRow" alt="img">'+
                    '</div></div></div>';
                    
                $('#newinput').append(newRowAdd);
                counter++;

            });

            $("body").on("click", "#DeleteRow", function() {
                $(this).parents("#row").remove();
            })
        });
    </script>
    @endpush