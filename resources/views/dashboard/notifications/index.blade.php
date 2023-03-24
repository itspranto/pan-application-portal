@extends("layouts.user")

@section("title") Notifications @endsection

@section("custom_css")
    <link href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section("content")
    <div class="box box-primary">
        <div class="box-header with-border">
            <h1 class="box-title">Notifications</h1>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped" id="notifications">
                <thead>
                <tr>
                    <th>#ID</th>
                    <th>Subject</th>
                    <th>Date</th>
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
            $('#notifications').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '/notifications/json/showNotifications',
                columns: [
                    {data: 'id'},
                    {data: 'subject'},
                    {data: 'created_at'}

                ]
            });
        });
    </script>
@endsection