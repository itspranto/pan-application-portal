@extends("layouts.user")

@section("title") Pan Cards @endsection

@section("custom_css")
    <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section("content")
    <div class="box box-primary">
        <div class="box-header with-border">
            <h1 class="box-title">Pan Cards</h1>
            <div class="pull-right">
                <a href="/pans/apply">
                    <button type="button" class="btn btn-success btn-sm">Apply New PAN</button>
                </a>
            </div>
        </div>
        <div class="box-body">
            @include("includes.message")
            @include("includes.errors")

            <table class="table table-bordered table-striped" id="pans">
                <thead>
                <tr>
                    <th>TempID</th>
                    <th>PAN Type</th>
                    <th>Receipt</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Uploads</th>
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
                "ajax": '/pans/json/showPans',
                columns: [
                    {data: 'id'},
                    {data: 'type'},
                    {data: 'status'},
                    {data: 'name'},
                    {data: 'mobile'},
                    {data: 'uploads'}
                ]
            });
        });
    </script>
@endsection