@extends('layouts.app')

@section('content')

<body>
    <div class="container"><br><br>
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card" id="show_token_config">
                    <div class="card-header" style="text-align: center;font-size:20px;font-family: cursive">{{ __("Meal's Coupon") }}</div>
                    <div class="row offset-md-1">
                        <div class="col-md-7">
                            Today is <span style="font-weight: bold;" id="today_date"></span>
                        </div>
                        <div class="col-md-5">
                            <?php
                            $set_time  = $token_details->deadline_time
                            ?>
                            Remaining Time : <span id='time' style="font-weight: bold;"></span>
                        </div>
                    </div>
                    <div class="card-body ">
                        <p class="card-content offset-md-2 " style="font-size:16px;font-family: cursive"> Select your require event:</p>
                        <form method="POST" action="{{ route('register_verify') }}">
                            @csrf

                            @if($token_details->breakfast_price)
                            <div class="row mb-3 ml-5 offset-md-2" id="details_breakfast">
                                <div class="form-check  col-md-5">
                                    <input class="form-check-input notify_details" type="checkbox" value="1" name="breakfast_check">
                                    <label for="name" class="form-check-label" for="flexCheckChecked">Breakfast ({{$token_details->breakfast_price}} TK)</label>
                                </div>
                            </div>
                            @endif
                            @if($token_details->lunch_price)
                            <div class="row mb-3 ml-3 offset-md-2" id="details_breakfast">
                                <div class="form-check  col-md-5">
                                    <input class="form-check-input notify_details" type="checkbox" value="1" name="breakfast_check">
                                    <label for="name" class="form-check-label" for="flexCheckChecked">Lunch ({{$token_details->lunch_price}} TK)</label>
                                </div>
                            </div>
                            @endif
                            @if($token_details->dinner_price)
                            <div class="row mb-3 ml-3 offset-md-2" id="details_breakfast">
                                <div class="form-check  col-md-5">
                                    <input class="form-check-input notify_details" type="checkbox" value="1" name="breakfast_check">
                                    <label for="name" class="form-check-label" for="flexCheckChecked">Dinner ({{$token_details->dinner_price}} TK)</label>
                                </div>
                            </div>
                            @endif

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-5">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Confirm') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card p-5 mt-4" id="time_over_card" style="display: none;text-align:center;font-family:cursive;font-size:20px">
                    Today's Time is Over!
                </div>
            </div>
        </div>
    </div>

    @endsection

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>
        (function() {
            var set_time = '<?php echo $set_time ?>';
            var start = new Date;
            start.setHours(set_time, 0, 0); // 11pm

            function pad(num) {
                return ("0" + parseInt(num)).substr(-2);
            }

            function tick() {
                var now = new Date;
                if (now > start) { // too late, go to tomorrow
                    start.setDate(start.getDate() + 1);
                }
                var remain = ((start - now) / 1000);
                var hh = pad((remain / 60 / 60) % 60);
                var mm = pad((remain / 60) % 60);
                var ss = pad(remain % 60);
                document.getElementById('time').innerHTML =
                    hh + ":" + mm + ":" + ss;
                setTimeout(tick, 1000);
            }

            document.addEventListener('DOMContentLoaded', tick);
        })();
    </script>
</body>