@extends("layouts.admin")

@section("title") List Users @endsection

@section("custom_css")
    <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section("content")
    <div class="box box-body">
        <div class="box-header">
            <h1 class="box-title">List Users</h1>
        </div>

        <div class="box-body">
            <table class="table table-bordered table-striped" id="users">
                <thead>
                <tr>
                    <th>Branch ID</th>
                    <th>Branch Master Name</th>
                    <th>Status</th>
                    <th>New PAN (94A)</th>
                    <th>Correction</th>
                    <th>Accepted</th>
                    <th>Pending</th>
                    <th>Rejected</th>
                    <th>Transactions</th>
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
        $(document).ready(function() {
            $('#users').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax": '/admin/json/users/{{ $sorting }}',
                columns: [
                    {data: 'vendor_id'},
                    {data: 'name'},
                    {data: 'status'},
                    {data: 'new_pan'},
                    {data: 'edit_pan'},
                    {data: 'accepted'},
                    {data: 'pending'},
                    {data: 'rejected'},
                    {data: 'transactions'}
                ]
            } );
        } );
    </script>
@endsection