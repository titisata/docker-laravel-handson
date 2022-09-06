@extends('layouts.app')

@section('content')
<h1>{{ $name }}</h1>
<p>{!!nl2br(e($link->content))!!}</p>

@endsection
