@extends('layouts.master')
@section('content')
<div class="container-fluid inner-from">
    <div class=" row">
        <div class="col-lg-12">
            <form action="{{route('admin.permission.update')}}" method="POST">
                @csrf
                <div class="inner_wrapper">
                    <div class="creat_new_job  justify-content-end d-flex align-items-center">

                        <div class="Create_button ">
                            <button type="submit">Update Permissions</a>
                        </div>
                    </div>
                    <div class="inner_table mt-2">

                        <h3>Permissions</h3>
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

                        <div class="container-fluid inner-from">

                            <div class="row">
                                @foreach($permissions as $item)
                                <div class="col-lg-6">
                                    <div class="form_groups mr-3">
                                    {{-- <label>--- </label> --}}
                                        <input type="hidden" name="permissions[]" value="{{$item->id}}">
                                        <input type="text" name="names[]" value="{{$item->name}}" placeholder="Permission Name" autocomplete="off">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
<script type="text/javascript">
    setTimeout(function () {
        $('.alert').alert('close');
    }, 2000);
</script>