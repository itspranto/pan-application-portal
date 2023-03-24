@extends("layouts.user")

@section("title") Transaction History @endsection

@section("custom_css")
    <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section("content")
    <div class="box box-primary">
        <div class="box-header with-border">
            <h1 class="box-title">Transaction History</h1>
            <div class="pull-right">
                <a href="/transactions/new">
                    <button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Wallet Recharge</button>
                </a>
            </div>
        </div>

        <div class="box-body">
            @include("includes.message")
                <table class="table table-bordered table-striped" id="transactions">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Date</th>
                        <th>Method</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                </table>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#transactions').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '/transactions/json/showTransactions',
                columns: [
                    {data: 'id'},
                    {data: 'created_at'},
                    {data: 'type'},
                    {data: 'amount'},
                    {data: 'status'}
                ]
            });
        });
    </script>
@endsection