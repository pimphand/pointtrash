@extends('layouts.app')
@section('content')
    @php
        $title = '';
    @endphp
    @include('components.breadcrumb',['title'=>$title ." ". str_replace('_',' ',Str::title($status))])

    <button type="button" data-fc-type="modal" data-fc-target="modalstandard" id="buttonModal"
            class="hidden inline-block focus:outline-none text-slate-500 hover:bg-slate-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-slate-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-slate-500  text-sm font-medium py-1 px-3 rounded ">
        Standerd
    </button>

    <div class="sm:col-span-12  md:col-span-12 lg:col-span-8 xl:col-span-6 xl:col-start-4 ">
        <div
            class="bg-white dark:bg-gray-900 border border-slate-200 dark:border-slate-700/40  rounded-md w-full relative mb-4">
            <div class="border-b border-slate-200 dark:border-slate-700/40 py-3 px-4 dark:text-slate-300/70">
                <div class="flex-none md:flex  justify-between">
                    <h4 class="font-medium text-lg flex-1 self-center mb-2 md:mb-0">List {{$title}}</h4>
                    @if(request()->routeIs('widraws.index') == 1)
                        <a href="{{route('widraws.export', 'pdf')}}"
                           class="px-2 py-1 lg:px-4 bg-transparent  text-primary text-sm  rounded transition hover:bg-primary-500 hover:text-white border border-primary font-medium"
                        >
                            Export PDF
                        </a>
                        <a href="{{route('widraws.history', $status)}}?history=true"
                           class="p-1 px-2 py-1 lg:px-4 bg-transparent  text-primary text-sm  rounded transition hover:bg-primary-500 hover:text-white border border-primary font-medium"
                        >
                            Riwayat
                        </a>
                    @else
                        <a href="{{route('widraws.index', $status)}}"
                           class="p-1 px-2 py-1 lg:px-4 bg-transparent  text-red text-sm  rounded transition hover:bg-red-500 hover:text-white border border-red font-medium"
                        >
                            Kembali
                        </a>
                    @endif
                </div>
            </div>
            <div class="flex-auto p-4 ">
                <div class="mb-4 border-b border-gray-200 dark:border-slate-700" data-fc-type="tab">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" aria-label="Tabs"
                        id="tab_filter"></ul>

                </div>
                @include('components.filter_table')
                @include('components.table',['url'=>'','theads'=>[
                    '#',
                    'Nama',
                    'Tgl. Permintaan',
                    'Status',
                    'Aksi'
                ]])
            </div>
        </div>
        <div class="modal animate-ModalSlide hidden" id="modalstandard">
            <div class="relative w-auto pointer-events-none sm:max-w-lg sm:my-7 sm:mx-auto z-[99]">
                <div
                    class="relative flex flex-col w-full pointer-events-auto bg-white dark:bg-slate-800 bg-clip-padding rounded">
                    <div class="rounded-md w-full p-3 relative">
                        <div
                            class="flex shrink-0 items-center justify-between py-2 px-4 rounded-t border-b border-solid dark:border-gray-700 bg-slate-800">
                            <h6 class="mb-0 leading-4 text-base font-semibold text-slate-300 mt-0"
                                id="staticBackdropLabel1">Detail Widraw</h6>
                            <button type="button"
                                    class="box-content w-4 h-4 p-1 bg-slate-700/60 rounded-full text-slate-300 leading-4 text-xl close"
                                    aria-label="Close" data-fc-dismiss>&times;
                            </button>
                        </div>
                        <table class="w-full table-fixed">
                            <tbody>
                            <tr>
                                <td class="w-2/8 p-3 text-sm font-medium whitespace-nowrap">
                                    Tgl. Permintaan
                                </td>
                                <!-- 10% lebar untuk kolom kedua -->
                                <td class="w-1/10 p-1 text-sm text-gray-500 text-center whitespace-nowrap">
                                    :
                                </td>
                                <!-- 50% lebar untuk kolom ketiga -->
                                <td class="w-1/2 p-3 text-sm text-gray-500 whitespace-nowrap" id="date_request">
                                    12-12-2021
                                </td>
                            </tr>
                            <tr>
                                <td class="w-2/8 p-3 text-sm font-medium whitespace-nowrap">
                                    Nama User
                                </td>
                                <!-- 10% lebar untuk kolom kedua -->
                                <td class="w-1/10 p-1 text-sm text-gray-500 text-center whitespace-nowrap">
                                    :
                                </td>
                                <!-- 50% lebar untuk kolom ketiga -->
                                <td class="w-1/2 p-3 text-sm text-gray-500 whitespace-nowrap" id="name_user">
                                    12-12-2021
                                </td>
                            </tr>
                            <tr>
                                <td class="w-2/8 p-3 text-sm font-medium whitespace-nowrap">
                                    Point User
                                </td>
                                <!-- 10% lebar untuk kolom kedua -->
                                <td class="w-1/10 p-1 text-sm text-gray-500 text-center whitespace-nowrap">
                                    :
                                </td>
                                <!-- 50% lebar untuk kolom ketiga -->
                                <td class="w-1/2 p-3 text-sm text-gray-500 whitespace-nowrap" id="point_user">
                                    12-12-2021
                                </td>
                            </tr>
                            <tr>
                                <td class="w-2/8 p-3 text-sm font-medium whitespace-nowrap">
                                    Nominal Permintaan
                                </td>
                                <!-- 10% lebar untuk kolom kedua -->
                                <td class="w-1/10 p-1 text-sm text-gray-500 text-center whitespace-nowrap">
                                    :
                                </td>
                                <!-- 50% lebar untuk kolom ketiga -->
                                <td class="w-1/2 p-3 text-sm text-gray-500 whitespace-nowrap" id="nominal_request">
                                    12-12-2021
                                </td>
                            </tr>
                            <tr>
                                <td class="w-2/8 p-3 text-sm font-medium whitespace-nowrap">
                                    No. Telp
                                </td>
                                <!-- 10% lebar untuk kolom kedua -->
                                <td class="w-1/10 p-1 text-sm text-gray-500 text-center whitespace-nowrap">
                                    :
                                </td>
                                <!-- 50% lebar untuk kolom ketiga -->
                                <td class="w-1/2 p-3 text-sm text-gray-500 whitespace-nowrap" id="phone">
                                    12-12-2021
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="flex flex-wrap shrink-0 justify-end p-3  rounded-b border-t border-dashed dark:border-gray-700">
                        <button
                            class="inline-block focus:outline-none text-red-500 hover:bg-red-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-red-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-red-500  text-sm font-medium py-1 px-3 rounded mr-1 close"
                            data-fc-dismiss>Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('js')
    <script>

        function buildTableRows(data, page, per_page) {
            const startIndex = (page - 1) * per_page;
            let html = '';

            data.forEach((item, index) => {
                const rowIndex = startIndex + index + 1;

                let statusClass;
                let statusText;

                switch (item.status) {
                    case 0:
                        statusClass = 'bg-yellow-500 text-black-700';
                        statusText = 'Menunggu';
                        break;

                    case 1:
                        statusClass = 'bg-green-500 text-green-700';
                        statusText = 'Selesai';
                        break;

                    default:
                        statusClass = 'bg-red-500 text-red-700';
                        statusText = 'Batal';
                        break;
                }
                //ubah tanggal ke indonesia
                const date = new Date(item.date_request);
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: 'numeric', // Menambahkan jam
                    minute: 'numeric', // Menambahkan menit
                    second: 'numeric', // Menambahkan detik (opsional, dapat dihapus jika tidak dibutuhkan)
                    hour12: false, // Menampilkan waktu dalam format 24 jam
                };
                // Mengubah format tanggal dan waktu ke bahasa Indonesia
                let formattedDate = date.toLocaleString('id-ID', options);
                formattedDate = formattedDate.replace(' pukul ', ' - ')
                item.date_request = formattedDate;

                html += `<tr class="bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700/40">
                    <td class="p-3 text-sm font-medium dark:text-white border dark:border-slate-100">${rowIndex}</td>
                    <td class="p-3 text-sm font-medium dark:text-white border dark:border-slate-100">${item.user.name}</td>

                    <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 border dark:border-slate-700 text-red">${item.date_request}</td>
                    <td class="p-3 text-sm border dark:border-slate-700"><span class="${statusClass} text-white text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full"> ${statusText}</span></td> <!-- Status dengan kelas dan teks -->
                    <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 border dark:border-slate-700">
                        <button  type="button" data-fc-type="modal" data-fc-target="modalstandard" class="_show_modal px-2 py-1 lg:px-4 bg-transparent  text-primary text-sm  rounded transition hover:bg-primary-600 hover:text-white border border-primary font-medium" data-id="${item.widraw_id}"><i class="fas fa-edit fa-1x"></i> Detail</button>
                        <button data-type="Approve" type="button" data-id="${item.widraw_id}" class="approve px-2 py-1 lg:px-4 bg-transparent  text-green text-sm  rounded transition hover:bg-green-600 hover:text-white border border-green font-medium {{request()->get('history')? "hidden" : ""}}"><i class="fas fa-check fa-1x"></i>Approve</button>
                        <button data-type="Batal" class="px-2 py-1 lg:px-4 bg-transparent  text-red text-sm  rounded transition hover:bg-red-600 hover:text-white border border-red font-medium approve" data-id="${item.widraw_id}"><i class="fas fa-trash fa-1x"></i>Batal</button>
                    </td>
                </tr>`;
            });

            return html;
        }

        let itemDataArray = [];

        function isCurrencyFormatted(value) {
            return typeof value === 'string' && value.includes('Rp'); // 'Rp' untuk mata uang IDR
        }

        function getData(page = 1) {
            const per_page = parseInt($('#per_page').val(), 10) || 15;
            const search = $('#search').val() || '';
            let status = $('#tab_filter button[aria-selected="true"]').data('status') || '';
            let newUrl = "{{request()->routeIs('widraws.index') == 1 ? route('widraws.index', $status) : route('widraws.history', $status)}}";


            const url = newUrl + `?page=${page}&per_page=${per_page}&filter[status]=${status}&filter[search]=${search}&history={{request()->get('history')}}`;
            fetchData(url, page, per_page, search, "get", function (data) {
                // Bangun tabel
                const tableRows = buildTableRows(data.data.data, page, per_page);
                $('#_table-data').html(tableRows);
                // Bangun pagination
                const pagination = buildPagination(data.data);
                $('#_pagination').html(pagination);

                // Tambahkan event listener untuk pagination
                $('._pagination-link').on('click', function (e) {
                    e.preventDefault();
                    const newPage = $(this).data('page');
                    getData(newPage); // Panggil ulang getData dengan halaman baru
                });
                itemDataArray = data.data.data; // Simpan data dalam array
                $('#_table-data').on('click', '._show_modal', function () {
                    const itemId = $(this).data('id');
                    const itemData = itemDataArray.find(item => item.widraw_id === itemId);

                    // Format nominal jika belum diformat
                    if (!isCurrencyFormatted(itemData.nominal)) {
                        itemData.nominal = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(itemData.nominal);
                    }

                    // Format user.point jika belum diformat
                    if (!isCurrencyFormatted(itemData.user.point)) {
                        itemData.user.point = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(itemData.user.point);
                    }

                    $('#date_request').text(itemData.date_request);
                    $('#name_user').text(itemData.user.name);
                    $('#point_user').text(itemData.user.point);
                    $('#nominal_request').text(itemData.nominal);
                    $('#phone').text(itemData.phone);
                    $('#buttonModal').trigger('click');

                });
            });
        }

        $('#per_page, #search').on('change keyup', function () {
            getData();
        });

        getData();

        function handleResponse(error, data) {
            if (error) {
                Swal.fire(
                    'Berhasil!',
                    data.messages,
                    'success'
                );
            }
            if (data) {
                getData();
                //swet alert
                Swal.fire(
                    'Berhasil!',
                    data.messages,
                    'success'
                );
            }
        }

        $('#_table-data').on('click', '.approve', function () {
            let title = $(this).data('type');
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: `Data yang sudah ${title} tidak bisa diubah lagi!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: `Ya, ${title}!`,
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    const itemId = $(this).data('id');

                    url = "{{route('widraws.approve', ['type' => 'user', 'status' => ':title', 'id' => ':id'])}}";

                    const newUrl = url.replace(':id', itemId).replace(':title', title)

                    postData(newUrl, "post", {'_token': "{{csrf_token()}}"}, handleResponse);
                }
            });
        });
    </script>
@endpush
