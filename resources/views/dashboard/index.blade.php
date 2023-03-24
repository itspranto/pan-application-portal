@extends("layouts.user")

@section("title") Dashboard @endsection


@section("content")
    @include("includes.notification")

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">

            <div class="inner">
                <a href="/transactions" style="color: #fff;display: block">
                    <h3>Rs. {{ auth()->user()->balance }}</h3>

                    <p>Wallet Balance</p>
                </a>

            </div>
            <div class="icon">
                <i class="fa fa-money"></i>
            </div>
            <a href="/transactions/new" class="small-box-footer"><i class="fa fa-flash"></i> Recharge Wallet</a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">

                <div class="inner">
                    <a href="/pans" style="color: #fff;display: block">
                        <h3>{{ auth()->user()->pans()->count() }}</h3>

                        <p>PANs Submitted</p>
                    </a>

                </div>
                <div class="icon">
                    <i class="fa fa-credit-card"></i>
                </div>
            <a href="/pans/apply" class="small-box-footer"><i class="fa fa-plus"></i> Apply/Correction PAN Card</a>
        </div>
    </div>
@endsection