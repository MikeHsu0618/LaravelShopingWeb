@extends('layouts.app')

@section('content')

<h1>Home</h1>
<div>傳過來的token:{{$token}}</div>
<a href="download/03?token={{$token}}" download>Download</a>

@endsection

@section('inline_js')
    @parent
@endsection