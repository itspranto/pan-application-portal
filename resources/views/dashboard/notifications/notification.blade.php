@extends("layouts.user")

@section("title") Notification Details @endsection

@section("content")
    <div class="box box-primary">
        <div class="box-header with-border">
            <h1 class="box-title">{{ $notification->subject }}</h1>
            <i class="pull-right">Date: {{ $notification->created_at->toFormattedDateString() }}</i>
        </div>
        <div class="box-body">
            {!! $notification->message !!}
        </div>
    </div>
@endsection