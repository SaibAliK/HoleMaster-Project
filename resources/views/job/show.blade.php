@extends('layouts.master')

@push('style-end')
<style>
    .box_green {
        border: 1px solid #4caf50 !important;
        background-color: #effff6 !important;
        border-radius: 8px;
        padding: 18px 15px;
        height: 125px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    .box_red {
        border: 1px solid #c71010 !important;
        background-color: #ffefef !important;
        border-radius: 8px;
        padding: 18px 15px;
        height: 125px;
        overflow-y: scroll;
        overflow-x: hidden;
    }
</style>
@endpush

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
            <h3>Job Details</h3>
        </div>
    </div>

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
            <!-- <button class="clientBtn">Save Job</button> -->
        </div>
    </div>


    <div class="col-lg-6">
        <div class="form_groups mr-3">
            <label for="client_name">Client</label>
            <input type="text" readonly name="client" value="{{$jobDetailForm->jobDetail->userClient->client_name ?? '' }}">
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form_groups mr-3">
            <label for="client_name">Operative Name</label>

            <input type="text" readonly name="operative" value="{{$jobDetailForm->jobDetail->userOperative->operative->first_name  ?? '' }}">
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form_groups mr-3">
            <label for="client_name">Operative Email</label>

            <input type="email" readonly name="operative" value="{{$jobDetailForm->jobDetail->userOperative->operative->operativeUsers->email  ?? '' }}">
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form_groups mr-3">
            <label for="client_name">Site Name</label>

            <input type="text" readonly name="sites" value="{{$jobDetailForm->jobDetail->jobSite->site  ?? '' }}">
        </div>
    </div>
    <div class="col-lg-6 ">
        <div class="form_groups  mr-3">
            <label for="client_name">Initial Site Visit Date</label>

            <input type="date" readonly id="visit_date" value="{{$jobDetailForm->jobDetail->visit_date  ?? ''}}" name="visit_date" placeholder="Site Visit Date">
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner_wrapper">
                    <div class="creat_new_job  justify-content-end d-flex align-items-center">
                        <div class="Create_button ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-lg-12 ">
                <h3>Job Details</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="users">
                            <p>Client:</p>
                            <p>Client Contact:</p>
                            <p>Phone Number:</p>
                            <p>E-mail:</p>
                            <p>Site Address:</p>
                        </div>
                    </div>
                    <div class="col-lg-8 ">
                        <div class="users_details">
                            <p>{{$jobDetailForm->jobdetail->userClient->client_name ?? ''}}</p>
                            <p>{{$jobDetailForm->jobdetail->userClient->client_contact}}</p>
                            <p>{{$jobDetailForm->jobdetail->userClient->phone ?? ''}}</p>
                            <p>{{$jobDetailForm->jobdetail->userClient->email ?? ''}}</p>
                            <p>{{$jobDetailForm->jobdetail->userClient->address1 ?? ''}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row  main_from_sitetable">
            <div class="col-lg-12 mb-3  form_wrapper">
                <h3>Forms</h3>
            </div>


            @foreach($jobForms as $item)
            <div class="col-lg-4 ">
                <div class="site_Head">
                    <p>{{$item->forms->form_name ??  '' }} - ({{$item->forms->stage->name}})</p>
                </div>
                <div class=" d-flex justify-content-between align-items-start {{ (count( $item->responses)>0 ) ? 'box_green' : 'box_red' }}">
                    <div class="site_desc">
                        <p>{{$item->forms->form_name ??  '' }}</p>
                        <p>{{$item->forms->category ??  '' }}</p>
                        <p>{{$item->forms->seen_by ??  '' }}</p>
                        Question :
                        @foreach($item->forms->sections as $section)
                        @foreach($section->questions as $question)
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
    </div>
    @endsection