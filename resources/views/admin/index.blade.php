@extends("layouts.admin")

@section("title") Admin Panel Dashboard @endsection

@section("content")
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

                <div class="info-box-content" style="padding-bottom: 0;padding-top: 1px">
                    <span class="info-box-text">Active Agents</span>
                    <span class="info-box-number">{{ \App\User::where(["status" => 1])->count() }}</span>
                </div>
                <div class="info-box-content" style="padding-bottom: 0;padding-top: 0">
                    <span class="info-box-text">Total Agents</span>
                    <span class="info-box-number">{{ \App\User::count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-credit-card"></i></span>

                <div class="info-box-content" style="padding-bottom: 0;padding-top: 1px">
                    <span class="info-box-text">New PANs</span>
                    <span class="info-box-number">{{ \App\Pan::where(["status" => 1])->whereNull("pan_number")->count() }}
                        | {{ \App\Pan::whereNull("pan_number")->count() }}</span>
                </div>
                <div class="info-box-content" style="padding-bottom: 0;padding-top: 0">
                    <span class="info-box-text">Correction PANs</span>
                    <span class="info-box-number">{{ \App\Pan::where(["status" => 1])->whereNotNull("pan_number")->count() }}
                        | {{ \App\Pan::whereNotNull("pan_number")->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-file-o"></i></span>

                <div class="info-box-content" style="padding-bottom: 0;padding-top: 1px">
                    <span class="info-box-text">Completed Transactions</span>
                    <span class="info-box-number">{{ \App\Transaction::where(["status" => 1])->count() }}</span>
                </div>
                <div class="info-box-content" style="padding-bottom: 0;padding-top: 0">
                    <span class="info-box-text">All Transactions</span>
                    <span class="info-box-number">{{ \App\Transaction::count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

                <div class="info-box-content" style="padding-bottom: 0;padding-top: 1px">
                    <span class="info-box-text">PANs (Completed)</span>
                    <span class="info-box-number">Rs. {{ \App\Pan::where(["status" => 1])->sum("fee") }}</span>
                </div>
                <div class="info-box-content" style="padding-bottom: 0;padding-top: 0">
                    <span class="info-box-text">Transactions (Completed)</span>
                    <span class="info-box-number">Rs. {{ \App\Transaction::where(["status" => 1])->sum("amount") }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-sm-6">
            <div class="box box-danger">
                <div class="box-header with-border text-danger">
                    <h3 class="box-title"><i class="fa fa-bell-o"></i> Things To Do</h3>
                </div>

                <div class="box-body">
                    <div class="list-group">
                        @if (($users = \App\User::where(["status" => 2])->count()) > 0)
                            <a href="/admin/list/users/pending" class="list-group-item">
                                <small class="label bg-red">{{ $users }}</small>
                                Agents waiting for activation
                            </a>
                        @endif

                        @if (($pans = \App\Pan::where(["status" => 2])->count()) > 0)
                            <a href="/admin/list/pans/pending" class="list-group-item">
                                <small class="label bg-red">{{ $pans }}</small>
                                PANs needs uploading of receipt.
                            </a>
                        @endif

                        @if (($transactions = \App\Transaction::where(["status" => 2])->count()) > 0)
                            <a href="/admin/list/transactions/pending" class="list-group-item">
                                <small class="label bg-green">{{ $transactions }}</small>
                                Transactions needs to be validated.
                            </a>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection