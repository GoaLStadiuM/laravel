@extends('www.layouts.web')

@section('title', 'Clasificaciones')

@section('page-styles')
    <link rel="stylesheet" href='{{ asset("css/tabs2.css") }}'>
@endsection

@section('content')
    <!-- breadcrumb-area -->
    @component('www.components.breadcrumbs')
        @slot('title') Clasficiaciones @endslot
        @slot('name') Rankings @endslot
    @endcomponent
    <!-- breadcrumb-area-end -->

    <!-- tables -->
    @include('www.rankings.partials.tables')
    <!-- tables-end -->
@endsection

@section('page-scripts')
    <script src="{{ asset('js/tabs.js') }}"></script>
@endsection
