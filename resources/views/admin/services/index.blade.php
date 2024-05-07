@extends('layouts.app')
@section('content')
    @include('components.breadcrumb',['title'=>'Layanan'])
    <div class="sm:col-span-12  md:col-span-12 lg:col-span-8 xl:col-span-6 xl:col-start-4 ">
        <div
            class="bg-white dark:bg-gray-900 border border-slate-200 dark:border-slate-700/40  rounded-md w-full relative mb-4">
            <div class="border-b border-slate-200 dark:border-slate-700/40 py-3 px-4 dark:text-slate-300/70">
                <div class="flex-none md:flex  justify-between">
                    <h4 class="font-medium text-lg flex-1 self-center mb-2 md:mb-0">Update Media Sosial</h4>
                    <button type="button" data-fc-type="modal" data-fc-target="_modal_form"
                            class="_add_modal px-2 py-1 lg:px-4 bg-transparent  text-primary text-sm  rounded transition hover:bg-primary-500 hover:text-white border border-primary font-medium"
                    >
                        Tambah Layanan
                    </button>
                </div>
            </div>

            <div class="flex-auto p-4 ">
                @include('components.filter_table')
                @include('components.table',['url'=>route('services.index'),'theads'=>[
                    '#',
                    'Nama Layanan',
                    'Deskripsi',
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
                                    <label for="email" class="font-medium text-sm text-slate-600 dark:text-slate-400">Nama
                                        Layanan</label>
                                    <input type="text" id="name" name="name"
                                           class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                           placeholder="Masukan Nama Layanan">
                                    <div class="text-red-500 text-xs italic" id="error-name"></div>
                                </div>
                                <div class="mb-2">
                                    <label for="password"
                                           class="font-medium text-sm text-slate-600 dark:text-slate-400">Icon
                                        Layanan <a href="https://fontawesome.com/v4/icons/" target="_blank"
                                                   class="text-xs italic "> list Icon</a></label>
                                    <input type="text" id="icon" name="icon"
                                           class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                           required placeholder="Masukan Icon">
                                    
                                    <div class="text-red-500 text-xs italic" id="error-icon"></div>

                                </div>
                                <div class="mb-2">
                                    <label for="Mobile_Number"
                                           class="font-medium text-sm text-slate-600 dark:text-slate-400">Deskripsi</label>
                                    <textarea type="text" id="description" name="description" style="height: 121px;"
                                              class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                              required></textarea>
                                    <div class="text-red-500 text-xs italic" id="error-description"></div>
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
                html += `<tr class="bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700/40">
                        <td class="p-3 text-sm font-medium dark:text-white border dark:border-slate-100">${rowIndex}</td>
                        <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 border dark:border-slate-700">${item.name}</td>
                        <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 border dark:border-slate-700">${item.description}</td>
                        <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 border dark:border-slate-700">
                            <button data-fc-type="modal" data-fc-target="_modal_form" data-id="${item.service_id}"class="_edit_modal text-primary-500 hover:text-primary-700"><i class="fas fa-edit fa-1x"></i></button>
                            <button class="text-red-500 hover:text-danger-700 _delete" data-id="${item.service_id}"><i class="fas fa-trash fa-1x"></i></button>
                        </td>
                    </tr>
                `;
            });

            return html;
        }

        let itemDataArray = [];

        function getData(page = 1) {
            const per_page = parseInt($('#per_page').val(), 10) || 15;
            const search = $('#search').val() || '';
            const url = $('#_table-data').data('url') + `?page=${page}&per_page=${per_page}&filter[search]=${search}`;
            fetchData(url, page, per_page, search, "get", function (data) {
                // Bangun tabel
                const tableRows = buildTableRows(data.data, page, per_page);
                $('#_table-data').html(tableRows);
                // Bangun pagination
                const pagination = buildPagination(data);
                $('#_pagination').html(pagination);

                // Tambahkan event listener untuk pagination
                $('._pagination-link').on('click', function (e) {
                    e.preventDefault();
                    const newPage = $(this).data('page');
                    getData(newPage); // Panggil ulang getData dengan halaman baru
                });
                itemDataArray = data.data; // Simpan data dalam array
                // Tambahkan event listener untuk tombol edit
                $('._edit_modal').on('click', function () {
                    $('#_title_modal').text('Edit Layanan');
                    //open modal
                    $('#_modal_form').addClass('animate-ModalSlideInTop').removeClass('hidden');
                    //transition-all
                    $('.transition-all').removeClass('hidden');
                    //get data from table
                    const itemId = $(this).data('id');
                    // Ambil data dari array berdasarkan ID
                    const itemData = itemDataArray.find(item => item.service_id === itemId);
                    $('#name').val(itemData.name);
                    $('#icon').val(itemData.icon);
                    $('#description').val(itemData.description);

                    //add method put
                    $('#_form_input').append('<input type="hidden" name="_method" value="put">');

                    // Set action form
                    $('#_form_input').attr('action', $('#_table-data').data('url') + `/${itemId}`);
                });
            });
        }

        $('#per_page, #search').on('change keyup', function () {
            getData();
        });

        getData();

        $('._add_modal').on('click', function () {
            $('#_title_modal').text('Tambah Layanan');
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
            const formData = new FormData(form[0]); // Membuat FormData dari form
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
                getData();
                //swet alert
                Swal.fire(
                    'Berhasil!',
                    'Data berhasil disimpan',
                    'success'
                );
            }
        }
    </script>
@endpush
