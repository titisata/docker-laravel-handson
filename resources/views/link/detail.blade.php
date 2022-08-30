@extends('layouts.app')

@section('content')
<h1>{{ $name }}</h1>
<p>{{ $link->content }}</p>
@endsection
