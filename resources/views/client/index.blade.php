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
                        <a href="{{route('client.create')}}">Add New Client</a>
                    </div>
                </div>
                <div class="inner_table mt-2">
                    <h3>Clients</h3>
                    @if ($message = Session::get('sessionMessage'))
                    <div class=" alert
                     <?php
                        if ($message == 'Client Created Successfully') {
                            echo ('successAlertMsg');
                        } elseif ($message == 'Client Updated Successfully') {
                            echo ('updateAlertMsg');
                        } elseif ($message == 'Client Deleted Successfully') {
                            echo ('dangerAlertMsg');
                        } 
                        elseif ($message == 'Please Enter the Site') {
                            echo ('dangerAlertMsg');
                        }?>">
                        {{-- <button type="button" class="close  closeIcon" data-dismiss="alert" aria-hidden="true">&times;</button> --}}
                        <p class=" 
                        <?php
                        if ($message == 'Client Created Successfully') {
                            echo ('successAlertText');
                        } elseif ($message == 'Client Updated Successfully') {
                            echo ('updateAlertText');
                        } elseif ($message == 'Client Deleted Successfully') {
                            echo ('dangerAlertText');
                        }
                        elseif ($message == 'Please Enter the Site') {
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
                                    {{-- <th scope="col">No.</th> --}}
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Client Contact</th>
                                    <th scope="col">Email</th>

                                    <th scope="col">Phone</th>
                                    <th scope="col">Address1</th>
                                    <th scope="col">Address2</th>
                                    {{-- <th scope="col">Town</th> --}}
                                    {{-- <th scope="col">City</th> --}}
                                    <th scope="col">Post Code</th>
                                    <th scope="col">
                                        @if(auth()->user()->type == 'super_admin')
                                            Depot Name 
                                        @endif
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($clients) ?? '')
                                @foreach ($clients as $key => $client)
                                <tr>
                                    {{-- <td>{{ ++$key }}</td> --}}
                                    <td>{{ $client->client_name }}</td>
                                    <td>{{ $client->client_contact }}</td>
                                    <td>{{ $client->email }}</td>

                                    <td>{{ $client->phone }}</td>
                                    <td>{{ $client->address1 }}</td>
                                    <td>{{ $client->address2 }}</td>
                                    {{-- <td>{{ $client->town }}</td> --}}
                                    {{-- <td>{{ $client->city }}</td> --}}
                                    <td>{{ $client->post_code }}</td>
                                    <td>
                                        @if(auth()->user()->type == 'super_admin')
                                            {{$client->users->name}} 
                                        @endif
                                    </td>
                                    <td>
                                        <a class="table_btn" href="{{route('client.edit',$client->id)}}"><img src="{{asset('assets/images/Edit_fill.png')}}" alt="img"></a>
                                        <a class="table_btn" href="{{route('client.delete',$client->id)}}"><img src="{{asset('assets/images/delete_icon.png')}}" alt="img"></a>
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