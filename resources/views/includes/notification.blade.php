@if (($notifications = auth()->user()->notifications()->where(["status" => 1])->count()) > 0)
    <a href="/notifications">
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            You have {{ $notifications }} notifications!
        </div>
    </a>
@endif