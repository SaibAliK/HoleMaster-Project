@extends('layouts.master')
@section('content')


<div class="container-fluid inner-from">
    <div class=" row">
        
        <div class="col-lg-12">
            <div class="inner_wrapper">
                <div class="creat_new_job  justify-content-end d-flex align-items-center">
                </div>
                <div class="inner_table mt-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Assigned Jobs</h3>
                        <a class="edit_button_operative" href="{{route('operative.editdetail',['id'=>auth()->user()->id])}}">Edit Profile</a>
                    </div>
                    @if ($message = Session::get('sessionMessage'))
                    <div class=" alert
                     <?php
                        if ($message == 'Operative Created Successfully') {
                            echo ('successAlertMsg');
                        } elseif ($message == 'Operative Updated Successfully') {
                            echo ('updateAlertMsg');
                        } elseif ($message == 'Operative Deleted Successfully') {
                            echo ('dangerAlertMsg');
                        } ?>">
                        <p class=" 
                        <?php
                        if ($message == 'Operative Created Successfully') {
                            echo ('successAlertText');
                        } elseif ($message == 'Operative Updated Successfully') {
                            echo ('updateAlertText');
                        } elseif ($message == 'Operative Deleted Successfully') {
                            echo ('dangerAlertText');
                        }
                        ?>
                        ">
                            {{ $message }}
                        </p>
                    </div>
                    @endif
                    <div class="table-responsive ">
                        <table class=" table text-white" id="recordPagination">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Operative</th>
                                    <th scope="col">Site Visit Date</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($jobs) ?? '')
                                @foreach ($jobs as $key => $job)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $job->userClient->client_name ?? '' }}</td>
                                    <td>{{ $job->userOperative->operative->first_name ?? '' }}</td>
                                    <td>{{ $job->visit_date }}</td>
                                    <td>
                                        <a class="table_btn" href="{{route('operative.showjobdetails',$job->id)}}"><img src="{{asset('assets/images/View_fill.png')}}" alt="img"></a>
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