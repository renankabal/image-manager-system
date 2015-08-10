@extends('master')


@section('content')
<div class="alert alert-error">
    <h2>An error has occurred!</h2>
</div>
<div class="alert alert-info">
    {{$errorMsg}}
</div>
@stop