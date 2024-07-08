@extends('layouts.master')
@section('content')


<div class="container-fluid inner-from">



    <div class="row mb-4">
        <div class="col-lg-12 ">
            <h3>Form Builder</h3>
        </div>
    </div>
    <form method="POST" action="{{route('section.save')}}" class="row bulider_feild pb-3 border-bottom">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        @csrf
        <div class="col-lg-9">
            <div class="row">
                <div class="col">
                    <div class="form_groups d-flex align-items-center ">
                        <label for="">Section:</label>
                        @if(isset($section))
                        <input type="text" id="section_name" name="section_name" value="{{$section->section_name ?? '' }}" disabled>
                        <input type="hidden" id="section_id" name="section_id" value="{{$section->id ?? '' }}">

                        @else
                        <input type="text" id="section_name" name="section_name" placeholder="">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 p-0">
            <div class="bulider_button d-flex">
                <a href="#">Client Viewable</a>
            </div>
        </div>
        <div class="col-lg-12 p-0 dynamic-field" id="dynamic-field-1">
            <div class="col-lg-9 ">
                <div class="row">
                    <div class="col">
                        <div class="form_groups d-flex align-items-center ">
                            <label for="">Question:</label>
                            <input type="text" id="fname" name="question" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col">
                        <div class="form_groups d-flex align-items-center ">
                            <label for="">Type<span>*</span>:</label>
                            <select name="question_type" class="select" id="questionOption">
                                <option value="">Select option</option>
                                <option value="text_box">Text Box</option>
                                <option value="checkBox">check box</option>
                                <option value="sign_box">Sign Box</option>
                            </select>
                        </div>

                        <div class="checkboxDiv d-none" id="checkboxDiv">

                            <div class="questionCheckbox">
                                <input type="checkbox" class="checkboxValue"><br>
                                <input type="text" class="checkboxValue" name="question_option[]" placeholder="Enter checkbox one">
                            </div>
                            <div class="questionCheckbox">
                                <input type="checkbox" class="checkboxValue"><br>
                                <input type="text" class="checkboxValue" name="question_option[]" placeholder="Enter checkbox one">
                            </div>
                            <div class="questionCheckbox">
                                <input type="checkbox" class="checkboxValue"><br>
                                <input type="text" class="checkboxValue" name="question_option[]" placeholder="Enter checkbox one">
                            </div>
                            <div class="questionCheckbox">
                                <input type="checkbox" class="checkboxValue"><br>
                                <input type="text" class="checkboxValue" name="question_option[]" placeholder="Enter checkbox one">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="footer_button d-flex">
                <button type="submit" name="add_question" value="add_question">Add Question</button>
                <button type="submit" name="add_section" value="add_section">Add Section </button>
                <!-- <a href="#">Add Question</a> -->
                <!-- <a href="#">Add </a> -->
            </div>
        </div>
    </form>
</div>

@endsection

@push('scripts-end')
<script>
    $(document).ready(function() {
        $('#form').addClass("active");

        $('#questionOption').on('change', function() {
            // alert(this.value);
            if (this.value == 'checkBox') {
                $('#checkboxDiv').removeClass("d-none");
            }
            if (this.value == 'text_box') {
                $('#checkboxDiv').addClass("d-none");
            }
            if (this.value == 'sign_box') {
                $('#checkboxDiv').addClass("d-none");
            }
        });

        // let selectChecbox = $('#questionOption').val();
        // console.log(selectChecbox);
        // debugger;



    });
</script>
@endpush