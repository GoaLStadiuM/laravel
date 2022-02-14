@extends('www.layouts.web')

@section('title', 'Colaboradores y Partners')

@section('content')
    <!-- breadcrumb-area -->
    @component('www.components.breadcrumbs')
        @slot('title') Partners & <span>Colaboradores</span> @endslot
        @slot('name') Collaborators @endslot
    @endcomponent
    <!-- breadcrumb-area-end -->

    <!-- collaborators -->
    @include('www.collaborators.partials.collaborators')
    <!-- collaborators-end -->

    <!-- tiktokers -->
    @include('www.collaborators.partials.tiktokers')
    <!-- tiktokers-end -->

    <!-- youtubers -->
    @include('www.collaborators.partials.youtubers')
    <!-- youtubers-end -->

    <!-- partners-area -->
    @include('www.components.partners')
    <!-- partners-area-end -->
@endsection
