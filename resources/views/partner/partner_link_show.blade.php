@extends('layouts.app')

@section('content')
<div class="container px-0">
    <div class="row justify-content-center" style="--bs-gutter-x: 0;">
        <div class="col-md-10 my-3">
            <h2>{{ $link->name }}</h2>
            <p class="">{!!nl2br(e($link->content))!!}</p>
        </div>
    </div>
</div>

@endsection
