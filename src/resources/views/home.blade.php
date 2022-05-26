@extends('layout')
@section('title', __('Homepage'))
@section('content')
    <div class="mx-2 me-sm-auto my-2">
        <a href="{{ route('upload.show') }}" class="btn btn-outline-primary text-uppercase">{{ __('Upload page') }}</a>
    </div>
@endsection
