@extends('layouts.master')
@section('content')

<div class="container-fluid inner-from mb-5">
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
            <h3>Create Job</h3>
            <p>Reference: MDGH6398503</p>
        </div>
    </div>
    <form action="" class="row ">
        <div class="col-lg-7 col-md-7">
            <div class="form_groups ">
                <label for="">Client Name</label>
                <input type="text" id="fname" name="fname" placeholder="Client Name">
            </div>
        </div>
        <div class="col-lg-5 col-md-5">
            <div class="form_button">
                <a href="#" class="d-flex">
                    <div><img src="{{asset('assets/images/AddIcon.svg')}}" alt="img" class="mr-2"></div>
                    Add Client
                </a>
            </div>
        </div>
        <div class="col-lg-7 col-md-7">
            <div class="form_groups">
                <label for="">Client Contact</label>
                <input type="num" id="fnum" name="fnum" placeholder="Client Contact">
            </div>
        </div>
        <div class="col-lg-7 col-md-7">
            <div class="form_groups ">
                <label for="">Operative</label>
                <input type="text" id="fname" name="fname" placeholder="Operative">
            </div>
        </div>
        <div class="col-lg-5 col-md-5">
            <div class="form_button">
                <a href="#" class="d-flex">
                    <div><img src="{{asset('assets/images/AddIcon.svg')}}" alt="img" class="mr-2"></div>
                    Add RAMS
                </a>
            </div>
        </div>


        <div class="col-lg-7">
            <div class="form_groups ">
                <label for="">Site Visit Date</label>
                <input type="text" id="fdate" name="fdate" placeholder="Site Visit Date">
            </div>
        </div>
    </form>
    <div class="row ">
        <div class="col-lg-12 mb-3">
            <h3>Forms</h3>
        </div>
        <div class="col-lg-4 ">
            <div class="site_Head">
                <p>Site Visit</p>
                <a href="#" class="table_btn">Add Form</a>
            </div>
            <div class="site_table d-flex justify-content-between align-items-start">
                <div class="site_desc">
                    <p>Health And Safety Drilling</p>
                </div>
                <div class="site_icons d-flex">
                    <img src="{{asset('assets/images/Deleteicon.svg')}}" alt="img" class="mr-3">
                    <img src="{{asset('assets/images/Edit_light.svg')}}" alt="img">
                </div>
            </div>
        </div>
        <div class="col-lg-4 ">
            <div class="site_Head">
                <p>Site Visit</p>
                <a href="#" class="table_btn">Add Form</a>
            </div>
            <div class="site_table  d-flex justify-content-between align-items-start">
                <div class="site_desc">
                    <p>Health And Safety Drilling</p>
                </div>
                <div class="site_icons d-flex">
                    <img src="{{asset('assets/images/Deleteicon.svg')}}" alt="img" class="mr-3">
                    <img src="{{asset('assets/images/Edit_light.svg')}}" alt="img">
                </div>
            </div>
        </div>
        <div class="col-lg-4 ">
            <div class="site_Head">
                <p>Site Visit</p>
                <a href="#" class="table_btn">Add Form</a>
            </div>
            <div class="site_table  d-flex justify-content-between align-items-start">
                <div class="site_desc">
                    <p>Health And Safety Drilling</p>
                </div>
                <div class="site_icons d-flex">
                    <img src="{{asset('assets/images/Deleteicon.svg')}}" alt="img" class="mr-3">
                    <img src="{{asset('assets/images/Edit_light.svg')}}" alt="img">
                </div>
            </div>
        </div>
    </div>
</div>


@endsection