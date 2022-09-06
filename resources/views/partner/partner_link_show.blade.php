@extends('layouts.app')

@section('content')
<div class="container px-0">
    <div class="row justify-content-center" style="--bs-gutter-x: 0;">
        <div class="col-md-10">
            <h1>{{ $link->name }}</h>
            <p class="fs-4">{!!nl2br(e($link->content))!!}</p>
        </div>
    </div>
</div>

@endsection
