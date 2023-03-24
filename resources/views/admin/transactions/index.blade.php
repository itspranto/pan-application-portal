@extends("layouts.admin")

@section("title") List Transactions @endsection

@section("custom_css")
    <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section("content")
    <div class="box box-body">
        <div class="box-header">
            <h1 class="box-title">List Transactions</h1>
        </div>

        <div class="box-body">
            <table class="table table-bordered table-striped" id="pans">
                <thead>
                <tr>
                    <th>#ID</th>
                    <th>Method</th>
                    <th>Transaction No</th>
                    <th>By Agent</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
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
            $('#pans').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '/admin/json/transactions/{{ $sorting }}?{!! http_build_query(request()->query()) !!}',
                columns: [
                    {data: 'id'},
                    {data: 'type'},
                    {data: 'tran_number'},
                    {data: 'user'},
                    {data: 'amount'},
                    {data: 'status'},
                    {data: 'view'}
                ]
            });
        });
    </script>
@endsection