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
                    <div class="Create_button ">
                        <a href="{{route('operative.create')}}">Add New Operative</a>

                    </div>
                </div>
                <div class="inner_table mt-2">
                    <h3>Operative</h3>
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
                        {{-- <button type="button" class="close closeIcon " data-dismiss="alert" aria-hidden="true">&times;</button> --}}
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
                        <table class=" table text-white data-table">
                            <thead>
                                <tr>
                                    {{-- <th>No.</th> --}}
                                    <th>First Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Surname</th>
                                    {{-- <th>Address1</th>
                                    <th>Address2</th> --}}
                                    {{-- <th>Town</th> --}}
                                    {{-- <th>City</th> --}}
                                    {{-- <th>Post Code</th> --}}
                                    <th>
                                        @if(auth()->user()->type == 'super_admin')
                                        Depot Name
                                        @endif
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($operatives) ?? '')
                                @foreach ($operatives as $key => $operative)
                                <tr>
                                    {{-- <td>{{ ++$key }}</td> --}}
                                    <td>{{ $operative->first_name }}</td>
                                    <td>{{ $operative->phone }}</td>
                                    <td>{{$operative->operativeUsers->email}}</td>
                                    <td>{{ $operative->surname }}</td>
                                    {{-- <td>{{ $operative->address1 }}</td>
                                    <td>{{ $operative->address2 }}</td> --}}
                                    {{-- <td>{{ $operative->town }}</td>
                                    <td>{{ $operative->city }}</td>
                                    <td>{{ $operative->post_code }}</td> --}}
                                    <td>
                                        @if(auth()->user()->type == 'super_admin')
                                        {{$operative->users->name}}
                                        @endif
                                    </td>
                                    <td>
                                        <a class="table_btn" href="{{route('operative.edit',$operative->id)}}"> <img src="{{asset('assets/images/Edit_fill.png')}}" alt="img"></a>
                                        <a class="table_btn" href="{{route('operative.delete',$operative->id)}}"> <img src="{{asset('assets/images/delete_icon.png')}}" alt="img"></a>
                                        <a class="table_btn" href="{{route('operative.sendemail',$operative->id)}}"><span>Reset Password</span></i></a>
                                    
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
    setTimeout(function() {
        $('.alert').alert('close');
    }, 3000);
</script>