@extends('layouts.master')
@section('content')
<div class="container-fluid inner-from">
    <div class=" row">
        <div class="col-lg-12">
            <div class="inner_wrapper">
                <div class="creat_new_job  justify-content-end d-flex align-items-center">

                    <div class="Create_button ">
                        <a href="{{route('admin.create')}}">Add New Depot</a>
                    </div>
                </div>
                <div class="inner_table mt-2">
                    <h3>Depots</h3>
                    @if ($message = Session::get('sessionMessage'))
                    <div class=" alert
                     <?php
                        if ($message == 'Admin Created Successfully') {
                            echo ('successAlertMsg');
                        } elseif ($message == 'Admin Updated Successfully') {
                            echo ('updateAlertMsg');
                        } elseif ($message == 'Admin Deleted Successfully') {
                            echo ('dangerAlertMsg');
                        } ?>">
                        <p class=" 
                        <?php
                        if ($message == 'Admin Created Successfully') {
                            echo ('successAlertText');
                        } elseif ($message == 'Admin Updated Successfully') {
                            echo ('updateAlertText');
                        } elseif ($message == 'Admin Deleted Successfully') {
                            echo ('dangerAlertText');
                        }
                        ?>
                        ">
                            {{ $message }}
                        </p>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class=" table text-white data-table">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Depot Name</th>
                                    <th scope="col">Email</th>
                                    <th width="">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($admins) ?? '')
                                @foreach ($admins as $key => $admin)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        <a class="table_btn" href="{{route('admin.edit',$admin->id)}}"><img src="{{asset('assets/images/Edit_fill.png')}}" alt="img"></a>
                                        <a class="table_btn" href="{{route('admin.delete',$admin->id)}}"><img src="{{asset('assets/images/delete_icon.png')}}" alt="img"></a>
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