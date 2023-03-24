@extends("layouts.admin")

@section("title") Transaction Info @endsection

@section("content")
    <div class="box box-primary">
        <div class="box-header">
            <h1 class="box-title">Transaction Info</h1>
        </div>
        <div class="box-body">
            @if(count($transaction))
                <div class="col-sm-9">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>#ID</th>
                            <th>Agent</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Transaction No</th>
                            <th>Created At</th>
                            @if ($transaction->type == 2)
                                <th>Bank</th>
                                <th>Remarks</th>
                            @endif
                        </tr>
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td><a href="/admin/users/{{ $transaction->user->id }}">{{ $transaction->user->name }}</a>
                            </td>
                            <td>Rs. {{ $transaction->amount }}</td>
                            <td>{{ $transaction->type == 1 ? 'PayTM' : 'Bank' }}</td>
                            <td>{{ $transaction->tran_number }}</td>
                            <td>{{ $transaction->created_at->toFormattedDateString() }}</td>
                            @if ($transaction->type == 2)
                                <td>{{ $transaction->bank }}</td>
                                <td>{{ $transaction->remarks }}</td>
                            @endif
                        </tr>
                    </table>
                </div>
                <div class="col-sm-3">
                    <div class="list-group">
                        <div class="list-group-item">
                            <b>Transaction Status: </b><br/><br/>
                            @if ($transaction->status == 1)
                                <div class="label label-success">Completed</div>
                            @elseif($transaction->status == 2)
                                <div class="label label-info">Pending</div>

                                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#addbal">
                                    <i class="fa fa-check"></i> Verify & Add Balance
                                </button>

                                <a href="/admin/transactions/reject/{{ $transaction->id }}">
                                    <button class="btn btn-danger btn-xs">
                                        <i class="fa fa-ban"></i> Reject
                                    </button>
                                </a>
                            @else
                                <div class="label label-danger">Rejected</div>
                                <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#addbal">
                                    <i class="fa fa-check"></i> Verify & Add Balance
                                </button>
                            @endif

                            <div id="addbal" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;
                                            </button>
                                            <h4 class="modal-title">Verify Transaction & Add Balance</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                Are you sure this transaction is valid?
                                                Agent <b>{{ $transaction->user->name }}</b> will be credited
                                                <b>Rs. {{ $transaction->amount }}</b> after this.
                                            </p>
                                        </div>
                                        <div class="modal-footer">

                                            <form method="post"
                                                  action="/admin/transactions/complete/{{ $transaction->id }}">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-success">
                                                    Validate & Add Balance
                                                </button>
                                                <button type="button" class="btn btn-danger pull-right"
                                                        data-dismiss="modal">
                                                    No Cancel
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @else
                The transaction you are looking for can not be found!
            @endif
        </div>
    </div>
@endsection