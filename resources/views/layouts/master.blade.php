<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/fontawesome.min.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/hole-Logo.svg') }}">

    <!-- Font-Family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @stack('style-end')

</head>

<body>
    <div class="wrapper" id="vue-component">
        @include('includes.sidebar')
        <div class="each__section">
            @include('includes.navbar')
            <div class="page-content">
                <div class="page-layout">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script>
        window.Laravel = {!! json_encode([
                    'baseUrl' => url('/').'/',
                    'apiUrl' => url('/').'/api'
                ]) !!};
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
            document.body.style.backgroundColor = "white";
        }

        $(document).ready(function() {
            $(".data-table").DataTable(
            {
                /* No ordering applied by DataTables during initialisation */
                "order": []
            }
            );
            $('.js-example-basic-single').select2();
        });

    </script>
    <script>
        $(document).ready(function(e) {
            $("#add-button").click(function() {
                $(".add-more").append(`
            <div class="col-lg-12 p-0 dynamic-field">
                <div class="col-lg-9 question">
                    <div class="row">
                        <div class="col">
                            <div class="form_groups d-flex align-items-center ">
                                <label for="">Question:</label>
                                <input type="text" id="fname" name="fname" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="check-box1">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col">
                                <div class="form_groups d-flex align-items-center  ">
                                    <label for="">Type<span>*</span>:</label>
                                    <select name="selectbox" class="select">
                                        <option value="Text Box">Text Box</option>
                                        <option value="checkBox">check box</option>
                                        <option value="mercedes">Mercedes</option>
                                        <option value="audi">Audi</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`);
            });
            $("#remove-button").click(function() {
                $('.add-more').find(".dynamic-field:last-child").remove();
            });
            $(document).on('change', ".select", function() {
                var selectedOptionText = $(this).val();
                if (selectedOptionText === "checkBox") {
                    $(this).closest('.check-box1').append(`<div class="col-lg-9 show-div dynamic-fields">
                    <div class="fields_checkbox d-flex">
                        <input type="checkbox" /><span>hello</span>
                    </div> 
                </div>
                <div class="clearfixs">
                    <button type="button" class="btn btn-secondary add-buttons float-left text-uppercase shadow-sm"> <img src="{{asset('assets/images/plus.png')}}" alt="img">
                    </button>
                    <button type="button" class="btn btn-secondary remove-buttons float-left text-uppercase ml-1 shadow-sm "><img src="{{asset('assets/images/minus.png')}}" alt="img">
                    </button>
                </div>`);

                    $(".add-buttons").click(function() {
                        $(this).closest('.check-box1').children('.dynamic-fields').append(`
                            <div class="fields_checkbox d-flex">
                                <input type="checkbox" /><span>hello</span>
                            </div>
                    `);
                    });
                    $(".remove-buttons").click(function() {

                        $(this).closest('.check-box1').find('.dynamic-fields').children('.fields_checkbox').last().remove();
                    });
                } else {
                    var currentRow = $(this).closest('.check-box1').children('.show-div,.clearfixs');
                    currentRow.remove();
                }
            });
            
            jQuery.validator.addMethod("tel", function (value, element) {
        return this.optional(element) || /^(?:\+|00)[0-9]+$/.test(value);
    }, "{{ __('Please enter  number starting with + sign OR 00.') }}");

        });
    </script>
    


    @stack('scripts-end')

</body>

</html>