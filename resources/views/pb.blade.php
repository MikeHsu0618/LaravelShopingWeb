@extends('layouts.app')

@section('content')

<h1>Progress bar {{ $ver }} level {{ $level }}</h1>

@endsection

@section('inline_js')
    @parent
@endsection