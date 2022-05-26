@if(session()->has('success-message'))
    <div class="alert alert-success" role="alert">{{ session('success-message') }}</div>
@endif

@if(session()->has('error-message'))
    <div class="alert alert-danger" role="alert">{{ session('error-message') }}</div>
@endif

@if($errors->any())
    <ul class="list-group">
        @foreach($errors->all() as $error)
            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
        @endforeach
    </ul>
@endif
