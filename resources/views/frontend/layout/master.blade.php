

{{-- head begin--}}
@extends('frontend.layout.head')

{{-- end head --}}
@section('childContent')

    {{-- Header begin --}}
        @include('frontend.layout.header')
    {{-- Header end --}}

    @yield('content')

@endsection
