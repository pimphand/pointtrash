<!DOCTYPE html>
<html lang="en" class="scroll-smooth group" data-sidebar="brand" dir="ltr">
<head>
    <meta charset="utf-8"/>
    <title>Robotech - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta content="Tailwind Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="" name="Mannatthemes"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets')}}/images/favicon.ico"/>
    <!-- Css -->
    @vite('resources/assets/libs/icofont/icofont.min.css')
    @vite('resources/assets/libs/flatpickr/flatpickr.min.css')
    @vite('resources/assets/css/tailwind.min.css')

</head>

<body data-layout-mode="light" data-sidebar-size="default" data-theme-layout="vertical"
      class="bg-[#EEF0FC] dark:bg-gray-900">

<div class="relative flex flex-col justify-center min-h-screen overflow-hidden">
    @yield('content')
</div>


<!-- JAVASCRIPTS -->
<script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
@vite('resources/assets/libs/lucide/umd/lucide.min.js')
@vite('resources/assets/libs/simplebar/simplebar.min.js')
@vite('resources/assets/libs/flatpickr/flatpickr.min.js')
@vite('resources/assets/libs/@frostui/tailwindcss/frostui.js')
@vite('resources/assets/js/app.js')
<!-- JAVASCRIPTS -->

@stack('js')
</body>
</html>
