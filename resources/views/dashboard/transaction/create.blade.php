@extends("layouts.user")

@section("title") Wallet Recharge @endsection


@section("content")
    <div class="box box-primary">
        <div class="box-header with-border text-center">
            <h1 class="box-title">Wallet Recharge</h1>
        </div>

        <div class="box-body">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#paytm">Paytm</a></li>
                <li><a data-toggle="tab" href="#bank">Bank</a></li>
            </ul>

            <div class="tab-content">
                <div id="paytm" class="tab-pane fade in active">
                    <h3 class="page-header">Paytm Wallet Recharge</h3>
                    <div class="row">
                        <div class="col-md-8">
                            <form method="post" action="/transactions">
                                {{ csrf_field() }}

                                <input type="hidden" name="type" value="1">

                                <div class="form-group">
                                    <input type="text" name="amount" placeholder="Amount" class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="tran_number" placeholder="Transaction Number" class="form-control">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">
                                        Recharge Wallet
                                    </button>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-4">
                            <p class="text-center">
                                <b>Wallet recharge via paytm</b><br/>
                                <br/>
                                Please send money to this number before creating transaction<br/>
                                <strong>+98012345678</strong>
                            </p>
                        </div>
                    </div>
                </div>
                <div id="bank" class="tab-pane fade">
                    <h3 class="page-header">Bank Wallet Recharge</h3>
                    <div class="row">
                        <div class="col-md-8">
                            <form method="post" action="/transactions">
                                {{ csrf_field() }}

                                <input type="hidden" name="type" value="2">

                                <div class="form-group">
                                    <input type="text" name="amount" placeholder="Amount" class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="tran_number" placeholder="Transaction Number" class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="bank" placeholder="Bank Name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="remarks" placeholder="Remarks" class="form-control">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">
                                        Recharge Wallet
                                    </button>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-4">
                            <p class="text-center">
                                <b>Bank Info</b><hr/>
                                <b>Bank Name:</b> Dummy Bank Inc.<br/>
                                <b>Branch:</b> Dummy Branch (Dummy)<br/>
                                <b>A/C Name:</b> John Doe<br/>
                                <b>A/C Number:</b> 1234567890012<br/>
                                <b>IFSC Code:</b> TEST123458756<br/>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection