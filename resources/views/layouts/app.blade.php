<!DOCTYPE html>
<html lang="en" class="scroll-smooth group" data-sidebar="brand" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>{{ env('APP_NAME') }} - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta content="Tailwind Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="Mannatthemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" />

    <!-- Css -->
    <!-- Main Css -->
    @vite('resources/assets/libs/icofont/icofont.min.css')
    @vite('resources/assets/libs/flatpickr/flatpickr.min.css')
    @vite('resources/assets/css/tailwind.min.css')

</head>

<body data-layout-mode="light" data-sidebar-size="default" data-theme-layout="vertical"
    class="bg-[#EEF0FC] dark:bg-gray-900">

    <!-- leftbar-tab-menu -->
    <x-sidebar></x-sidebar>
    <x-top></x-top>

    <div class="ltr:flex flex-1 rtl:flex-row-reverse">
        <div
            class="page-wrapper relative ltr:ml-auto rtl:mr-auto rtl:ml-0 w-[calc(100%-260px)] px-4 pt-[64px] duration-300">

            <!--end container-->
            <div class="xl:w-full  min-h-[calc(100vh-152px)] relative pb-14">
                @yield('content')
            </div>
            <x-footer></x-footer>
            <!--end container-->
        </div>
        <!--end page-wrapper-->
    </div>
    <!--end /div-->


    <!-- JAVASCRIPTS -->
    <!-- <div class="menu-overlay"></div> -->
    @vite('resources/assets/libs/lucide/umd/lucide.min.js')
    @vite('resources/assets/libs/simplebar/simplebar.min.js')
    @vite('resources/assets/libs/flatpickr/flatpickr.min.js')
    @vite('resources/assets/libs/@frostui/tailwindcss/frostui.js')
    {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    @vite('resources/assets/js/app.js')
    <!-- JAVASCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    @stack('js')
</body>

</html>