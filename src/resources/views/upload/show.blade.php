@extends('layout')
@section('title', __('Import file'))
@section('content')
    <div class="container mt-3 mb-5">
        <h5 class="m-0 text-uppercase">{{ __('Upload file') }}</h5>
        <hr>
        <form action="{{ route('upload.store') }}" method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-sm-12 col-md-5 col-xl-3">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input type="file" name="file" class="form-control"
                       oninvalid="this.setCustomValidity('{{ __('Select file') }}')"
                       oninput="this.setCustomValidity('')">
            </div>
            <div class="col-sm-6 col-md-4 col-xl-2 d-grid">
                <button type="submit" class="btn btn-outline-primary text-uppercase">{{ __('Upload') }}</button>
            </div>
            <div class="col-sm-6 col-md-3 col-xl-2 d-grid">
                <a href="{{ route('upload.list') }}" class="btn btn-outline-primary text-uppercase">{{ __('Rows') }}</a>
            </div>
        </form>
        <div class="mt-3 mb-3">
            <ul class="list-group" id="row-import-progress"></ul>
            <ul class="list-group" id="row-import-errors"></ul>
            @include('alert')
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        Echo.channel('{{ \App\My::ROW_IMPORT_PROGRESS_CHANNEL }}.{{ config('app.user_id') }}')
            .listen('{{ RowImportProgressEvent::class }}', (e) => {
                console.log(e.message);
                document.getElementById('row-import-progress').innerHTML += `<li class="list-group-item list-group-item-success">${e.message}</li>`;
            });

        Echo.channel('{{ \App\My::ROW_IMPORT_ERROR_CHANNEL }}.{{ config('app.user_id') }}')
            .listen('{{ RowImportErrorEvent::class }}', (e) => {
                console.log('sdafasfd');
                console.log(e.errors);
                //document.getElementById('row-import-errors').innerHTML += `<li class="list-group-item list-group-item-success">${e.message}</li>`;
            });
    </script>
@endpush
