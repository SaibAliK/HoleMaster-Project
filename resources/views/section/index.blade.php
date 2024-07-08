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
                        <a href="{{route('job.create')}}">Create New Job</a>
                    </div>
                </div>
                <div class="inner_table mt-2">
                    <h3>Clients</h3>
                    <div class="table-responsive ">
                        <table class=" table text-white" id="recordPagination">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>     
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Operative</th>
                                    <th scope="col">Visit Date</th>
                                    <th width="280px">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($jobs) ?? '')
                                @foreach ($jobs as $key => $job)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $job->client->client_name }}</td>
                                        <td>{{ $job->operative->first_name }}</td>
                                        <td>{{ $job->visit_date }}</td>
                                        <td>
                                            <a class="table_btn" href="{{route('job.edit',$job->id)}}">Edit</a>
                                            <a class="table_btn" href="{{route('job.delete',$job->id)}}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
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
