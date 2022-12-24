<!DOCTYPE html>
<html>
<head>
 @include('frontend.layouts.head')
 @stack('css')
</head>
<body>
@include('sweetalert::alert')

@include('frontend.layouts.header')
@yield('content')
@include('frontend.layouts.footer')
@include('frontend.layouts.modal')

@stack('scripts')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  </script>
</body>
</html>
