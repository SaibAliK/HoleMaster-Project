@extends('layouts.master')
@section('content')


<div class="container-fluid inner-from">
  <div class="row mb-5">
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
        <button class="clientBtn">Update Job</button>
      </div>
    </div>

    <div class="col-lg-12 mb-3">
      <h3>Edit Job</h3>
    </div>


    @if(auth()->user()->type == 'super_admin')
    <div class="col-lg-6 creat_job">
      <div class="form_groups mr-3">
        <label for="depot_id">Depot</label><br>
        <select name="depot_id" id="depot_id" class="js-example-basic-single" required>
          <option value="" selected="selected">Select Depot</option>
          @foreach ($admins as $admin)
          <option value="{{ $admin->id }}" {{$admin->id == $job->parent_id ? 'selected' : '' }}>{{ $admin->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    @endif

    <div class="col-lg-6 hide_for_depo {{ auth()->user()->type == 'super_admin' ? 'd-none' : ''}}">
      <div class="form_groups mr-3">
        <label for="client_name">Client</label><br>
        <input type="hidden" id="client_id" value="{{$job->client_id}}">
        <select name="client_name" id="client-dropdown" required>
          @foreach($clients as $client)
          <option value="{{$client->id}}" @if($client->id == $job->client_id) {{"selected"}} @endif >{{$client->client_name}}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="col-lg-6 hide_for_depo {{ auth()->user()->type == 'super_admin' ? 'd-none' : ''}}">
      <div class="form_groups mr-3">
        <label for="operative_name">Operative</label><br>
        <input type="hidden" id="opera_id" value="{{$job->userOperative->id}}">
        <select name="operative_name" id="operative_name" required>
          @foreach($operatives as $operative)
          <option value="{{$operative->user_id}}" @if($operative->user_id == $job->userOperative->id) {{"selected"}} @endif>{{$operative->first_name}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-lg-6 hide_for_depo {{ auth()->user()->type == 'super_admin' ? 'd-none' : ''}}">
      <div class="form_groups mr-3">
        <label for="sites"> Site </label><br>
        <select name="sites" id="site-dropdown" required>
          <option selected value="{{$job->jobSite->id}}">{{$job->jobSite->site}}</option>
        </select>
      </div>
    </div>

    <div class="col-lg-6 ">
      <div class="form_groups  mr-3">
        <label for="visit_date">Initial Site Visit Date</label>
        <input type="date" id="visit_date" value="{{$job->visit_date}}" name="visit_date" placeholder="Site Visit Date" required min="{{ date('Y-m-d')}}">

      </div>
    </div>

    @if(!($forms->isEmpty()))
    <div class="row  main_from_sitetable">
      <div class="col-lg-12 mb-3 form_wrapper">
        <h3>Forms</h3>
      </div>
      @foreach($forms as $form)
      <div class="col-lg-4 main_div">
        <div class="site_Head manage_checkbox">
          <p>{{$form->form_name ??  '' }}</p>
          <div>
              <input name="form_id[]" type="checkbox" id="formId" {{in_array($form->id,$form_ids) ? 'checked' : ''}} value="{{$form->id}}" class="table_btn formId">
              <label>
                  <span class="custom-checkbox"></span> 
              </label>
          </div>
      </div>
      @if ($loop->last)
          @error('form_id')
              <div class="alert">{{ $message }}</div>
          @enderror
      @endif
        <div class="site_table d-flex justify-content-between align-items-start new_class">
          <div class="site_desc">
            <input type="hidden" name="" id="form_id" value="">
            <p>{{$form->form_name ??  '' }}</p>
            <p>{{$form->category ??  '' }}</p>
            <p>{{$form->seen_by ??  '' }}</p>
            <div>Question </div>
            @foreach($form->sections as $sections)
            @foreach($sections->questions as $question)
            <p>
              @if($question->question != "NULL")
                  {{$question->question ??  '' }}
              </p>
              @endif
            @endforeach
            @endforeach
          </div>
          <div class="site_icons d-flex">
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </form>
  @endsection

  @push('scripts-end')
  <script>
    $(document).ready(function() {

      $('#client-dropdown').on('change', function() {
        var siteID = this.value;
        // alert(siteID);
        $("#site-dropdown").html('');
        var ur = "{{ route('job.sites') }}" + "/" + siteID;
        $.ajax({
          url: ur,
          type: "GET",
          dataType: 'json',
          success: function(result) {
            $("#sites_drop").removeClass("d-none");
            $('#site-dropdown').html('<option value=""> Select Site </option>');
            $.each(result, function(key, value) {
              $("#site-dropdown").append('<option value="' + value
                .id + '">' + value.site + '</option>');
            });
          }
        });
      });

      $('#saveJobForm').validate({
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

      $('#depot_id').on('change', function() {
        var depot_id = this.value;
        $(".hide_for_depo").removeClass('d-none');
        $("#operative_name").html('');
        $("#client-dropdown").html('');
        var ur = "{{ route('job.depot-resourse') }}" + "/" + depot_id;
        $.ajax({
          url: ur,
          type: "GET",
          dataType: 'json',
          success: function(result) {

            $('#client-dropdown').html('<option value=""> Select Client </option>');
            $.each(result.clients, function(key, value) {
              $("#client-dropdown").append('<option value="' + value
                .id + '">' + value.client_name + '</option>');
            });

            $('#operative_name').html('<option value=""> Select Operative </option>');
            $.each(result.opeatives, function(key, value) {
              $("#operative_name").append('<option value="' + value
                .user_id + '">' + value.first_name + '</option>');
            });
          }

        });
      });

      var value = $('select#depot_id option:selected').val();
      $('#depot_id').val(value).trigger('change');

      var client_id = $('#client_id').val();
      setTimeout(function() {
        $('#client-dropdown').val(client_id);
      }, 1000);

      var operative_id = $('#opera_id').val();
      setTimeout(function() {
        $('#operative_name').val(operative_id);
      }, 1200);

    });
  </script>
  @endpush