@if(count($errors) > 0)
    <div class="alert callout" data-closable>
        <h5>Có lỗi xảy ra!</h5>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
        <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(Session::has('success'))
    <div class="success callout" data-closable>
        <b><i class="fa fa-check"></i> Thành công!</b> {{ Session::get('success') }}
        <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(Session::has('warning'))
    <div class="warning callout" data-closable>
        <b><i class="fa fa-warning"></i> Chú ý!</b> {{ Session::get('warning') }}
        <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif