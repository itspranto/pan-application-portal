@extends("layouts.admin")

@section("title") PAN Application (Form 94A) Info @endsection
@section("custom_css")
    <style>
        .ritz .waffle a {
            color: inherit;
        }

        .ritz .waffle .s0 {
            background-color: #ffffff;
            text-align: left;
            color: #000000;
            vertical-align: bottom;
            direction: ltr;
            padding: 0px 3px 0px 3px;
        }

        .ritz .waffle .s3 {
            border-bottom: 1px SOLID #ccc;
            border-right: 1px SOLID #ccc;
            background-color: #ffffff;
            text-align: left;
            color: #000000;
            vertical-align: middle;
            direction: ltr;
            padding: 5px;
        }

        .ritz .waffle .s1 {
            border-bottom: 1px SOLID #ccc;
            background-color: #ffffff;
            text-align: center;
            font-weight: bold;
            color: #000000;
            vertical-align: middle;
            direction: ltr;
            padding: 0px 3px 0px 3px;
        }

        .ritz .waffle .s2 {
            border-right: 1px SOLID #ccc;
            background-color: #ffffff;
            text-align: left;
            color: #000000;
            vertical-align: bottom;
            direction: ltr;
            padding: 0 3px 0 3px;
        }
    </style>
@endsection
@section("content")
    <div class="box box-primary">
        <div class="box-header text-center">
            <h1 class="box-title">PAN Application (Form 94A) Info</h1>
        </div>
        <div class="box-body">
            @if(count($pan))
                <div class="col-sm-9">
                    <div style="position: relative;" dir="ltr">
                        <div class="ritz grid-container" dir="ltr">
                            <table class="waffle no-grid" cellspacing="0" cellpadding="0">
                                <tbody>
                                <tr>
                                    <td class="s0"></td>
                                    <td class="s1" colspan="10">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="s2"></td>
                                    <td class="s3" colspan="2">Application Type</td>
                                    <td class="s3"
                                        colspan="3">{{ $pan->pan_number == null ? "New" : "Correction" }}</td>
                                    <td class="s3" colspan="2">TempID</td>
                                    <td class="s3"
                                        colspan="3">DPP00000{{ $pan->id }}</td>
                                </tr>
                                @if ($pan->pan_number != null)
                                    <tr style="height:21px;">
                                        <td class="s2"></td>
                                        <td class="s3" colspan="2">PAN Number</td>
                                        <td class="s3" colspan="8">{{ $pan->pan_number }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="s2"></td>
                                    <td class="s3" colspan="2">Applicant's Category</td>
                                    <td class="s3" colspan="3">{{ $pan->category }}</td>
                                    <td class="s3" colspan="2">Date</td>
                                    <td class="s3"
                                        colspan="3">{{ \Carbon\Carbon::parse($pan->date)->format("d/m/Y") }}</td>
                                </tr>
                                <tr>
                                    <td class="s2"></td>
                                    <td class="s3" colspan="1">First Name</td>
                                    <td class="s3" colspan="2">{{ $pan->first_name }}</td>
                                    <td class="s3" colspan="1">Middle Name</td>
                                    <td class="s3" colspan="2">{{ $pan->middle_name }}</td>
                                    <td class="s3" colspan="1">Last Name</td>
                                    <td class="s3" colspan="2">{{ $pan->last_name }}</td>
                                </tr>

                                <tr>
                                    <td class="s2"></td>
                                    <td class="s3" colspan="2">Name of Card</td>
                                    <td class="s3"
                                        colspan="8">{{ $pan->card_name }}</td>
                                </tr>

                                <tr>
                                    <td class="s2"></td>
                                    <td class="s3" colspan="1">Father's First Name</td>
                                    <td class="s3" colspan="2">{{ $pan->father_first_name }}</td>
                                    <td class="s3" colspan="1">Father's Middle Name</td>
                                    <td class="s3" colspan="2">{{ $pan->father_middle_name }}</td>
                                    <td class="s3">Father's Last Name</td>
                                    <td class="s3" colspan="2">{{ $pan->father_last_name }}</td>
                                </tr>

                                <tr>
                                    <td class="s2"></td>
                                    <td class="s3">Date of Birth</td>
                                    <td class="s3"
                                        colspan="5">{{ \Carbon\Carbon::parse($pan->dob)->format("d/m/Y") }}</td>
                                    <td class="s3">Gender</td>
                                    <td class="s3" colspan="5">{{ $pan->gender == 1 ? "Male" : "Female" }}</td>
                                </tr>

                                <tr>
                                    <td class="s2"></td>
                                    <td class="s3">Mobile No</td>
                                    <td class="s3" colspan="5">091-{{ $pan->mobile }}</td>
                                    <td class="s3">Email</td>
                                    <td class="s3" colspan="5">{{ $pan->email }}</td>
                                </tr>

                                <tr>
                                    <td class="s2"></td>
                                    <td class="s3">C/O, S/O, D/O, W/O</td>
                                    <td class="s3" colspan="5">{{ $pan->c_o }}</td>
                                    <td class="s3">Flat/Room/Door/Block No</td>
                                    <td class="s3" colspan="5">{{ $pan->flat }}</td>
                                </tr>

                                <tr>
                                    <td class="s2"></td>
                                    <td class="s3">Flat/Room/Door/Block No</td>
                                    <td class="s3" colspan="5">{{ $pan->flat }}</td>
                                    <td class="s3">Name of Premises/Building/Village</td>
                                    <td class="s3" colspan="5">{{ $pan->premises }}</td>
                                </tr>

                                <tr>
                                    <td class="s2"></td>
                                    <td class="s3">Road/Street/Lane/Post Office</td>
                                    <td class="s3" colspan="5">{{ $pan->road }}</td>
                                    <td class="s3">Area/Locality/Taluka/Sub-Devision</td>
                                    <td class="s3" colspan="5">{{ $pan->area }}</td>
                                </tr>

                                <tr>
                                    <td class="s2"></td>
                                    <td class="s3">Town/City/District</td>
                                    <td class="s3" colspan="5">{{ $pan->city }}</td>
                                    <td class="s3">State</td>
                                    <td class="s3" colspan="5">{{ $pan->state }}</td>
                                </tr>

                                <tr>
                                    <td class="s2"></td>
                                    <td class="s3">Area PIN Code</td>
                                    <td class="s3" colspan="5">{{ $pan->area_pin }}</td>
                                    <td class="s3">Country</td>
                                    <td class="s3" colspan="5">India</td>
                                </tr>

                                <tr>
                                    <td class="s2"></td>
                                    <td class="s3">Adhar Number</td>
                                    <td class="s3" colspan="5">{{ $pan->adhar_number }}</td>
                                    <td class="s3">Adhar Card Proof</td>
                                    <td class="s3" colspan="5">
                                        <a href="{{ asset($pan->adhar_proof) }}">
                                            <img src="{{ asset($pan->adhar_proof) }}" style="max-width: 150px"/>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="s2"></td>
                                    <td class="s3">Identity Proof</td>
                                    <td class="s3" colspan="10">{{ $pan->identity_proof }}</td>
                                </tr>

                                <tr>
                                    <td class="s2"></td>
                                    <td class="s3">Address Proof</td>
                                    <td class="s3" colspan="10">{{ $pan->address_proof }}</td>
                                </tr>

                                <tr>
                                    <td class="s2"></td>
                                    <td class="s3">Date of Birth Proof</td>
                                    <td class="s3" colspan="10">{{ $pan->dob_proof }}</td>
                                </tr>

                                <tr>
                                    <td class="s2"></td>
                                    <td class="s3">PIN Code</td>
                                    <td class="s3" colspan="5">{{ $pan->pin }}</td>
                                    <td class="s3">Charged Fee</td>
                                    <td class="s3" colspan="5">Rs. {{ $pan->fee }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="col-sm-3">
                    <div class="list-group">
                        <div class="list-group-item">
                            <b>PAN Status: </b><br/>
                            @if ($pan->status == 1)
                                <div class="label label-success">Accepted</div>

                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#upload">
                                    <i class="fa fa-upload"></i> Upload Again
                                </button>
                                <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#rejectPan">
                                    <i class="fa fa-ban"></i> Reject
                                </button>
                            @elseif($pan->status == 2)
                                <div class="label label-info">Pending Uploading</div>

                                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#upload">
                                    <i class="fa fa-upload"></i> Accept Upload
                                </button>


                                <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#rejectPan">
                                    <i class="fa fa-ban"></i> Reject
                                </button>

                            @else
                                <p><div class="label label-danger">Rejected</div></p>
                                <p class="text-danger">Reason: {{ $pan->reject_reason }}</p>
                                <p><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#upload">
                                        <i class="fa fa-check"></i> Accept & Upload
                                    </button></p>
                            @endif
                        </div>
                        <div class="list-group-item">

                            <b>PAN Documents: </b><br/>
                            @if ($pan->documents != null)
                                <p><div class="label label-success">Document Uploaded</div></p>
                                <p><a href="{{ asset($pan->documents) }}">
                                        <button class="btn btn-primary btn-xs">
                                            <i class="fa fa-file"></i> View Documents
                                        </button>
                                    </a></p>
                                <p><a href="{{ asset($pan->photo) }}">
                                        <button class="btn btn-primary btn-xs">
                                            <i class="fa fa-photo"></i> View Photo
                                        </button>
                                    </a></p>
                                <p><a href="{{ asset($pan->signature) }}">
                                        <button class="btn btn-primary btn-xs">
                                            <i class="fa fa-edit"></i> View Signature
                                        </button>
                                    </a></p>
                            @else
                                <div class="label label-info">Waiting Upload</div>
                            @endif

                        </div>
                        <div class="list-group-item">
                            <b>Submitted By: </b><br/>
                            <a href="/admin/users/{{ $pan->user->id }}">
                                <button class="btn btn-default btn-xs">
                                    {{ $pan->user->name }}
                                </button>
                            </a>
                        </div>

                        <div id="upload" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;
                                        </button>
                                        <h4 class="modal-title">Upload Receipt</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/admin/pans/upload/{{ $pan->id }}"
                                              enctype="multipart/form-data">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label for="receipt">Receipt (PDF)</label>
                                                <input type="file" name="receipt" class="form-control" required/>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="rejectPan" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;
                                        </button>
                                        <h4 class="modal-title">Reject PAN</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/admin/pans/reject/{{ $pan->id }}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                        <textarea name="reject_reason" class="form-control"
                                                                  placeholder="Reject Reason"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-danger">Reject</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
        </div>

        @else
            The PAN you are looking for can not be found!
        @endif
    </div>
    </div>
@endsection