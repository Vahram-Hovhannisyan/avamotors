@if(session('success'))
    <div class="flash-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="flash-error">{{ session('error') }}</div>
@endif

@if($errors->has('error'))
    <div class="flash-error">{{ $errors->first('error') }}</div>
@endif
