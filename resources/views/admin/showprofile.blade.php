@extends('layouts.master')
@section('content')
    <div class="container-fluid inner-from">
        <form action="{{ route('adminprofileupdate', $admin->id) }}" id="saveadminForm" method="POST" class="row">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="inner_wrapper">
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
                                <button class="clientBtn">Update Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-lg-12 ">
                    <h3>Profile Details</h3>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form_groups mr-3">
                    <label for="name">Name</label>
                    <input required type="text" name="name" value="{{ $admin->name }}">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form_groups mr-3">
                    <label for="email">Your Email</label>
                    <input type="email" readonly name="email" value="{{ $admin->email }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form_groups">
                    <label for="password">Password</label>
                    <input required type="password" id="password" value="" name="password" placeholder="Password">
                </div>
            </div>
        </form>
    </div>
@endsection
<script>
$(document).ready(function() {

    $('#saveadminForm').validate({
        rules: {
            name: {
                required: true,
            },
            password: {
                required: true,
            }
        },
    });
});
</script>
