@extends('layouts.master')
@section('content')

<div class="container-fluid inner-from">
    <div class="row mb-4">
        <div class="col-lg-12 inner_table" style="margin-top: 40px;">
            <h3>Form Builder</h3>
        </div>
    </div>

    <form method="POST" action="{{route('section.save')}}" id="saveFormSection" class="row bulider_feild pb-3 border-bottom">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        @csrf

        <div class="col-lg-12 p-0">
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            @if(isset($form->sections))
                            @foreach ($form->sections as $key => $sections)
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form_groups">
                                            <label for="section_name">Section - {{ $key }}</label>
                                            <input type="hidden" id="" name="sections[{{$key}}][section_id]" value="{{ $sections->id ?? '' }}">
                                            <input type="text" name="sections[{{$key}}][name]" value="{{ $sections->section_name ?? '' }}">
                                            <input type="hidden" id="" name="sections[{{$key}}][name]" value="{{ $sections->section_name ?? '' }}">
                                            <input type="hidden" id="" name="sections[{{$key}}][form_id]" value="{{ $sections->form_id ?? '' }}">
                                        </div>
                                    </div>
                                    @foreach ($sections->questions as $k=> $question)
                                  
                                    <div class="col-12">
                                        <div class="forms_groups d-flex">
                                            <label>Type</label>
                                            <select id="" name="sections[{{$key}}][question][{{$k}}][type]" class="select questionOption" required>
                                                <option value="not">Select option</option>
                                                <option value="text_box" {{ $question->type == 'text_box' ? 'selected' : '' }}>
                                                    Text Box</option>
                                                <option value="checkBox" {{ $question->type == 'checkBox' ? 'selected' : '' }}>
                                                    Checkbox</option>
                                                <option value="precaution" {{ $question->type == 'precaution' ? 'selected' : '' }}>
                                                    Text</option>
                                                <option value="sign_box" {{ $question->type == 'sign_box' ? 'selected' : '' }}>
                                                    Sign
                                                    Box</option>
                                                <option value="radio" {{ $question->type == 'radio' ? 'selected' : '' }}>Radio
                                                    Button</option>
                                                <option value="image" {{ $question->type == 'image' ? 'selected' : '' }}>Image
                                                </option>
                                            </select>
                                            <!-- <input type="hidden" value="precaution" name="sections[{{$key}}][question][{{$k}}][type]" placeholder=""> -->
                                        </div>

                                        @if ($question->type == 'checkBox')
                                        <div class="forms_groups">
                                            @foreach ($question->options as $ky=> $op)
                                            <div class="questionCheckbox">
                                                <input type="checkbox" class="checkboxValue"><br>
                                                <input type="text" value="{{ $op->question_option }}" class="checkboxValue" name="sections[{{$key}}][question][{{$k}}][option][{{$ky}}][value]" placeholder="">
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif

                                        @if ($question->type == 'radio')
                                        <div class="forms_groups">
                                            @foreach ($question->options as $ky=>$op)
                                            <div class="questionCheckbox">
                                                <input type="radio" class="checkboxValue"><br>
                                                <input type="text" value="{{ $op->question_option }}" class="checkboxValue" name="sections[{{$key}}][question][{{$k}}][option][{{$ky}}][value]" placeholder="">
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>

                                    <div class="col-12 mt-2">
                                        @if($question->type != 'precaution')
                                        <div class="form_groups">
                                            <label> Question </label>
                                            <input type="text" id="fname" value="{{ $question->question }}" name="sections[{{$key}}][question][{{$k}}][name]" placeholder="">
                                            <input type="hidden" id="fname" value="NULL" name="sections[{{$key}}][question][{{$k}}][precaution]" placeholder="">
                                        </div>
                                        @endif

                                        @if($question->type == 'precaution')
                                        <div class="form_groups ">
                                            <label> Text : </label>
                                            <input type="text" id="fname" value="{{ $question->precaution }}" name="sections[{{$key}}][question][{{$k}}][precaution]" placeholder="">
                                            <input type="hidden" id="fname" value="NULL" name="sections[{{$key}}][question][{{$k}}][name]" placeholder="">
                                        </div>
                                        @endif
                                    </div>

                                    @if($question->type != 'precaution')
                                    <div class="col-12">
                                        <div class="forms_groups">
                                            <label for="">Is Required</label>
                                            <input type="checkbox" {{$question->is_required == 'true' ? 'checked' : ''}} name="sections[{{$key}}][question][{{$k}}][is_required]" value="{{$question->is_required == 'true' ? 'checked' : 'false'}}">
                                        </div>
                                    </div>
                                    @endif

                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="col-lg-12 p-0">
            <div class="col-lg-9">
                <div class="row">
                    <div class="col">
                        <div class="form_groups d-flex align-items-center">
                            <label for="section_name">Section:</label>
                            <input type="hidden" id="" name="sections[new][name]" value="{{ $sections->section_name ?? '' }}">
                            <input type="hidden" id="" name="sections[new][form_id]" value="{{ $sections->form_id ?? '' }}">
                            <input type="text" placeholder="Section Name" id="section_name" name="sections[new][name]" value="{{$section->section_name ?? '' }}">
                            <input type="hidden" id="section_id" name="sections[new][section_id]" value="{{$section->id ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col">
                    <div class="form_groups d-flex align-items-center ">
                        <label for="type">Type<span>*</span>:</label>
                        <select name="sections[new][question][new][type]" class="select" id="questionOption" required>
                            <option value="">Select option</option>
                            <option value="text_box">Text Box</option>
                            <option value="precaution">Text</option>
                            <option value="checkBox">Checkbox</option>
                            <option value="sign_box">Sign Box</option>
                            <option value="radio">Radio Button</option>
                            <option value="image">Image</option>
                        </select>
                    </div>
                    <div class="checkboxDiv d-none" id="checkboxDiv">
                        <div class="questionCheckbox">
                            <input type="checkbox"  class="checkboxValue"><br>
                            <input type="text" class="checkboxValue" name="sections[new][question][new][option][value][]"
                                placeholder="Enter new option">
                            <a id="add-checkbox" class="table_btn"><span>Add more</span></i></a>
                        </div>
                    </div>
                    <div class="precationDiv d-none" id="precationDiv">
                        <div class="questionCheckbox precationcheckbox">
                            <label for="">Text: </label>
                            <input type="text" required class="precautionValue" name="precaution"
                                placeholder="e.g. Flying Objects from bolt failure">
                        </div>
                    </div>
                    <div class="checkboxDiv d-none" id="radioDiv">
                        <div class="questionCheckbox">
                            <input type="radio" class="checkboxValue"><br>
                            <input type="text" class="checkboxValue" name="sections[new][question][new][option][value][]"
                                placeholder="Enter new option">
                            <a id="add-radio" class="table_btn"><span>Add more</span></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 p-0 dynamic-field" id="dynamic-field-1">
            <div class="col-lg-9" id="hideInputDiv">
                <div class="row">
                    <div class="col">
                        <div class="form_groups d-flex align-items-center">
                            <label for="question">Question:</label>
                            <input type="text" id="myQuestionChangeValue" required name="sections[new][question][new][name]" placeholder="">
                            <input type="hidden" val="NULL" required name="sections[new][question][new][precaution]" placeholder="">
                            <input type="hidden" id="form_id" name="form_id" value="{{$form_id  ?? ''}}">
                        </div>
                        <div class="form_groups align-items-center d-flex">
                            <label for="question">Is Required:</label>
                            <div>
                                <input type="checkbox" id="myChangeValue" name="sections[new][question][new][is_required]" value="true" {{$form_id}}>
                                <span class="custom-checkbox"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-lg-12">
                <div class="footer_button d-flex">
                    <button type="submit" name="add_question" value="add_question">Add Question</button>
                    <!-- <button type="submit" name="add_section" value="add_section">Add Section </button> -->
                    <button type="submit" name="section_save" value="section_save">Save Form </button>
                </div>
            </div>
        </form>
    </div>
