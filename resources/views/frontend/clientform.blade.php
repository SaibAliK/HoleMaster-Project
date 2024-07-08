@extends('layouts.master')
@section('content')


<div class="container-fluid inner-from">
    <div class="row">
        <div class="col-lg-12 ">
            <div class="inner_wrapper">
                <div class="creat_new_job  justify-content-end d-flex align-items-center">
                    <div class="Create_button ">
                        <a href="#">Save Client</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-lg-12 ">
            <h3>Add/Edit Client</h3>
        </div>
    </div>
    <form action="" class="row ">
        <div class="col-lg-6 col-md-6">
            <div class="form_groups mr-3">
                <label for="">Client Name</label>
                <input type="text" id="fname" name="fname" placeholder="Client Name">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form_groups">
                <label for="">Client Contact</label>
                <input type="num" id="fnum" name="fnum" placeholder="Client Contact">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form_groups mr-3">
                <label for="">Email</label>
                <input type="email" id="femail" name="femail" placeholder="Email">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form_groups">
                <label for="">Phone No.</label>
                <input type="num" id="fnum" name="fnum" placeholder="Phone No.">
            </div>
        </div>
        <div class="col-lg-12 col-md-12">
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
        <div class="col-lg-6 col-md-6">
            <div class="form_groups mr-3">
                <label for="">Town</label>
                <input type="text" id="fname" name="fname" placeholder="Town">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form_groups">
                <label for="">City</label>
                <input type="text" id="fname" name="fname" placeholder="City">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 ">
            <div class="form_groups  mr-3">
                <label for="">Post Code</label>
                <input type="num" id="fnum" name="fnum" placeholder="Post Code">
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-lg-12 ">
            <div class="site_Head">
                <p>Sites</p>
                <a href="#" class="table_btn">Add Site</a>
            </div>
        </div>
        <div class="col-lg-12 ">
            <div class="inner_table client_table site_table">
                <div class="table-responsive ">
                    <table class=" table text-white">
                        <thead>
                            <tr>
                                <th scope="col">Address 1</th>
                                <th scope="col">Post Code</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>35 Nowhere Avenue</td>
                                <td>N0WH 3RE</td>
                                <td>Mr Edward Nigma</td>
                                <td>Edward.Nigma@NowhereVille.com</td>
                                <td>02807541235</td>
                                <td class="d-flex">
                                    <img src="{{asset('assets/images/Deleteicon.svg')}}" alt="img">
                                    <img src="{{asset('assets/images/Edit_light.svg')}}" alt="img">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</div>



@endsection