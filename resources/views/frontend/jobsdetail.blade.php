@extends('layouts.master')
@section('content')

<div class="container-fluid inner-from">
    <div class="row">
        <div class="col-lg-12 ">
            <div class="inner_wrapper">
                <div class="creat_new_job  justify-content-end d-flex align-items-center">
                    <div class="Create_button ">
                        <a href="#">Save Job</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-lg-12 ">
            <h3>Job Details</h3>
            <p>Reference: MDGH6398503</p>
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
                        <p>Mcdonalds</p>
                        <p>Mr Mcdonald</p>
                        <p>0207 587 6287</p>
                        <p>old.mcdonald@mcdonalds.com</p>
                        <p>643275 Farm Goatsville Turkey FA4 MER</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="site_table">
                <div class=" d-flex justify-content-between align-items-start mb-3">
                    <div class="site_desc">
                        <p>Operative: <span>Ronald</span></p>
                    </div>
                    <div class="site_icons d-flex">
                        <img src="{{asset('assets/images/Edit_light.svg')}}" alt="img">
                    </div>
                </div>
                <div class=" d-flex justify-content-between align-items-start mb-2">
                    <div class="site_desc">
                        <p>Operative: <span>Piglet</span></p>
                    </div>
                    <div class="site_icons d-flex">
                        <img src="{{asset('assets/images/Lineicon.svg')}}" alt="img">
                    </div>
                </div>
                <div class=" d-flex justify-content-between align-items-start mb-2">
                    <div class="site_desc">
                        <p>Operative: <span>Tigger</span></p>
                    </div>
                    <div class="site_icons d-flex">
                        <img src="{{asset('assets/images/Lineicon.svg')}}" alt="img">
                    </div>
                </div>
                <div class=" d-flex justify-content-between align-items-start mb-2">
                    <div class="site_desc">
                        <p>Operative: <span>Pooh</span></p>
                    </div>
                    <div class="site_icons d-flex">
                        <img src="{{asset('assets/images/Lineicon.svg')}}" alt="img">
                    </div>
                </div>
                <div class="mt-5 d-flex justify-content-center">
                    <a href="#" class="table_btn">Add New Operative</a>
                </div>
            </div>

        </div>
    </div>
    <div class="row ">
        <div class="col-lg-12 mb-3 mt-5 form_wrapper">
            <h3>Forms</h3>
        </div>
        <div class="col-lg-4 ">
            <div class="site_Head">
                <p>Site Visit</p>
                <div>

                    <a href="#" class="table_btn">Add Form</a>
                </div>
            </div>
            <div class="site_table d-flex justify-content-between align-items-start">
                <div class="site_desc">
                    <p>Health And Safety Drilling</p>
                </div>
                <div class="site_icons d-flex">
                    <img src="{{asset('assets/images/Deleteicon.svg')}}" alt="img" class="">
                    <img src="{{asset('assets/images/SearchIcon.svg')}}" alt="img">
                </div>
            </div>
        </div>
        <div class="col-lg-4 ">
            <div class="site_Head">
                <p>Quote</p>
                <div>
                    <a href="#" class="table_btn">Add Form</a>
                </div>
            </div>
            <div class="site_table site_tables  d-flex justify-content-between align-items-start">
                <div class="site_desc">
                    <p>Quote Drilling Custom 124</p>
                </div>
                <div class="site_icons d-flex">
                    <img src="{{asset('assets/images/Deleteicon.svg')}}" alt="img" class="">
                    <img src="{{asset('assets/images/SearchIcon.svg')}}" alt="img">
                </div>
            </div>
        </div>
        <div class="col-lg-4 ">
            <div class="site_Head">
                <p>Audit</p>
                <div>
                    <a href="#" class="table_btn">Add Form</a>
                </div>
            </div>
            <div class="site_table  d-flex justify-content-between align-items-start">
                <div class="site_desc">
                    <p>General Inspection Drilling</p>
                </div>
                <div class="site_icons d-flex">
                    <img src="{{asset('assets/images/Deleteicon.svg')}}" alt="img" class="">
                    <img src="{{asset('assets/images/Edit_light.svg')}}" alt="img">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection