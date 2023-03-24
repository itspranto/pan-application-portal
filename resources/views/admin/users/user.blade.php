@extends("layouts.admin")

@section("title") Agent Info @endsection

@section("content")
    <div class="box box-primary">
        <div class="box-header">
            <h1 class="box-title">Agent Info</h1>
        </div>
        <div class="box-body">
            @if(count($user))
                <div class="col-sm-9">
                    <form method="post" action="/admin/users/{{ $user->id }}">
                        {{ method_field("PATCH") }}
                        {{ csrf_field() }}

                        <div class="col-sm-12">
                            <h4 class="page-header">Personal Details</h4>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Agent ID:</label>
                                <input type="text" value="{{ $user->id }}" class="form-control" readonly/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Agent BranchID:</label>
                                <input type="text" value="{{ $user->vendor_id }}" class="form-control" readonly/>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Agent Email:</label>
                                <input type="text" value="{{ $user->email }}" class="form-control" readonly/>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Agent Balance:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rs.</span>
                                    <input type="text" name="balance" value="{{ $user->balance }}"
                                           class="form-control"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Full Name:</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Mobile Number:</label>
                                <input type="text" name="mobile" value="{{ $user->mobile }}" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>PIN Number:</label>
                                <input type="text" name="pin" value="{{ $user->pin }}" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Address:</label>
                                <input type="text" name="address" value="{{ $user->address }}" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>City:</label>
                                <input type="text" name="city" value="{{ $user->city }}" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>State:</label>
                                <input type="text" name="state" value="{{ $user->state }}" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <h4 class="page-header">Business Details</h4>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Retailer Shop Name:</label>
                                <input type="text" name="shop" value="{{ $user->state }}" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Landline Number with STD:</label>
                                <input type="text" name="landline" value="{{ $user->landline }}" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Franchise Location:</label>
                                <input type="text" name="franchise" value="{{ $user->franchise }}"
                                       class="form-control"/>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Current Business:</label>
                                <input type="text" name="business" value="{{ $user->business }}" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>PAN Card Number:</label>
                                <input type="text" name="pan_number" value="{{ $user->pan_number }}"
                                       class="form-control"/>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Adhar Card Number:</label>
                                <input type="text" name="adhar_number" value="{{ $user->adhar_number }}"
                                       class="form-control"/>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <h4 class="page-header">Uploaded Files</h4>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="photograph">Photograph</label>
                                <br/><a href="{{ asset($user->photograph) }}"><img src="/{{ asset($user->photograph) }}"
                                                                                   style="max-width: 150px"/></a>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="photograph">Signature</label>
                                <br/><a href="{{ asset($user->signature) }}"><img src="/{{ asset($user->signature) }}"
                                                                                  style="max-width: 150px"/></a>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="photograph">Adhar Card</label>
                                <br/><a href="{{ asset($user->adhar_card) }}"><img src="/{{ asset($user->adhar_card) }}"
                                                                                   style="max-width: 150px"/></a>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="photograph">PAN Card</label>
                                <br/><a href="{{ asset($user->pan_card) }}"><img src="/{{ asset($user->pan_card) }}"
                                                                                 style="max-width: 150px"/></a>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success">Update Agent</button>
                        </div>

                    </form>
                </div>
                <div class="col-sm-3">
                    <div class="list-group">
                        <div class="list-group-item">
                            <b>Agent Status: </b><br/><br/>
                            @if ($user->status == 1)
                                <div class="label label-success">Active</div>
                                <a href="/admin/users/block/{{ $user->id }}">
                                    <button class="btn btn-danger btn-xs">
                                        <i class="fa fa-ban"></i> Block
                                    </button>
                                </a>
                            @elseif($user->status == 2)
                                <div class="label label-info">Pending</div>
                                <a href="/admin/users/activate/{{ $user->id }}">
                                    <button class="btn btn-success btn-xs">
                                        <i class="fa fa-check"></i> Activate
                                    </button>
                                </a>
                                <a href="/admin/users/block/{{ $user->id }}">
                                    <button class="btn btn-danger btn-xs">
                                        <i class="fa fa-ban"></i> Block
                                    </button>
                                </a>
                            @else
                                <div class="label label-danger">Blocked</div>
                                <a href="/admin/users/activate/{{ $user->id }}">
                                    <button class="btn btn-success btn-xs">
                                        <i class="fa fa-check"></i> Activate
                                    </button>
                                </a>
                            @endif
                            <br/><br/><b>Member Since:</b> {{ $user->created_at->toFormattedDateString() }}
                        </div>
                        <div class="list-group-item">
                            <b>Agent Stats: </b><br/><br/>
                            <a href="/admin/list/transactions/all?user={{ $user->id }}">
                                <button class="btn btn-default btn-xs" style="margin: 4px">
                                    <small class="label bg-green">{{ $user->transactions()->count() }}</small>
                                    Total Transactions
                                </button>
                            </a>
                            <a href="/admin/list/pans/all?user={{ $user->id }}">
                                <button class="btn btn-default btn-xs" style="margin: 4px">
                                    <small class="label bg-blue">{{ $user->pans()->count() }}</small>
                                    Total PANs
                                </button>
                            </a>
                            <a href="/admin/list/pans/active?user={{ $user->id }}">
                                <button class="btn btn-default btn-xs" style="margin: 4px">
                                    <small class="label bg-blue">{{ $user->pans()->where(["status" => 1])->count() }}</small>
                                    Total Accepted PANs
                                </button>
                            </a>
                            <a href="/admin/list/pans/pending?user={{ $user->id }}">
                                <button class="btn btn-default btn-xs" style="margin: 4px">
                                    <small class="label bg-blue">{{ $user->pans()->where(["status" => 2])->count() }}</small>
                                    Total Pending PANs
                                </button>
                            </a>
                            <a href="/admin/list/pans/rejected?user={{ $user->id }}">
                                <button class="btn btn-default btn-xs" style="margin: 4px">
                                    <small class="label bg-blue">{{ $user->pans()->where(["status" => 0])->count() }}</small>
                                    Total Rejected PANs
                                </button>
                            </a>

                            <a href="/admin/list/pans/all?user={{ $user->id }}&type=1">
                                <button class="btn btn-default btn-xs" style="margin: 4px">
                                    <small class="label bg-blue">{{ $user->pans()->whereNull("pan_number")->count() }}</small>
                                    Total New PANs
                                </button>
                            </a>
                            <a href="/admin/list/pans/active?user={{ $user->id }}&type=1">
                                <button class="btn btn-default btn-xs" style="margin: 4px">
                                    <small class="label bg-blue">{{ $user->pans()->where(["status" => 1])->whereNull("pan_number")->count() }}</small>
                                    Total
                                    Accepted New PANs
                                </button>
                            </a>
                            <a href="/admin/list/pans/pending?user={{ $user->id }}&type=1">
                                <button class="btn btn-default btn-xs" style="margin: 4px">
                                    <small class="label bg-blue">{{ $user->pans()->where(["status" => 2])->whereNull("pan_number")->count() }}</small>
                                    Total
                                    Pending New PANs
                                </button>
                            </a>
                            <a href="/admin/list/pans/rejected?user={{ $user->id }}&type=1">
                                <button class="btn btn-default btn-xs" style="margin: 4px">
                                    <small class="label bg-blue">{{ $user->pans()->where(["status" => 0])->whereNull("pan_number")->count() }}</small>
                                    Total
                                    Rejected New PANs
                                </button>
                            </a>

                            <a href="/admin/list/pans/all?user={{ $user->id }}&type=2">
                                <button class="btn btn-default btn-xs" style="margin: 4px">
                                    <small class="label bg-blue">{{ $user->pans()->whereNotNull("pan_number")->count() }}</small>
                                    Total Correction PANs
                                </button>
                            </a>
                            <a href="/admin/list/pans/active?user={{ $user->id }}&type=2">
                                <button class="btn btn-default btn-xs" style="margin: 4px">
                                    <small class="label bg-blue">{{ $user->pans()->where(["status" => 1])->whereNotNull("pan_number")->count() }}</small>
                                    Total Accepted Correction PANs
                                </button>
                            </a>
                            <a href="/admin/list/pans/pending?user={{ $user->id }}&type=2">
                                <button class="btn btn-default btn-xs" style="margin: 4px">
                                    <small class="label bg-blue">{{ $user->pans()->where(["status" => 2])->whereNotNull("pan_number")->count() }}</small>
                                    Total Pending Correction PANs
                                </button>
                            </a>
                            <a href="/admin/list/pans/rejected?user={{ $user->id }}&type=2">
                                <button class="btn btn-default btn-xs" style="margin: 4px">
                                    <small class="label bg-blue">{{ $user->pans()->where(["status" => 0])->whereNotNull("pan_number")->count() }}</small>
                                    Total Rejected Correction PANs
                                </button>
                            </a>

                        </div>
                        <div class="list-group-item">
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#penalty">
                                <i class="fa fa-minus-circle"></i> Penalty Agent
                            </button><br/><br/>
                            <small class="label bg-red">{{ $user->penalties()->count() }}</small>
                            Total Penalties

                            <div id="penalty" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;
                                            </button>
                                            <h4 class="modal-title">Penalty Agent</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="/admin/users/penalty/{{ $user->id }}">
                                                {{ csrf_field() }}

                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="amount"
                                                           placeholder="Amount">
                                                </div>

                                                <div class="form-group">
                                                    <textarea name="reason" class="form-control"
                                                              placeholder="Penalty Reason"></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-danger">Penalty</button>
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
                The user you are looking for can not be found!
            @endif
        </div>
    </div>
@endsection