@extends('layouts.master')
@section('content')


<div class="container-fluid inner-from">
    <div class=" row">
        <div class="col-lg-12">
            <div class="inner_wrapper">
                <div class="creat_new_job  justify-content-end d-flex align-items-center">
                    <div class="icons">
                        <img src="{{asset('assets/images/SearchIcon.svg')}}" alt="img">
                    </div>
                    <div class="Create_button ">
                        <a href="#">Create New Client</a>
                    </div>
                </div>
                <div class="inner_table mt-2">
                    <h3>Clients</h3>
                    <div class="table-responsive ">
                        <table class=" table text-white">
                            <thead>
                                <tr>
                                    <th scope="col">Client</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Options</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Mcdonalds</td>
                                    <td>Ronald</td>
                                    <td>R.Mcdonald@mcdonalds.com</td>
                                    <td>01548156189</td>
                                    <td><a href="#" class="table_btn">Details</a></td>
                                </tr>
                                <tr>
                                    <td>Mcdonalds</td>
                                    <td>Ronald</td>
                                    <td>R.Mcdonald@mcdonalds.com</td>
                                    <td>01548156189</td>
                                    <td><a href="#" class="table_btn">Details</a></td>
                                </tr>
                                <tr>
                                    <td>Mcdonalds</td>
                                    <td>Ronald</td>
                                    <td>R.Mcdonald@mcdonalds.com</td>
                                    <td>01548156189</td>
                                    <td><a href="#" class="table_btn">Details</a></td>
                                </tr>
                                <tr>
                                    <td>Mcdonalds</td>
                                    <td>Ronald</td>
                                    <td>R.Mcdonald@mcdonalds.com</td>
                                    <td>01548156189</td>
                                    <td><a href="#" class="table_btn">Details</a></td>
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



@endsection