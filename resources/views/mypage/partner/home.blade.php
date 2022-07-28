@extends('mypage.layouts.app')

@section('menu', 'home')
@section('content')
<h1>ようこそ {{ Auth::user()->name }} 様</h1>
@endsection
