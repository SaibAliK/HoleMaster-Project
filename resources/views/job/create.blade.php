@extends('layouts.master')

@push('style-end')
<style>
    label {
  display: flex;
  align-items: center;
}

input[type="checkbox"] {
  margin-right: 10px;
}

span {
  font-size: 16px;
}
</style>
@endpush

@section('content')

<div class="container-fluid inner-from">
    <form method="POST" id="saveJobForm" action="{{ route('job.store') }}" class="row mt-5">
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


        <div class="justify-content-end d-flex align-items-center col-lg-12">
            <div class="Create_button ">
                <button class="clientBtn">Save Job</button>
            </div>
        </div>
        <div class="col-lg-12 mb-4">
            <h3>Add Job</h3>
        </div>

        @if(auth()->user()->type == 'super_admin')
        <div class="col-lg-6 creat_job">
            <div class="form_groups mr-3">
                <label for="depot_id">Depot</label><br>
                <select name="depot_id" id="depot_id" class="js-example-basic-single" required>
                    <option value="" selected="selected">Select Depot</option>
                    @foreach ($admins as $admin)
                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                    @endforeach
                </select>
                <div id="admin_id_error"></div>
            </div>
        </div>
        @endif

        <div class="col-lg-6 creat_job hide_for_depo {{ auth()->user()->type == 'super_admin' ? 'd-none' : ''}}">
            <div class="form_groups mr-3">
                <label for="client_name">Client</label><br>
                <select name="client_name" id="client-dropdown" class="js-example-basic-single" required>
                    <option value="" selected="selected">Select Client</option>
                    @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                    @endforeach
                </select>
                <div id="client_id_error"></div>
            </div>
        </div>

        <div class="col-lg-6 creat_job hide_for_depo {{ auth()->user()->type == 'super_admin' ? 'd-none' : ''}}">
            <div class="form_groups">
                <label for="operative_name">Operative</label><br>
                <select name="operative_name" id="operative_name" required class="js-example-basic-single" >
                    <option value="" selected="selected">Select Operative</option>
                    @foreach ($operatives as $operative)
                    <option value="{{ $operative->id }}">{{ $operative->first_name }}</option>
                    @endforeach
                </select>
                <div id="operative_id_error"></div>
            </div>
        </div>

        <div class="col-lg-6 creat_job d-none" id="sites_drop">
            <div class="form_groups mr-3">
                <label for="sites">Sites</label><br>
                <select name="sites" id="site-dropdown"  class="js-example-basic-single" required>
                </select>
                <div id="site_id_error"></div>
            </div>
        </div>

        <div class="col-lg-6 creat_job">
            <div class="form_groups  mr-3">
                <label for="visit_date">Initial Site Visit Date</label>
                <input type="date" id="visit_date" name="visit_date" placeholder="Site Visit Date" required min="{{ date('Y-m-d') }}">
            </div>
        </div>

        @if (!$stages->isEmpty())
        <div class="row  main_from_sitetable">
            <div class="col-lg-12 mb-3 form_wrapper">
                <h3> Stages</h3>
            </div>
            @foreach($stages as $stage)
                <div class="col-lg-4 ">
                    <div class="site_Head">
                        <p>{{$stage->name ??  '' }}</p>
                    </div>
                    <div class="site_table d-flex justify-content-between align-items-start new_class" >
                        <div class="site_desc">
                            @foreach($stage->forms as $item)
                            <label>
                                <input name="form_id[]" type="checkbox" id="formId" value="{{ $item->id }}" class="table_btn form_id formId" required>
                                    <span>{{$item->form_name ??  '' }} </span> <br>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </form>
</div>
@endsection

@push('scripts-end')
<script>
    $(document).ready(function() {

        let formIds = [];

        $('.formId').click(function() {
            let formId = $(this).val();
            $(this).closest('.main_div').children('.site_table').children('.site_desc').$(
                'input[name=form_id]').val(formId);
        });


        $('#saveJobForm').validate({
            rules: {
                stage: {
                    required: true,
                    date: true,
                }
            },
            errorPlacement: function(error, element) {
                console.log(element.attr("name"));
                if (element.attr("name") == "stage") {
                    $("#stageError").html(
                        `<label id="stage-error" class="error" for="stage">This field is required.</label>`
                    );
                }
                else if (element.attr("name") == "depot_id") {
                    $("#admin_id_error").html(`<label id="admin_id-error" class="error" for="admin_id">This field is required.</label>`);
                }
                else if (element.attr("name") == "client_name") {
                    $("#client_id_error").html(`<label id="client_id-error" class="error" for="client_name">This field is required.</label>`);
                }
                else if (element.attr("name") == "operative_name") {
                    $("#operative_id_error").html(`<label id="operative_id-error" class="error" for="operative_name">This field is required.</label>`);
                }
                else if (element.attr("name") == "sites") {
                    $("#site_id_error").html(`<label id="site_id-error" class="error" for="site_id">This field is required.</label>`);
                }
                else if (element.attr("name") == "form_id[]") {
                //     document.querySelectorAll('.form_id').forEach(function(element) {
                //     $(".form_id_err").html(`<label class="error">This field is required.</label>`);
                // });
                $(".form_id_err").html(`<label class="error">Please Select the Forms to Continue.</label>`);

                }
                else {
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
                            .id + '">' + value.first_name + '</option>');
                    });

                }
            });
        });

        $('#client-dropdown').on('change', function() {
            var siteID = this.value;
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

    });
</script>
@endpush