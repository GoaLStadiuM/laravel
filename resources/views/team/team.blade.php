@extends('layouts.www')

@section('title') - {{ __('team') }}@endsection

@section('content')
    @include('team.partials.main')
    @include('team.partials.team')
@endsection
