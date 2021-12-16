@extends('layouts.www')

@section('title') - {{ __('audits') }}@endsection

@section('content')
    @include('audits.partials.main')
@endsection
