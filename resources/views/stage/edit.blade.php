@extends('layouts.master')
@section('content')
    <div class="container-fluid inner-from">
        <form method="POST" id="" name="registration" action="{{ route('stage.update', $stage->id) }}"
            class="row mt-5">
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
                    <button class="clientBtn">Update Stage</button>
                </div>
            </div>
            <div class="col-lg-12 mb-4 ">
                <h3>Update Stage</h3>
            </div>
            <div class="col-lg-6">
                <div class="form_groups mr-3">
                    <label for="name">Stage Name</label>
                    <input type="text" id="name" value="{{ $stage->name }}" name="name" placeholder="" required>
                </div>
            </div>
        </form>
    </div>
@endsection
