@extends('layouts.master')

@section('title', 'Clasificaciones')

@section('page-style')
    <link rel="stylesheet" href='{{asset("css/tabs2.css")}}'>
@stop

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

@section('page-script')
    <script src="{{ asset('js/tabs.js') }}"></script>
@endsection