@endsection


@push('scripts-end')
    <script>
        $(document).ready(function() {

            $('#saveFormSection').validate({
                errorPlacement: function(error, element) {
                    console.log(element.attr("name"));
                    if (element.attr("name") == "stage") {
                        // $("#stageError").html(`<label id="stage-error" class="error" for="stage">This field is required.</label>`);
                    } else {
                        error.insertAfter(element);
                    }
                },
            });

            $('#questionOption').on('change', function() {
                if (this.value == 'checkBox') {
                    $('#checkboxDiv').removeClass("d-none");
                    $('#radioDiv').addClass("d-none");
                    $('#precationDiv').addClass("d-none");
                    $('#hideInputDiv').removeClass("d-none");


                }
                if (this.value == 'radio') {
                    $('#radioDiv').removeClass("d-none");
                    $('#checkboxDiv').addClass("d-none");
                    $('#precationDiv').addClass("d-none");
                    $('#hideInputDiv').removeClass("d-none");


                }
                if (this.value == 'text_box') {
                    $('#checkboxDiv').addClass("d-none");
                    $('#radioDiv').addClass("d-none");
                    $('#precationDiv').addClass("d-none");
                    $('#hideInputDiv').removeClass("d-none");


                }
                if (this.value == 'sign_box') {
                    $('#checkboxDiv').addClass("d-none");
                    $('#radioDiv').addClass("d-none");
                    $('#precationDiv').addClass("d-none");
                    $('#hideInputDiv').removeClass("d-none");


                }
                if (this.value == 'image') {
                    $('#checkboxDiv').addClass("d-none");
                    $('#radioDiv').addClass("d-none");
                    $('#precationDiv').addClass("d-none");
                    $('#hideInputDiv').removeClass("d-none");


                }
                if (this.value == 'precaution') {
                    $('#precationDiv').removeClass("d-none");
                    $('#radioDiv').addClass("d-none");
                    $('#checkboxDiv').addClass("d-none");
                    $('#hideInputDiv').addClass("d-none");
                    $("#myChangeValue").val("false");
                    $("#myQuestionChangeValue").val('');


                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var counter = 1;
            $('#add-checkbox').click(function() {
                $('#checkboxDiv').append(
                    '<div class="questionCheckbox"><input type="checkbox" class="checkboxValue"><br><input type="text" class="checkboxValue" name="sections[new][question][new][option][value][]" placeholder="Enter new option"><a  class="btn delete-checkbox" data-count="' +
                    counter +'"><img src="{{ asset('assets/images/delete_icon.png') }}" alt="img"></a></div>');
                counter++;
            });
            $(document).on('click', '.delete-checkbox', function() {
                var count = $(this).data('count');
                $(this).closest('.questionCheckbox').remove();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var counter = 1;
            $('#add-radio').click(function() {
                $('#radioDiv').append('<div class="questionCheckbox"><input type="radio" class="checkboxValue"><br><input type="text" class="checkboxValue" name="question_option[]" placeholder="Enter new option"><a id="delete-radio" class="delete-radio table_btn" data-count="' + counter + '"><img src="{{ asset('assets/images/delete_icon.png') }}" alt="img"></a></div>');
                counter++;
            });

            $(document).on('click', '.delete-radio', function() {
                var count = $(this).data('count');

                $(this).closest('.questionCheckbox').remove();
            });

        });
    </script>
@endpush

