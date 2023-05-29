@extends('layouts.admin')
@section('title')
Dasboard
@endsection
@section('content')
hello 
@endsection
@section('contentheader')
الرئيسية
@endsection

@section('contentheaderlink')
   <a href="{{ route('admin.dashboard') }}"> الرئيسية </a>
@endsection

@section('contentheaderactive')
    عرض
@endsection