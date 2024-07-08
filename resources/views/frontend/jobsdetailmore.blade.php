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
                    <div class="site_desc more_detail_desc">
                        <p>Operative: <span>Ronald</span></p>
                    </div>
                    <div class="site_icons d-flex">
                        <img src="{{asset('assets/images/Edit_light.svg')}}" alt="img">
                    </div>
                </div>
                <div class=" d-flex justify-content-between align-items-start mb-2">
                    <div class="site_desc more_detail_desc">
                        <p>Operative: <span>Piglet</span></p>
                    </div>
                    <div class="site_icons d-flex">
                        <img src="{{asset('assets/images/Lineicon.svg')}}" alt="img">
                    </div>
                </div>
                <div class=" d-flex justify-content-between align-items-start mb-2">
                    <div class="site_desc more_detail_desc">
                        <p>Operative: <span>Tigger</span></p>
                    </div>
                    <div class="site_icons d-flex">
                        <img src="{{asset('assets/images/Lineicon.svg')}}" alt="img">
                    </div>
                </div>
                <div class=" d-flex justify-content-between align-items-start mb-2">
                    <div class="site_desc more_detail_desc">
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
    <div class="row border-bottom mt-5">
        <div class="col-lg-7">
            <div class="inner_from">
                <div class="heading_from">
                    <h2>Form: Health and safety drilling</h2>
                    <p>Section:<span>Initial Inspection</span></p>
                </div>
                <div class="areafeild">
                    <p>Any Barrier to entry to the site<span>*</span></p>
                    <textarea placeholder="One Locked gate with pin code required for entry to the site.Ask at reception for daily pin code on entry." name="comment[text]" id="comment_text" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true"></textarea>
                </div>
                <div class="areafeild areafeilds">
                    <p>Required PPE for site visit<span>*</span></p>
                    <textarea placeholder="High vis vest, Hard hat, Steel capped shoes" name="comment[text]" id="comment_text" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 ">
            <div class="img-field">
                <div class="gallery_feild">
                    <label for="upload-photo"><img src="{{asset('assets/images/imgupload.svg')}}" alt="img"></label>
                    <input type="file" name="photo" id="upload-photo" />
                </div>
                <div class="feild_desc">
                    <p> Photo of Location <span>*</span></p>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="img-field">
                <div class="gallery_feild">
                    <label for="upload-photo"><img src="{{asset('assets/images/imgupload.svg')}}" alt="img"></label>
                    <input type="file" name="photo" id="upload-photo" />
                </div>
                <div class="feild_desc">
                    <p> Signature<span>*</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection