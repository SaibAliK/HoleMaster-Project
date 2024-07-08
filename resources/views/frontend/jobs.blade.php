@extends('layouts.master')
@section('content')


<div class="container-fluid  inner-from">
    <div class="row">
        <div class="col-lg-12">
            <div class="inner_wrapper">
                <div class="creat_new_job  justify-content-end d-flex align-items-center">
                    <div class="icons d-flex ">
                        <img src="{{asset('assets/images/SearchIcon.svg')}}" alt="img">
                        <img src="{{asset('assets/images/Unionicon.svg')}}" alt="img">
                    </div>
                    <div class="Create_button">
                        <a href="#">Create New Job</a>
                    </div>
                </div>
                <div class="inner_table mt-2">
                    <h3>Jobs</h3>
                    <div class="table-responsive ">
                        <table class=" table text-white">
                            <thead>
                                <tr>
                                    <th scope="col">Reference</th>
                                    <th scope="col">Client</th>
                                    <th scope="col">Manager</th>
                                    <th scope="col">Milestone</th>
                                    <th scope="col">Last Updated</th>
                                    <th scope="col">Options</th>
                                    <th scope="col"></th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>MFH54985763</td>
                                    <td>Mcdonalds</td>
                                    <td>Ronald</td>
                                    <td>Assigned</td>
                                    <td>01/03/2022</td>
                                    <td><a href="#" class="table_btn">Details</a></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>MFH54985763</td>
                                    <td>Mcdonalds</td>
                                    <td>Ronald</td>
                                    <td>Assigned</td>
                                    <td>01/03/2022</td>
                                    <td><a href="#" class="table_btn">Details</a></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>MFH54985763</td>
                                    <td>Mcdonalds</td>
                                    <td>Ronald</td>
                                    <td>Assigned</td>
                                    <td>01/03/2022</td>
                                    <td><a href="#" class="table_btn">Details</a></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>MFH54985763</td>
                                    <td>Mcdonalds</td>
                                    <td>Ronald</td>
                                    <td>Assigned</td>
                                    <td>01/03/2022</td>
                                    <td><a href="#" class="table_btn">Details</a></td>
                                    <td><a href="#" class="table_btn">Reassign</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection