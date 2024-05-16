@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.app')
@section('content')
    @php
        $title = "Saldo";
    $user = Auth::user();
    @endphp
    @include('components.breadcrumb',['title'=>$title])



    <div class="sm:col-span-12  md:col-span-12 lg:col-span-8 xl:col-span-6 xl:col-start-4 ">
        <div
            class="bg-white dark:bg-gray-900 border border-slate-200 dark:border-slate-700/40  rounded-md w-full relative mb-4">
            <div class="border-b border-slate-200 dark:border-slate-700/40 py-3 px-4 dark:text-slate-300/70">
                <div class="flex-none md:flex  justify-between">
                    <h4 class="font-medium text-lg flex-1 self-center mb-2 md:mb-0">List {{$title}}</h4>
                    @if($user->roles == 'cabang')
                        <button type="button" id="addModal"
                                class="inline-block focus:outline-none text-slate-500 hover:bg-slate-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-slate-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-slate-500  text-sm font-medium py-1 px-3 rounded ">
                            Tambah Saldo
                        </button>
                    @endif
                    <button type="button" data-fc-type="modal" data-fc-target="modalstandard" id="buttonModal"
                            class="hidden inline-block focus:outline-none text-slate-500 hover:bg-slate-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-slate-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-slate-500  text-sm font-medium py-1 px-3 rounded ">
                        Tambah Saldo
                    </button>
                </div>
            </div>
            <div class="flex-auto p-4 ">
                <div class="mb-4 border-b border-gray-200 dark:border-slate-700" data-fc-type="tab">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" aria-label="Tabs"
                        id="tab_filter">
                    </ul>
                </div>
                @include('components.filter_table')
                @include('components.table',['url'=>route('saldo.index'),'theads'=>[
                    '#',
                    'Nama',
                    'Jumlah',
                    'Tipe',
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
                                id="staticBackdropLabel1">Tambah Saldo</h6>
                            <button type="button"
                                    class="box-content w-4 h-4 p-1 bg-slate-700/60 rounded-full text-slate-300 leading-4 text-xl close"
                                    aria-label="Close" data-fc-dismiss>&times;
                            </button>
                        </div>
                        <form id="_form_input" action="{{route('saldo.store')}}" method="post">
                            @csrf
                            <div class="mb-2">
                                <label for="category_id"
                                       class="font-medium text-sm text-slate-600 dark:text-slate-400">Type</label>
                                <select id="type" name="type"
                                        class="w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-[6.5px] focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                                    <option value="request">Request</option>
                                    <option value="widraw">Widraw</option>
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
                            <div class="mb-2" id="input-file">
                                <label for="email"
                                       class="font-medium text-sm text-slate-600 dark:text-slate-400">Bukti
                                    Pembayaran</label>
                                <input type="file" id="file" name="file"
                                       class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                       placeholder="Masukan Saldo">
                                <div class="text-red-500 text-xs italic" id="error-file"></div>
                            </div>
                            <div class="mb-2" id="show-file">
                                <img src="" width="100%" id="show">
                            </div>
                        </form>
                    </div>
                    <div
                        class="flex flex-wrap shrink-0 justify-end p-3  rounded-b border-t border-dashed dark:border-gray-700"
                        id="button-show">
                        <button
                            class="inline-block focus:outline-none text-red-500 hover:bg-red-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-red-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-red-500  text-sm font-medium py-1 px-3 rounded mr-1 close"
                            data-fc-dismiss>Batal
                        </button>
                        <button id="_save"
                                class="inline-block focus:outline-none text-green-500 hover:bg-green-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-green-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-green-500  text-sm font-medium py-1 px-3 rounded mr-1"
                        >Simpan
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
                    case "0":
                        statusClass = 'bg-gray-500 text-gray-700';
                        statusText = 'Pending';
                        break;

                    case "1":
                        statusClass = 'bg-blue-500 text-blue-700';
                        statusText = 'Sukses';
                        break;

                    default:
                        statusClass = 'bg-red-500 text-red-700';
                        statusText = 'Dibatalkan';
                        break;
                }
                // created_at to date idr
                item.created_at = new Date(item.created_at).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric',

                    hour: '2-digit',
                    minute: '2-digit',
                });

                //item.saldo to idr remove ,00
                item.saldo = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(item.saldo);
                html += `<tr class="bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700/40">
                <td class="p-3 text-sm font-medium dark:text-white border dark:border-slate-100">${rowIndex}</td>
                @if($user->roles == 'admin')<td class="p-3 text-sm font-medium dark:text-white border dark:border-slate-100">${item.account.name}</td> @endif
                <td class="p-3 text-sm font-medium dark:text-white border dark:border-slate-100">${item.saldo}</td>
                <td class="p-3 text-sm font-medium dark:text-white border dark:border-slate-100">${item.type}</td>
                <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 border dark:border-slate-700">${item.created_at}</td>
                <td class="p-3 text-sm border dark:border-slate-700"><span class="${statusClass} text-white text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full"> ${statusText}</span></td> <!-- Status dengan kelas dan teks -->
                <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 border dark:border-slate-700">
                @if($user->roles == 'admin')
                ${item.status == 0 ?
                    `<button type="button" data-type="approve" data-id="${item.id}" class="_btn_ py-1 px-3 text-sm font-medium text-green-900 bg-white rounded-l-lg border border-green-200 hover:bg-green-100 hover:text-green-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-white-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                    Approve
                </button>
                <button type="button" data-type="reject" data-id="${item.id}" class="_btn_ py-1 px-3 -mx-1 text-sm font-medium text-red-900 bg-white border-t border-b border-red-200 hover:bg-red-100 hover:text-white-700 focus:z-10 focus:ring-2 focus:ring-red-700 focus:text-red-700 dark:bg-red-700 dark:border-red-600 dark:text-white dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-500 dark:focus:text-white">
                    Reject
                </button>` :
                    ``
                }
                <button type="button" data-fc-type="modal" data-fc-target="modalstandard" id="buttonModal"
                            data-type="${item.type}" data-id="${item.id}" data-saldo="${item.saldo}" data-photo="${item.bukti}"
                            class="_detail py-1 px-3 text-sm font-medium text-gray-900 bg-white rounded-r-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                        Detail
                 </button>
                @else
                <button type="button" data-fc-type="modal" data-fc-target="modalstandard" id="buttonModal"
                        data-type="${item.type}" data-id="${item.id}" data-saldo="${item.saldo}"
                            class="_edit ${item.status == 0 ? "" : "hidden"}
                            py-1 px-3 text-sm font-medium text-gray-900 bg-white rounded-r-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                        Upload Bukti Pembayaran
                </button>
                <button type="button" data-fc-type="modal" data-fc-target="modalstandard" id="buttonModal"
                            data-type="${item.type}" data-id="${item.id}" data-saldo="${item.saldo}" data-photo="${item.bukti}"
                            class="_detail py-1 px-3 text-sm font-medium text-gray-900 bg-white rounded-r-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                        Detail
                </button>
                @endif
                </td>
                </tr>`;
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

                // add event edit
                $('._edit').on('click', function () {
                    //open modal
                    $('#buttonModal').trigger('click');
                    const itemId = $(this).data('id');
                    let saldoStr = $(this).data('saldo'); // Get the saldo as a string
                    saldoStr = saldoStr.replace(/[^\d]/g, ''); // Remove non-numeric characters
                    const saldo = parseFloat(saldoStr);

                    const url = "{{route('saldo.update', ':id')}}".replace(':id', itemId);
                    $('#_title_modal').text('Edit {{$title}}');
                    $('#_form_input').attr('action', url);
                    $('#_form_input').append('<input type="hidden" name="_method" value="PUT">');
                    $('#saldo').val(saldo);
                    $('#saldo').attr('readonly', true);
                    $('#type').val($(this).data('type'));
                    $('#type').attr('readonly', true);
                    $('.italic').html('');
                    $('#input-file').show();
                    $('#show-file').hide();
                    $('#button-show').show();
                    $('#_save').attr('disabled', false)

                });

                // _detail
                $('._detail').on('click', function () {
                    //open modal
                    $('#buttonModal').trigger('click');
                    let saldoStr = $(this).data('saldo');
                    saldoStr = saldoStr.replace(/[^\d]/g, '');
                    const saldo = parseFloat(saldoStr);

                    $('#_title_modal').text('Edit {{$title}}');
                    $('#saldo').val(saldo);
                    $('#saldo').attr('readonly', true);
                    $('#type').val($(this).data('type'));
                    $('#type').attr('readonly', true);
                    $('.italic').html('');
                    $('#input-file').hide();
                    $('#show-file').show();
                    $('#button-show').hide();
                    $('#_save').attr('disabled', true)
                    $('#show').attr('src', `{{asset('upload')}}/${$(this).data('photo')}`);
                });
            });
        }

        $('#per_page, #search').on('change keyup', function () {
            getData();
        });

        getData();

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

        //saldo just number
        $('#saldo').on('keyup', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        //addModal
        $('#addModal').on('click', function () {
            $('#buttonModal').trigger('click');
            $('#_title_modal').text('Tambah {{$title}}');
            $('#_form_input').trigger('reset');
            $('#_form_input').attr('action', $('#_table-data').data('url'));
            $('#_form_input input[name="_method"]').remove();
            $('#saldo').attr('readonly', false);
            $('#type').attr('readonly', false);
            $('#input-file').show();
            $('#show-file').hide();
            $('#button-show').show();
            $('#_save').attr('disabled', false)

        });

        @if($user->roles == "cabang")
        $('#Nama').remove()
        @endif

        @if($user->roles == "admin")
        $('#_table-data').on('click', '._btn_', function () {
            const type = $(this).data('type');
            const id = $(this).data('id');

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang udah di " + type + " tidak bisa diubah lagi!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, " + type + "!",
            }).then((result) => {
                if (result.isConfirmed) {
                    const url = "{{route('saldo.update', ':id')}}".replace(':id', id);
                    const method = 'PUT';
                    $.post(url, {
                        _method: method,
                        type: type
                    }, function (data) {
                        getData();
                        Swal.fire(
                            'Berhasil!',
                            'Data berhasil di' + type,
                            'success'
                        );
                    });
                }
            });
        });
        @endif

    </script>
@endpush
