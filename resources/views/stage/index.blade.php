@extends('layouts.master')
@section('content')

<div class="container-fluid inner-from">
    <div class=" row">
        <div class="col-lg-12">
            <div class="inner_wrapper">
                <div class="creat_new_job  justify-content-end d-flex align-items-center">
                    <div class="Create_button">
                        <a href="{{ route('stage.create') }}">Add New Stage</a>
                    </div>
                </div>
                <div class="inner_table mt-2">
                    <h3>Stage</h3>
                    @if ($message = Session::get('sessionMessage'))
                    <div class=" alert
                     <?php
                        if ($message == 'Stage Created Successfully') {
                            echo 'successAlertMsg';
                        } elseif ($message == 'Stage Updated Successfully') {
                            echo 'updateAlertMsg';
                        } elseif ($message == 'Stage Deleted Successfully') {
                            echo 'dangerAlertMsg';
                        } ?>">
                        <p class=" 
                        <?php
                        if ($message == 'Stage Created Successfully') {
                            echo 'successAlertText';
                        } elseif ($message == 'Stage Updated Successfully') {
                            echo 'updateAlertText';
                        } elseif ($message == 'Stage Deleted Successfully') {
                            echo 'dangerAlertText';
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
                                    <th>No.</th>
                                    <th>Stage Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                                    <tbody>
                                        @if (isset($stages) ?? '')
                                            @foreach ($stages as $key => $stage)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $stage->name }}</td>
                                        <td>
                                            <a class="table_btn" href="{{ route('stage.edit', $stage->id) }}"><img src="{{asset('assets/images/Edit_fill.png')}}" alt="img"></a>
                                            <a class="table_btn" href="{{ route('stage.delete', $stage->id) }}"><img src="{{asset('assets/images/delete_icon.png')}}" alt="img"></a>
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