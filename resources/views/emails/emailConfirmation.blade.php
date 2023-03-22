@extends('layouts.publicLayout')
@section('content')
  @include('includes.header')
  <h2>Test Email</h2>
  <a href="{{$test_message}}">{{ $test_message }}</a>
@endsection