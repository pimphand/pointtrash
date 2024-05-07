@extends('layouts.app')
@section('content')
    @php
        $title = 'Order';
            $share_profits = [
                'for_user' => "User (%)",
                'for_company' =>"Perusahaan (%)",
                'for_partner' => "Mitra (%)"
            ];
    @endphp
    @include('components.breadcrumb',['title'=>$title ." ". str_replace('_',' ',Str::title($status))])
    <div class="sm:col-span-12  md:col-span-12 lg:col-span-8 xl:col-span-6 xl:col-start-4 ">
        <div
            class="bg-white dark:bg-gray-900 border border-slate-200 dark:border-slate-700/40  rounded-md w-full relative mb-4">
            <div class="border-b border-slate-200 dark:border-slate-700/40 py-3 px-4 dark:text-slate-300/70">
                <div class="flex-none md:flex  justify-between">
                    <h4 class="font-medium text-lg flex-1 self-center mb-2 md:mb-0">List {{$title}}</h4>
                    @if(request()->routeIs('orders.index') == 1)
                        <a href="{{route('users.export', 'pdf')}}"
                           class="px-2 py-1 lg:px-4 bg-transparent  text-primary text-sm  rounded transition hover:bg-primary-500 hover:text-white border border-primary font-medium"
                        >
                            Export PDF
                        </a>
                        <button type="button" data-fc-type="modal" data-fc-target="_modal_form"
                                class="_add_modal p-1 px-2 py-1 lg:px-4 bg-transparent  text-primary text-sm  rounded transition hover:bg-primary-500 hover:text-white border border-primary font-medium"
                        >
                            Share Profit
                        </button>
                        <a href="{{route('orders.history', $status)}}"
                           class="p-1 px-2 py-1 lg:px-4 bg-transparent  text-primary text-sm  rounded transition hover:bg-primary-500 hover:text-white border border-primary font-medium"
                        >
                            Riwayat
                        </a>
                    @else
                        <a href="{{route('orders.index', $status)}}"
                           class="p-1 px-2 py-1 lg:px-4 bg-transparent  text-primary text-sm  rounded transition hover:bg-primary-500 hover:text-white border border-primary font-medium"
                        >
                            {{str_replace('_',' ',Str::title($status))}} Masuk
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
                    'Perkiraan Berat',
                    'Tgl. Order',
                    'Status',
                    'Aksi'
                ]])
            </div>

            <div class="modal animate-ModalSlide hidden" id="_modal_form">
                <div class="relative w-auto pointer-events-none  sm:my-7 sm:mx-auto z-[99] lg:max-w-4xl">
                    <div
                        class="relative flex flex-col w-full pointer-events-auto bg-white dark:bg-slate-800 bg-clip-padding rounded">
                        <div
                            class="flex shrink-0 items-center justify-between py-2 px-4 rounded-t border-b border-solid dark:border-gray-700 bg-slate-800">
                            <h6 class="mb-0 leading-4 text-base font-semibold text-slate-300 mt-0"
                                id="_title_modal">Edit Share Profit {{str_replace('_',' ',Str::title($status))}}</h6>
                            <button type="button"
                                    class="box-content w-4 h-4 p-1 bg-slate-700/60 rounded-full text-slate-300 leading-4 text-xl close"
                                    aria-label="Close" data-fc-dismiss>&times;
                            </button>
                        </div>
                        <div class="relative flex-auto p-4 text-slate-600 dark:text-gray-300 leading-relaxed">
                            <form id="_form_input">
                                @csrf
                                @foreach($share_profits as $key => $share_profit)
                                    <div class="mb-2">
                                        <label for="email"
                                               class="font-medium text-sm text-slate-600 dark:text-slate-400">
                                            {{$share_profit}}
                                        </label>
                                        <input type="text" id="{{$key}}" name="{{$key}}"
                                               class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                               placeholder="Untuk {{$share_profit}}" value="">
                                        <div class="text-red-500 text-xs italic" id="error-{{$key}}"></div>
                                    </div>
                                @endforeach

                            </form>
                        </div>
                        <div
                            class="flex flex-wrap shrink-0 justify-end p-3  rounded-b border-t border-dashed dark:border-gray-700">
                            <button id="_close_modal"
                                    class="inline-block focus:outline-none text-red-500 hover:bg-red-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-red-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-red-500  text-sm font-medium py-1 px-3 rounded mr-1 close"
                                    data-fc-dismiss>Tutup
                            </button>
                            <button id="_save"
                                    class="inline-block focus:outline-none text-primary-500 hover:bg-primary-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-primary-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-primary-500  text-sm font-medium py-1 px-3 rounded">
                                Simpan
                            </button>
                        </div>
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

                    case 3:
                        statusClass = 'bg-grey-500 text-grey-700';
                        statusText = 'Dibatalkan';
                        break;

                    default:
                        statusClass = 'bg-red-500 text-red-700';
                        statusText = 'Diambil';
                        break;
                }
                //ubah tanggal ke indonesia
                const date = new Date(item.date_create);
                const options = {year: 'numeric', month: 'long', day: 'numeric'};
                item.date_create = date.toLocaleDateString('id-ID', options);

                html += `<tr class="bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700/40">
                    <td class="p-3 text-sm font-medium dark:text-white border dark:border-slate-100">${rowIndex}</td>
                    <td class="p-3 text-sm font-medium dark:text-white border dark:border-slate-100">${item.user.name}</td>
                    <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 border dark:border-slate-700">
                        ${item.weight} Kg
                    </td>
                    <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 border dark:border-slate-700 text-red">${item.date_create}</td>
                    <td class="p-3 text-sm border dark:border-slate-700"><span class="${statusClass} text-white text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full"> ${statusText}</span></td> <!-- Status dengan kelas dan teks -->
                    <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 border dark:border-slate-700">
                        <a href="{{request()->routeIs('orders.index') == 1 ? route('orders.index', $status) : route('orders.index', $status)}}/${item.order_id}" class="text-primary-500 hover:text-primary-700"><i class="fas fa-edit fa-1x"></i></a>
                        <button class="text-red-500 hover:text-danger-700 _delete" data-id="${item.order_id}"><i class="fas fa-trash fa-1x"></i></button>
                    </td>
                </tr>`;
            });

            return html;
        }

        let itemDataArray = [];

        function getData(page = 1) {
            const per_page = parseInt($('#per_page').val(), 10) || 15;
            const search = $('#search').val() || '';
            let status = $('#tab_filter button[aria-selected="true"]').data('status') || '';
            let newUrl = "{{request()->routeIs('orders.index') == 1 ? route('orders.index', $status) : route('orders.history', $status)}}";
            const url = newUrl + `?page=${page}&per_page=${per_page}&filter[status]=${status}&filter[search]=${search}`;
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

                //data
                let share_profit = data.share_profit;
                $('#for_user').val(share_profit.for_user);
                $('#for_company').val(share_profit.for_company);
                $('#for_partner').val(share_profit.for_partner);
            });
        }

        $('#per_page, #search').on('change keyup', function () {
            getData();
        });

        getData();

        function handleResponse(error, data) {
            if (error) {
                if (error.responseJSON && error.responseJSON.errors) {
                    // Mengiterasi kesalahan dan menampilkan pesan error
                    $.each(error.responseJSON.errors, function (key, value) {
                        // Menampilkan pesan error pada elemen HTML yang relevan
                        document.getElementById('error-' + key).innerHTML = value;

                        // Menambahkan event handler untuk menghapus error saat mengetik
                        $(`#${key}`).on('keyup', function () {
                            document.getElementById('error-' + key).innerHTML = '';
                        });
                    });
                }
            }
            if (data) {
                //triger click close modal
                $('#_close_modal').trigger('click');
                // Bersihkan form
                $('#_form_input').trigger('reset');
                getData();
                //swet alert
                Swal.fire(
                    'Berhasil!',
                    'Data berhasil disimpan',
                    'success'
                );
            }
        }

        $('#_save').on('click', function (e) {
            e.preventDefault();
            const url = "{{route('orders.updateShareProfit', $status)}}"; // URL untuk mengirim data
            const form = $('#_form_input'); // Mengambil elemen form
            const formData = new FormData(form[0]); // Membuat FormData dari form
            const method = 'POST';
            postData(url, method, formData, handleResponse);
        });

        $("._add_modal").click(function () {
            let id = "{{$status}}";
            if (id == "drop_off") {
                $('#for_partner').parent().remove();
            }

        });
    </script>
@endpush
