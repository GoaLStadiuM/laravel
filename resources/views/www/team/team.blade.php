@extends('www.layouts.web')

@section('title', 'Team')

@section('content')
    <!-- breadcrumb-area -->
    @component('www.components.breadcrumbs')
        @slot('title') Equipo GoaL StadiuM @endslot
        @slot('name') Team @endslot
    @endcomponent
    <!-- breadcrumb-area-end -->

    <!-- team-photo -->
    @include('www.team.partials.photo')
    <!-- team-photo-end -->

    <!-- team-members -->
    @include('www.team.partials.members')
    <!-- team-members-end -->

    <!-- brand-area -->
    @include('www.components.partners')
    <!-- brand-area-end -->
@endsection
