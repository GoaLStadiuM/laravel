@extends('www.layouts.web')

@section('title', 'Política de Privacidad')

@section('content')
    <!-- breadcrumb-area -->
    @component('www.components.breadcrumbs')
        @slot('title') Política de <span>Privacidad</span> @endslot
        @slot('name') Privacy @endslot
    @endcomponent
    <!-- breadcrumb-area-end -->

    <!-- TODO: privacy-text -->
    <!-- privacy-text-end -->
@endsection
