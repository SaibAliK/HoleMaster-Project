@extends('layouts.master')
@section('content')

<div class="container-fluid inner-from">
    <div class=" row">
        <div class="col-lg-12">
            <div class="inner_wrapper">
                <div class="creat_new_job  justify-content-end d-flex align-items-center">
                    <!-- <div class="icons">
                        <img src="{{asset('assets/images/SearchIcon.svg')}}" alt="img">
                    </div> -->
                    <div class="Create_button">
                        <a href="{{route('job.create')}}">Add New Job</a>
                    </div>
                </div>
                <div class="inner_table mt-2">
                    <h3>Jobs</h3>
                    @if ($message = Session::get('sessionMessage'))
                    <div class="alert
                     <?php
                        if ($message == 'Job Created Successfully') {
                            echo ('successAlertMsg');
                        } elseif ($message == 'Job Updated Successfully') {
                            echo ('updateAlertMsg');
                        } elseif ($message == 'Job Deleted Successfully') {
                            echo ('dangerAlertMsg');
                        } ?>">
                        {{-- <button type="button" class="close closeIcon" data-dismiss="alert" aria-hidden="true">&times;</button> --}}
                        <p class=" 
                        <?php
                        if ($message == 'Job Created Successfully') {
                            echo ('successAlertText');
                        } elseif ($message == 'Job Updated Successfully') {
                            echo ('updateAlertText');
                        } elseif ($message == 'Job Deleted Successfully') {
                            echo ('dangerAlertText');
                        }
                        ?>
                        ">
                            {{ $message }}
                        </p>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table text-white data-table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Operative</th>
                                    <th scope="col">Site</th>
                                    <th scope="col">Visit Date</th>
                                    <th scope="col">
                                        @if(auth()->user()->type == 'super_admin')
                                            Depot Name 
                                        @endif
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($jobs) ?? '')
                                @foreach ($jobs as $key => $job)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $job->userClient->client_name ?? '' }}</td>
                                    <td>{{ $job->userOperative->operative->first_name ?? '' }}</td>
                                    <td>{{ $job->jobSite->site ?? '' }}</td>
                                    <td>{{ $job->visit_date }}</td>
                                    <td>
                                        @if(auth()->user()->type == 'super_admin')
                                            {{$job->users->name}} 
                                        @endif
                                    </td>
                                    <td>
                                        <a class="table_btn" href="{{route('job.show',$job->id)}}"> <img src="{{asset('assets/images/View_fill.png')}}" alt="img"></a>
                                        <a class="table_btn" href="{{route('job.edit',$job->id)}}"> <img src="{{asset('assets/images/Edit_fill.png')}}" alt="img"></a>
                                        <a class="table_btn" href="{{route('job.delete',$job->id)}}"> <img src="{{asset('assets/images/delete_icon.png')}}" alt="img"></a>
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

<script type="text/javascript">
    setTimeout(function () {
        $('.alert').alert('close');
    }, 3000);
</script>