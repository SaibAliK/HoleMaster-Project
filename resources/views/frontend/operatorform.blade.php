@extends('layouts.master')
@section('content')
<div>
    <div class="container-fluid inner-from">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="inner_wrapper">
                    <div class="creat_new_job  justify-content-end d-flex align-items-center">
                        <div class="Create_button ">
                            <a href="#">Save Manager</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-lg-12 ">
            <h3>Add/Edit Operative</h3>
        </div>
    </div>
    <form action="" class="row ">
        <div class="col-lg-6 col-md-6">
            <div class="form_groups mr-3">
                <label for="">First Name</label>
                <input type="text" id="fname" name="fname" placeholder="First Name">
            </div>
        </div>
        <div class="col-lg-6  col-md-6">
            <div class="form_groups">
                <label for="">Surname</label>
                <input type="text" id="fname" name="fname" placeholder="Surname">
            </div>
        </div>
        <div class="col-lg-6  col-md-6">
            <div class="form_groups mr-3">
                <label for="">Email</label>
                <input type="email" id="femail" name="femail" placeholder="Email">
            </div>
        </div>
        <div class="col-lg-6  col-md-6">
            <div class="form_groups">
                <label for="">Phone No.</label>
                <input type="num" id="fnum" name="fnum" placeholder="Phone No.">
            </div>
        </div>
        <div class="col-lg-12  col-md-12">
            <div class="form_groups">
                <label for="">Office Address 1</label>
                <input type="text" id="fname" name="fname" placeholder="Office Address 1">
            </div>
        </div>
        <div class="col-lg-12  col-md-12">
            <div class="form_groups">
                <label for="">Office Address 2</label>
                <input type="text" id="fname" name="fname" placeholder="Office Address 2">
            </div>
        </div>
        <div class="col-lg-6  col-md-6">
            <div class="form_groups mr-3">
                <label for="">Town</label>
                <input type="text" id="fname" name="fname" placeholder="Town">
            </div>
        </div>
        <div class="col-lg-6  col-md-6">
            <div class="form_groups">
                <label for="">City</label>
                <input type="text" id="fname" name="fname" placeholder="City">
            </div>
        </div>
        <div class="col-lg-6  col-md-6 ">
            <div class="form_groups  mr-3">
                <label for="">Post Code</label>
                <input type="num" id="fnum" name="fnum" placeholder="Post Code">
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-lg-12  col-md-6">
            <div class="site_Head">
                <p>Jobs</p>
            </div>
            </form>
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="site_Head">
                        <p>Jobs</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="inner_table site_table mt-2">
                        <div class="table-responsive ">
                            <table class=" table text-white">
                                <thead>
                                    <tr>
                                        <th scope="col">Reference</th>
                                        <th scope="col">Client</th>
                                        <th scope="col">Site</th>
                                        <th scope="col">Progress</th>
                                        <th scope="col">Start Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>MAN56778</td>
                                        <td>Macdonalds</td>
                                        <td>125 Kansas City Road</td>
                                        <td>Quote 50% Complete</td>
                                        <td>02/05/2022</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection