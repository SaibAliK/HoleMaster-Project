@extends('layouts.master')
@section('content')


<div class="container-fluid inner-from">
  <div class="row">
    <div class="col-lg-12 ">
      <div class="inner_wrapper">
        <form action="">

        </form>

      </div>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-lg-12 ">
      <h3>Add/Edit Client</h3>
    </div>
  </div>
  <form method="post" action="{{route('job.update',$job->id)}}" class="row">

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
        <!-- <a href="#">Save Client</a> -->
        <button class="clientBtn">Save Job</button>
      </div>
    </div>


    <div class="col-lg-6">
      <div class="form_groups mr-3">
        <select name="client_name" id="client_name">
          <!-- <option value="" selected="selected">Select Client</option> -->
          @foreach($clients as $client)
          <option value="{{$client->id}}" @if($client->id == $job->client_id) {{"selected"}} @endif >{{$client->client_name}}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="form_groups mr-3">
        <select name="operative_name" id="operative_name">
          @foreach($operatives as $operative)
          <option value="{{$operative->id}}" @if($operative->id == $job->operative_id) {{"selected"}} @endif>{{$operative->first_name}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-lg-6 ">
      <div class="form_groups  mr-3">
        <input type="date" id="visit_date" value="{{$job->visit_date}}" name="visit_date" placeholder="Site Visit Date">
      </div>
    </div>
  </form>



  @endsection