<div class="col-12">
    @if ($errors->any())
    <div class="alert alert-danger" id="notification_error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (Session::has('message'))

    <div class="alert alert-success " id="notification_success">{{ Session::get('message') }}</div>

    @endif
    @if (Session::has('Errors'))

    <div class="alert alert-danger">{{ Session::get('Errors') }}</div>

    @endif
</div>