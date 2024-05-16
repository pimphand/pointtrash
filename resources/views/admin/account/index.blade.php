@extends('layouts.app')
@section('content')
    @php($title = 'Account')
    @include('components.breadcrumb',['title'=>$title])
    <div class="sm:col-span-12  md:col-span-12 lg:col-span-8 xl:col-span-6 xl:col-start-4 ">
        <div
            class="bg-white dark:bg-gray-900 border border-slate-200 dark:border-slate-700/40  rounded-md w-full relative mb-4">
            <div class="border-b border-slate-200 dark:border-slate-700/40 py-3 px-4 dark:text-slate-300/70">
                <div class="flex-none md:flex  justify-between">
                    <h4 class="font-medium text-lg flex-1 self-center mb-2 md:mb-0">List {{$title}}</h4>
                    <button type="button" data-fc-type="modal" data-fc-target="_modal_form"
                            class="_add_modal p-1 px-2 py-1 lg:px-4 bg-transparent  text-primary text-sm  rounded transition hover:bg-primary-500 hover:text-white border border-primary font-medium">
                        Tambah {{$title}}
                    </button>
                </div>
            </div>

            <div class="flex-auto p-4 ">
                <div class="mb-4 border-b border-gray-200 dark:border-slate-700" data-fc-type="tab">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" aria-label="Tabs" id="tab_filter">
                    </ul>
                </div>
                @include('components.filter_table')
                @include('components.table',['url'=>route('accounts.index'),'theads'=>[
                '#',
                'Nama',
                'Foto',
                'Email',
                'Status',
                "Saldo",
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
                                id="_title_modal"></h6>
                            <button type="button"
                                    class="box-content w-4 h-4 p-1 bg-slate-700/60 rounded-full text-slate-300 leading-4 text-xl close"
                                    aria-label="Close" data-fc-dismiss>&times;
                            </button>
                        </div>
                        <div class="relative flex-auto p-4 text-slate-600 dark:text-gray-300 leading-relaxed">
                            <form id="_form_input" action="" method="post">
                                @csrf
                                <div class="mb-2">
                                    <label for="email" class="font-medium text-sm text-slate-600 dark:text-slate-400">
                                        Nama User
                                    </label>
                                    <input type="text" id="name" name="name"
                                           class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                           placeholder="Masukan Nama User">
                                    <div class="text-red-500 text-xs italic" id="error-name"></div>
                                </div>
                                <div class="mb-2">
                                    <label for="email" class="font-medium text-sm text-slate-600 dark:text-slate-400">
                                        Username
                                    </label>
                                    <input type="text" id="username" name="username"
                                           class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                           placeholder="Masukan Username">
                                    <div class="text-red-500 text-xs italic" id="error-username"></div>
                                </div>
                                <div class="mb-2">
                                    <label for="category_id"
                                           class="font-medium text-sm text-slate-600 dark:text-slate-400">Role</label>
                                    <select id="roles" name="roles"
                                            class="w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-[6.5px] focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                                        <option value="cabang">Cabang</option>
                                        <option value="admin">Admin Pusat</option>
                                    </select>
                                    <div class="text-red-500 text-xs italic" id="error-roles"></div>
                                </div>
                                <div class="mb-2">
                                    <label for="email" class="font-medium text-sm text-slate-600 dark:text-slate-400">No.
                                        Telp</label>
                                    <input type="text" id="phone" name="phone"
                                           class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                           placeholder="Masukan No. Telp">
                                    <div class="text-red-500 text-xs italic" id="error-phone"></div>
                                </div>
                                <div class="mb-2">
                                    <label for="email"
                                           class="font-medium text-sm text-slate-600 dark:text-slate-400">Email</label>
                                    <input type="email" id="email" name="email"
                                           class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                           placeholder="Masukan Email">
                                    <div class="text-red-500 text-xs italic" id="error-email"></div>
                                </div>
                                <div class="mb-2">
                                    <label for="email"
                                           class="font-medium text-sm text-slate-600 dark:text-slate-400">Password</label>
                                    <input type="password" id="password" name="password"
                                           class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                           placeholder="Masukan Password">
                                    <div class="text-red-500 text-xs italic" id="error-password"></div>
                                </div>
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
            <div class="modal animate-ModalSlide hidden" id="_modal_saldo">
                <div class="relative w-auto pointer-events-none sm:max-w-lg sm:my-7 sm:mx-auto z-[99]">
                    <div
                        class="relative flex flex-col w-full pointer-events-auto bg-white dark:bg-slate-800 bg-clip-padding rounded">
                        <div
                            class="flex shrink-0 items-center justify-between py-2 px-4 rounded-t border-b border-solid dark:border-gray-700 bg-slate-800">
                            <h6 class="mb-0 leading-4 text-base font-semibold text-slate-300 mt-0"
                                id="staticBackdropLabel1">Saldo</h6>
                            <button type="button"
                                    class="box-content w-4 h-4 p-1 bg-slate-700/60 rounded-full text-slate-300 leading-4 text-xl close"
                                    aria-label="Close" data-fc-dismiss>&times;
                            </button>
                        </div>
                        <div class="relative flex-auto p-4 text-slate-600 dark:text-gray-300 leading-relaxed">
                            <form id="_form_input_saldo" action="" method="post">
                                @csrf
                                <div class="mb-2">
                                    <label for="category_id"
                                           class="font-medium text-sm text-slate-600 dark:text-slate-400">Type</label>
                                    <select id="debit" name="type"
                                            class="w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-[6.5px] focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                                        <option value="debit">Request</option>
                                        <option value="credit">Widraw</option>
                                    </select>
                                    <div class="text-red-500 text-xs italic" id="error-type"></div>
                                </div>
                                <div class="mb-2">
                                    <label for="email"
                                           class="font-medium text-sm text-slate-600 dark:text-slate-400">Saldo</label>
                                    <input type="text" id="saldo" name="saldo"
                                           class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                           placeholder="Masukan Saldo">
                                    <div class="text-red-500 text-xs italic" id="error-saldo"></div>
                                </div>
                                <div class="mb-2">
                                    <label for="message" class="font-medium text-sm text-slate-600 dark:text-slate-400">Deskripsi</label>
                                    <textarea id="description" rows="4" name="description"
                                              class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                              placeholder="Leave a comment..."></textarea>
                                    <div class="text-red-500 text-xs italic" id="error-description"></div>
                                </div>
                            </form>
                        </div>
                        <div
                            class="flex flex-wrap shrink-0 justify-end p-3  rounded-b border-t border-dashed dark:border-gray-700">
                            <button
                                class="inline-block focus:outline-none text-red-500 hover:bg-red-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-red-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-red-500  text-sm font-medium py-1 px-3 rounded mr-1 close"
                                data-fc-dismiss>Close
                            </button>
                            <button
                                id="_save_saldo"
                                class="inline-block focus:outline-none text-primary-500 hover:bg-primary-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-primary-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-primary-500  text-sm font-medium py-1 px-3 rounded">
                                Save
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
        //close modal
        $('.close').on('click', function () {
            $('#_modal_form').addClass('hidden').removeClass('animate-ModalSlideInTop');
            $('#_modal_saldo').addClass('hidden').removeClass('animate-ModalSlideInTop');
            $('.transition-all').addClass('hidden');
        });

        function buildTableRows(data, page, per_page) {
            const startIndex = (page - 1) * per_page;
            let html = '';

            data.forEach((item, index) => {
                const rowIndex = startIndex + index + 1;

                let statusClass;
                let statusText;

                switch (item.is_active) {
                    case 0:
                        statusClass = 'bg-gray-500 text-gray-700';
                        statusText = 'Non Aktif';
                        break;

                    case 1:
                        statusClass = 'bg-blue-500 text-blue-700';
                        statusText = 'Aktif';
                        break;
                }

                //saldo currency idr
                item.saldo = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(item.saldo);
                html += `<tr class="bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700/40">
                    <td class="p-3 text-sm font-medium dark:text-white border dark:border-slate-100">${rowIndex}</td>
                    <td class="p-3 text-sm font-medium dark:text-white border dark:border-slate-100">${item.name}</td>
                    <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 border dark:border-slate-700">
                        <img src="{{asset('upload')}}/${item.photo}" alt="" class="rounded mx-auto float-left" width="40%">
                    </td>
                    <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 border dark:border-slate-700">${item.email}</td>
                    <td class="p-3 text-sm border dark:border-slate-700"><span class="${statusClass} text-white text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full"> ${statusText}</span></td>
                    <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 border dark:border-slate-700" id="saldo_${item.account_id}">${item.saldo}</td>
                    <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 border dark:border-slate-700">
                        <button type="button"  data-fc-type="modal" data-fc-target="_modal_saldo" data-id="${item.account_id}"
                            class="_button_modal_saldo py-1 px-3 text-sm font-medium text-gray-900 bg-white rounded-l-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                            <i class="fas fa-money-bill-wave-alt"></i> Saldo
                        </button>
                        <a href="{{route('accounts.index')}}/${item.account_id}" data-id="${item.account_id}"
                            class="py-1 px-3 -mx-1 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                            <i class="fas fa-box-open "></i> Detail
                        </a>
                        <button type="button" class="py-1 px-3 text-sm font-medium text-gray-900 bg-white rounded-r-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white _delete" data-id="${item.account_id}">
                               <i class="fas fa-trash"></i> Hapus
                        </button>
                    </td>
                </tr>`;
            });

            return html;
        }

        let itemDataArray = [];

        function getData(page = 1) {
            const per_page = parseInt($('#per_page').val(), 10) || 15;
            const search = $('#search').val() || '';
            let status = $('#filter_new').find('#filter_roles').val() || '';

            const url = $('#_table-data').data('url') + `?page=${page}&per_page=${per_page}&filter[roles]=${status}&filter[search]=${search}`;
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

                // Tambahkan event listener untuk tombol edit
                $('._button_modal_saldo').on('click', function () {
                    $('#_title_modal').text('Edit {{$title}}');
                    //open modal
                    $('#_modal_saldo').addClass('animate-ModalSlideInTop').removeClass('hidden');
                    //transition-all
                    $('.transition-all').removeClass('hidden');
                    //get data from table
                    const itemId = $(this).data('id');
                    console.log(itemId);
                    // Set action form
                    $('#_form_input_saldo').attr('action', $('#_table-data').data('url') + `/saldo/${itemId}`);
                });

                $('._add_saldo').on('click', function () {
                    //this is for add saldo
                });
            });
        }

        // add event listener for filter tab
        $('#filter_new').on('change', '#filter_roles', function () {
            getData();
        });


        $('#per_page, #search').on('change keyup', function () {
            getData();
        });

        getData();

        $('._add_modal').on('click', function () {
            $('#_title_modal').text('Tambah {{$title}}');
            $('#_form_input').trigger('reset');
            $('#_form_input').attr('action', $('#_table-data').data('url'));
            $('#_form_input input[name="_method"]').remove();
        });

        $('#_table-data').on('click', '._delete', function () {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    const itemId = $(this).data('id');
                    const url = $('#_table-data').data('url') + `/${itemId}`;
                    postData(url, "Delete", {}, handleResponse);
                }
            });
        });

        $('#_save').on('click', function () {
            const form = $('#_form_input'); // Mengambil elemen form
            const formData = new FormData(form[0]); // Membuat FormData dari formœ
            const url = form.attr('action'); // Mengambil URL aksi dari atribut form
            const method = 'POST'; // Metode request, bisa diubah jika diperlukan
            // Panggil postData dengan callback handleResponse
            postData(url, method, formData, handleResponse); // Gunakan callback untuk penanganan
        });

        $('#_save_saldo').on('click', function () {
            const form = $('#_form_input_saldo'); // Mengambil elemen form
            const formData = new FormData(form[0]); // Membuat FormData dari formœ
            const url = form.attr('action'); // Mengambil URL aksi dari atribut form
            const method = 'POST'; // Metode request, bisa diubah jika diperlukan
            // Panggil postData dengan callback handleResponse
            postData(url, method, formData, handleResponse); // Gunakan callback untuk penanganan
        });

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
                // Muat ulang data

                getData();
                //swet alert
                Swal.fire(
                    'Berhasil!',
                    'Data berhasil disimpan',
                    'success'
                );
            }
        }

        $('#thumbnail').on('change', function () {
            const file = $(this).prop('files')[0];
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#_show_thumbnail').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        });

        //filter_new
        $('#filter_new').html(`
           <select id="filter_roles"
                class="w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-[6.5px] focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                <option value="">Semua</option>
                <option value="admin">Admin</option>
                <option value="cabang">Cabang</option>
            </select>
        `);

        //saldo only number
        $('#saldo').on('keypress', function (e) {
            if (e.which !== 8 && e.which !== 0 && e.which < 48 || e.which > 57) {
                return false;
            }
        });
    </script>
@endpush
