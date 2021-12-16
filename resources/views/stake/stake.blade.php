@extends('layouts.www')

@section('title') - {{ __('web.staking') }}@endsection

@section('content')
    @include('stake.partials.invest')
    @include('stake.partials.table')
@endsection
