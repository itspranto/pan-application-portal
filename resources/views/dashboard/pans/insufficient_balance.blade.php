@extends("layouts.user")

@section("title") Insufficient Balance @endsection

@section("content")

    @section("box_title") Insufficient Balance @endsection

    @section("box_body")
        <p>Hello! You don't have enough balance to apply for new or correction of PAN Cards.
            The minimum FEE for PAN Application is: <b>Rs. {{ env("PROCESSING_FEE") }}</b>
        </p>
    @endsection
    @include("includes.box")
@endsection