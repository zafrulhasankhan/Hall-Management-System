@extends('layouts.AppTemplate')

<style>
    .pull-left {
        float: left !important;
    }

    .pull-right {
        float: right !important;
        padding: 5px;
    }

    .dataTables_paginate {
        float: right !important;
        padding: 5px;


    }

    .dataTables_info {
        padding: 5px;

    }

    .summary {
        float: right;
        color: white;
    }

    .left {
        margin-left: 65px;
        padding: 20px;
        float: left;
    }

    .right {
        margin-right: 30px;
        padding: 20px;
        float: right;
    }

    .headline {
        text-align: center;
        font: 20px;
        font-family: cursive;
    }

@media print{
    html,body{
        font-family: cursive;
    }
}

    /* .dataTables_length, .dataTables_length select{ font-size: 2em;} */
</style>

@section('nav-bread')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Student List</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Student List </h6>
</nav>
@endsection

@section('section')


<!-- <div style="text-align: center;font-size:20px;font-family: cursive" class="card-header">{{ __('Student List') }}</div> -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">{{ __('Recent Token Orders List') }}</h6>
                        <button class="btn btn-text summary" id="button_summary"><span style="color:white">Show summary</span></button>
                        <h6 class="text-white text-capitalize ps-3">{{ $recent_order_list[0]->date }}</h6>

                    </div>

                </div>
                <div class="card-body px-0 pb-2" id="details">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-4" id="datatable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Agent No.</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Breakfast</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lunch</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dinner</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recent_order_list as $list)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">

                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $list->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $list->email }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $list->phone }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">{{ $list->amount }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $list->breakfast }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $list->lunch}}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $list->dinner }}</span>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body px-0 pb-2" id="summary" style="display: none">
                    <div id="print">
                        <div class="headline"><u>Meal Summary of {{ $recent_order_list[0]->date }}</u></div>
                        <div class="left">
                            <span>No. of Breakfast's Meal : {{$data['count_break']}}</span><br>
                            <span>No. of Lunch's Meal : {{$data['count_lunch']}}</span><br>
                            <span>No. of Dinner's Meal : {{$data['count_dinner']}}</span><br>
                        </div>
                        <div class="right">
                            <span>Total amount of Breakfast's Meal : {{$data['sum_break']}} TK</span><br>
                            <span>Total amount of Lunch's Meal : {{$data['sum_lunch']}} TK</span><br>
                            <span>Total amount of Dinner's Meal : {{$data['sum_dinner']}} TK</span><br>
                            <span>Total Amount: {{$data['sum_total']}} TK</span>
                        </div>
                    </div>
                    <input class="print_button btn btn-secondary offset-md-5 type="button" value="Print" onclick="printDiv()">
                </div>
            </div>
        </div>
    </div>


</div>


@endsection
@section('DT_script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "dom": '<"pull-right"f><"pull-left"l>tip',
            pagingType: 'simple_numbers',

        });

        $('#button_summary').on("click", function(e) {
            $("#details, #summary").toggle();
        });
    });

    // function myFunction() {
    //     var x = document.getElementById("details");
    //     var y = document.getElementById("summary");
    //     if (x.style.display === "none") {
    //         y.style.display = "block";
    //     }
    //     elseif(y.style.display === "none") {
    //         x.style.display = "block";

    //     }
    // }
</script>
<script type="text/javascript" src="js/jquery.printPage.js"></script>
<script>
    function printDiv() {
        var divContents = document.getElementById("print").innerHTML;
        var a = window.open('', '', 'height=500, width=500');
        a.document.write('<html>');
        a.document.write('<body > <h2>');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.print();
    }
</script>
@endsection