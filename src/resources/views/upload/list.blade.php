@extends('layout')
@section('title', __('Import file'))
@section('content')
    <div class="container mt-3 mb-5">
        <div class="row">
            <div class="col">
                <h5 class="m-0 text-uppercase">{{ __('Rows') }}</h5>
            </div>
            <div class="col text-end">
                <a href="{{ route('upload.show') }}" class="btn btn-outline-secondary text-uppercase">{{ __('Back') }}</a>
            </div>
        </div>
        <hr>
        <table class="table table-borderless table-responsive table-striped table-hover">
            <thead>
            <th width="100">{{ __('ID') }}</th>
            <th>{{ __('Name') }}</th>
            <th width="150">{{ __('Date') }}</th>
            </thead>
            <tbody>
            @foreach($rows as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->date }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $rows->links('paginate') }}
    </div>
@endsection
