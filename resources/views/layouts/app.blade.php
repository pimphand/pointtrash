<!DOCTYPE html>
<html lang="en" class="scroll-smooth group" data-sidebar="brand" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>{{ env('APP_NAME') }} - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta content="Tailwind Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="Mannatthemes" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" />

    <!-- Css -->
    <!-- Main Css -->
    @vite('resources/assets/libs/icofont/icofont.min.css')
    @vite('resources/assets/libs/flatpickr/flatpickr.min.css')
    @vite('resources/assets/css/tailwind.min.css')

    @stack('css')
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
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    {{-- @vite('resources/assets/libs/lucide/umd/lucide.min.js') --}}
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite('resources/assets/libs/simplebar/simplebar.min.js')
    @vite('resources/assets/libs/flatpickr/flatpickr.min.js')
    @vite('resources/assets/libs/@frostui/tailwindcss/frostui.js')
    @vite('resources/assets/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            cache: false, // Menonaktifkan cache untuk permintaan AJAX
        });

        //logout
        $('#logout').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('logout') }}",
                type: "POST",
                contentType: false,
                processData: false,
                success: function (data) {
                    window.location.href = "{{ route('login') }}";
                },
                error: function (xhr, status, error) {
                    callback(xhr, null); // Panggil callback dengan error
                },
            });
        });


        function fetchData(url, page = 1, per_page = 15, search = '', method = 'GET', callback) {
            $.ajax({
                url: url,
                type: method,
                success: function (data) {
                    callback(data); // Panggil fungsi callback setelah data berhasil didapatkan
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }

        function postData(url, method = 'POST', formData, callback) {
            $.ajax({
                url: url,
                type: method,
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    callback(null, data); // Panggil fungsi callback setelah data berhasil didapatkan
                },
                error: function (xhr, status, error) {
                    callback(xhr, null); // Panggil callback dengan error
                },
            });
        }

        function buildPagination(data, pageWindow = 5) {
            // Calculate the start and end page
            let startPage = Math.max(data.current_page - Math.floor(pageWindow / 2), 1);
            let endPage = Math.min(startPage + pageWindow - 1, data.last_page);

            if (endPage - startPage < pageWindow - 1) {
                startPage = Math.max(endPage - pageWindow + 1, 1);
            }

            // Begin the pagination unordered list with the specified class
            let pagination = `<ul class="inline-flex -space-x-px list-inside my-2 py-2" id="_pagination">`;

            // "First Page" Button
            if (data.current_page > 1) {
                pagination += `<li><a href="javascript:void(0)" data-page="1" class="_pagination-link py-2 px-3 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover=text-white">First</a></li>`;
            } else {
                pagination += `<li><span class="py-2 px-3 text-gray-300 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700">First</span></li>`;
            }

            // "Previous" Button
            if (data.prev_page_url) {
                pagination += `<li><a href="javascript:void(0)" data-page="${data.current_page - 1}" class="_pagination-link py-2 px-3 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover=text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover=text-white">Previous</a></li>`;
            } else {
                pagination += `<li><span class="py-2 px-3 text-gray-300 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700">Previous</span></li>`;
            }

            // Page Numbers
            for (let i = startPage; i <= endPage; i++) {
                if (i === data.current_page) {
                    pagination += `<li><span aria-current="page" class="py-2 px-3 text-blue-600 bg-blue-50 border border-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:text-white">${i}</span></li>`;
                } else {
                    pagination += `<li><a href="javascript:void(0)" data-page="${i}" class="_pagination-link py-2 px-3 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover=text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover=text-white">${i}</a></li>`;
                }
            }

            // "Next" Button
            if (data.next_page_url) {
                pagination += `<li><a href="javascript:void(0)" data-page="${data.current_page + 1}" class="_pagination-link py-2 px-3 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover=text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark=text-gray-400 dark:hover:bg-gray-700 dark:hover=text-white">Next</a></li>`;
            } else {
                pagination += `<li><span class="py-2 px-3 text-gray-300 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700">Next</span></li>`;
            }

            // "Last Page" Button
            if (data.current_page < data.last_page) {
                pagination += `<li><a href="javascript:void(0)" data-page="${data.last_page}" class="_pagination-link py-2 px-3 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover=text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover=text-white">Last</a></li>`;
            } else {
                pagination += `<li><span class="py-2 px-3 text-gray-300 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700">Last</span></li>`;
            }

            // Close the unordered list
            pagination += `</ul>`;

            $('#_show_pagination_total').html(`<p class="dark:text-slate-400">Halaman ${data.current_page} dari ${data.last_page}, Total data: ${data.total}</p>`);
            return pagination;
        }

        function formatIndonesianDate(dateString) {
            const date = new Date(dateString);

            const day = date.getDate(); // Get the day
            const monthNames = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            const month = monthNames[date.getMonth()]; // Get the month
            const year = date.getFullYear(); // Get the year

            // Format the date like "30 April 2024"
            return `${day} ${month} ${year}`;
        }
    </script>
    @stack('js')
</body>

</html>