<!DOCTYPE html>
<html lang="en">
{{-- head begin--}}
    @include('frontend.layout.head')
{{-- end head --}}
  <body>

    {{-- Header begin --}}
        @include('frontend.layout.header')
    {{-- Header end --}}

    @yield('content')

{{-- script begin --}}
    @include('frontend.layout.script')
{{-- script end  --}}
  </body>
</html>
