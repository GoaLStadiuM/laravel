@extends('www.layouts.web')

@section('title', 'Aviso Legal')

@section('content')
    <!-- breadcrumb-area -->
    @component('www.components.breadcrumbs')
        @slot('title') Aviso <span>Legal</span> @endslot
        @slot('name') Legal @endslot
    @endcomponent
    <!-- breadcrumb-area-end -->

    <!-- TODO: cookies-text -->
    <!-- cookies-text-end -->
@endsection
