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
                        <a href="{{route('form.create')}}">Add  New Form</a>
                    </div>
                </div>
                <div class="inner_table mt-2">
                    <h3>Forms</h3>
                    @if ($message = Session::get('sessionMessage'))
                    <div class=" alert
                     <?php
                        if ($message == 'Form Created Successfully') {
                            echo ('successAlertMsg');
                        } elseif ($message == 'Form Updated Successfully') {
                            echo ('updateAlertMsg');
                        } elseif ($message == 'Form Deleted Successfully') {
                            echo ('dangerAlertMsg');
                        } ?>">
                        <p class=" 
                        <?php
                        if ($message == 'Form Created Successfully') {
                            echo ('successAlertText');
                        } elseif ($message == 'Form Updated Successfully') {
                            echo ('updateAlertText');
                        } elseif ($message == 'Form Deleted Successfully') {
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
                                    {{-- <th scope="col">No</th> --}}
                                    <th scope="col">Form Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Stage</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($forms) ?? '')
                                @foreach ($forms as $key => $form)
                                <tr>
                                    {{-- <td>{{ ++$key }}</td> --}}
                                    <td>{{ $form->form_name }}</td>
                                    <td>{{ $form->category }}</td>
                                    <td>{{$form->stage->name}}</td>
                                    {{-- <td>{{ $form->seen_by }}</td> --}}
                                    <td>
                                        <div class="d-flex align-items-center">
                                        <a class="table_btn" href="{{route('form.edit',$form->id)}}"> <img src="{{asset('assets/images/Edit_fill.png')}}" alt="img"></a>
                                        <a class="table_btn" href="{{route('form.delete',$form->id)}}"> <img src="{{asset('assets/images/delete_icon.png')}}" alt="img"></a>
                                        <a class="table_btn" href="{{route('form.dublicate',$form->id)}}"><span>Use As Template</span></i></a>
                                    </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>
                    @if(!($stages->isEmpty()))
                    <div class="row  main_from_sitetable">
                        <div class="col-lg-12 form_wrapper">
                            <h3>Stages</h3>
                        </div>
                        @foreach($stages as $stage)
                        <div class="col-lg-4 ">
                            <div class="site_Head">
                                <p>{{$stage->name ??  '' }}</p>
                            </div>
                            <div class="site_table d-flex justify-content-between align-items-start new_class" >
                                <div class="site_desc">
                                    @foreach($stage->forms as $item)
                                        <a class="" href="{{route('form.edit',$item->id)}}" >{{$item->form_name ??  '' }}<br></a><br>
                                    @endforeach
                                    <!-- <p>No # :w</p>  
                                    <p>Category : {{$form->category ??  '' }}</p>
                                    <p>Seen By : {{$form->seen_by ??  '' }}</p>
                                    <p>Stage : {{$form->stage->name}}</p> -->
                                    <!-- <div>Question </div>
                                    @foreach($form->sections as $sections)
                                    <p>Section Name: {{$sections->name}}</p>
                                    @foreach($sections->questions as $question)
                                    <p>{{$question->question ??  '' }} <span class="">{{$question->is_required == 'true' ? '*' : 'Not Required'}}</span></p>
                                    @endforeach
                                    <hr>
                                    @endforeach -->
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

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