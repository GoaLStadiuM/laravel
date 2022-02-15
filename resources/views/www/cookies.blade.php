@extends('www.layouts.web')

@section('title', 'Política de Cookies')

@section('content')
    <!-- breadcrumb-area -->
    @component('www.components.breadcrumbs')
        @slot('title') Política de <span>Cookies</span> @endslot
        @slot('name') Cookies @endslot
    @endcomponent
    <!-- breadcrumb-area-end -->

    <!-- TODO: cookies-text -->
    <!-- cookies-text-end -->
@endsection
