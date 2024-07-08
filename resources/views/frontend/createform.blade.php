@extends('layouts.master')
@section('content')
<div class="container-fluid inner-from">
    <div class="row">
        <div class="col-lg-12 ">
            <div class="inner_wrapper">
                <div class="creat_new_job justify-content-end d-flex align-items-center">

                    <div class="Create_button  create_responsive ">
                        <a href="#" class="create_form_button">Use Template</a>
                        <a href="#">Save Client</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-12 ">
            <h3>Create Form</h3>


        </div>
    </div>

    <form action="" class="row create_form_feild_inner mb-5">
        <div class="col">
            <div class="form_groups ">
                <label for="">Form Name</label>
                <input type="text" id="fname" name="fname" placeholder="Form Name">
            </div>
        </div>
        <div class="col">
            <div class="form_groups ">
                <label for="">Category</label>
                <input type="text" id="fname" name="fname" placeholder="Category">
            </div>
        </div>
        <div class="col">
            <div class="form_groups ">
                <label for="">Seen by</label>
                <input type="text" id="fname" name="fname" placeholder="Seen by">
            </div>
        </div>
    </form>
    <div class="row mb-4">
        <div class="col-lg-12 ">
            <h3>Form Builder</h3>
        </div>
    </div>
    <form action="" method="post" class="row bulider_feild  pb-3 border-bottom">
        <div class="col-lg-9">
            <div class="row">
                <div class="col">
                    <div class="form_groups d-flex align-items-center ">
                        <label for="">Section:</label>
                        <input type="text" id="fname" name="fname" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 p-0">
            <div class="bulider_button d-flex">
                <a href="#">Client Viewable</a>
            </div>
        </div>
        <div class="col-lg-12 add-more p-0 dynamic-field">
            <div class="col-lg-9 question">
                <div class="row">
                    <div class="col">
                        <div class="form_groups d-flex align-items-center ">
                            <label for="">Question:</label>
                            <input type="text" id="fname" name="fname" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="check-box1">
                <div class="col-lg-9 ">
                    <div class="row">
                        <div class="col">
                            <div class="form_groups d-flex align-items-center  ">
                                <label for="">Type<span>*</span>:</label>
                                <select name="selectbox" class="select">
                                    <option value="Text Box">Text Box</option>
                                    <option value="checkBox">check box</option>
                                    <option value="mercedes">Mercedes</option>
                                    <option value="audi">Audi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="clearfix">
            <button type="button" id="add-button" class="btn btn-secondary float-left text-uppercase shadow-sm"> <img src="{{asset('assets/images/plus.png')}}" alt="img">
            </button>
            <button type="button" id="remove-button" class="btn btn-secondary float-left text-uppercase ml-1 shadow-sm "><img src="{{asset('assets/images/minus.png')}}" alt="img">
            </button>
        </div>
    </form>
    <form action="" class="row bulider_feild pt-4">
        <div class="col-lg-9">
            <div class="row">
                <div class="col">
                    <div class="form_groups d-flex align-items-center ">
                        <label for="">Section:</label>
                        <input type="text" id="fname" name="fname" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 p-0">
            <div class="bulider_button Client_Viewable d-flex">
                <a href="#">Client Viewable</a>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col">
                    <div class="form_groups d-flex align-items-center ">
                        <label for="">Question:</label>
                        <input type="text" id="fname" name="fname" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col">
                    <div class="form_groups d-flex align-items-center ">
                        <label for="">Type<span>*</span>:</label>
                        <select name="cars" id="cars">
                            <option value="volvo">Text Box</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col">
                    <div class="form_groups d-flex align-items-center ">
                        <label for="">Question:</label>
                        <input type="text" id="fname" name="fname" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col">
                    <div class="form_groups d-flex align-items-center ">
                        <label for="">Type<span>*</span>:</label>
                        <select name="cars" id="cars">
                            <option value="volvo">Check Box</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer_button d-flex">
                    <a href="#">Add Question</a>
                    <a href="#">Add Section</a>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection