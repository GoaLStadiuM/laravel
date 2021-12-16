@extends('layouts.www')

@section('title') - {{ __('web.partners') }}@endsection

@section('content')
    @include('partner.partials.main')
    @include('partner.partials.collaborators')
    @include('partner.partials.youtubers')
    @include('partner.partials.partners')
@endsection
