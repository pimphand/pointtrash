@extends('layouts.app')
@section('content')
    @php($title = 'Detail User')
    @include('components.breadcrumb',['title'=> $title])
    <div class="xl:w-full  min-h-[calc(100vh-138px)] relative pb-14">
        <div class="grid grid-cols-12 sm:grid-cols-12 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4">
            <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-4 xl:col-span-3">
                <form action="{{route('users.update',$user->user_id)}}" id="_form_input">
                    @csrf
                    @method('PUT')
                    <div class="">
                        <div class="text-center">
                            <img src="{{asset('upload')."/".$user->photo}}" alt="" width="50%"
                                 class="rounded-full mx-auto inline-block">
                            <div class="my-4">
                                <h5 class="text-xxl font-semibold text-slate-700 dark:text-gray-400"
                                    id="_name">{{$user->name}}</h5>
                                <input type="text" id="name" name="name"
                                       class="hidden text-center form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                       placeholder="Search">
                                <div class="text-red-500 text-xs italic" id="error-name"></div>

                                <span class="block  font-medium text-slate-500"></span>
                            </div>
                        </div>
                        <div
                            class="grid grid-cols-12 sm:grid-cols-12 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4">
                            <div class="col-span-12 sm:col-span-12 md:col-span-5 text-end">
                                <span class="dark:text-slate-300">Email :</span>
                            </div><!--end col-->
                            <div class="col-span-12 sm:col-span-12 md:col-span-7">
                                <input type="email" id="email" name="email"
                                       class="hidden form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                       placeholder="Search">
                                <div class="text-red-500 text-xs italic" id="error-email"></div>

                                <span class="dark:text-slate-400" id="_email">{{$user->email}}</span>
                            </div><!--end col-->
                            <div class="col-span-12 sm:col-span-12 md:col-span-5 text-end">
                                <span class="dark:text-slate-300">No. Telp :</span>
                            </div><!--end col-->
                            <div class="col-span-12 sm:col-span-12 md:col-span-7">
                                <input type="text" id="phone" name="phone"
                                       class="hidden form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                       placeholder="Search">
                                <div class="text-red-500 text-xs italic" id="error-phone"></div>

                                <span class="dark:text-slate-400" id="_phone">{{$user->phone}}</span>
                            </div><!--end col-->
                            <div class="col-span-12 sm:col-span-12 md:col-span-5 text-end">
                                <span class="dark:text-slate-300">Tgl. Lahir :</span>
                            </div><!--end col-->
                            <div class="col-span-12 sm:col-span-12 md:col-span-7">
                                <input type="date" id="birth" name="birth"
                                       class="hidden form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                       placeholder="Search">
                                <div class="text-red-500 text-xs italic" id="error-birth"></div>

                                <span class="dark:text-slate-400" id="_birth">{{$user->birth}}</span>
                            </div><!--end col-->
                            <div class="col-span-12 sm:col-span-12 md:col-span-5 text-end">
                                <span class="dark:text-slate-300">Address :</span>
                            </div><!--end col-->
                            <div class="col-span-12 sm:col-span-12 md:col-span-7">
                            <textarea type="text" id="address" name="address" style="height: 134px;"
                                      class="hidden form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                      placeholder="Search"></textarea>
                                <div class="text-red-500 text-xs italic" id="error-address"></div>
                                <span class="dark:text-slate-400" id="_address">{{$user->address}}</span>
                            </div><!--end col-->
                        </div><!--end grid-->
                        <div
                            class="border-b border-dashed dark:border-slate-700/40 my-3 group-data-[sidebar=dark]:border-slate-700/40 group-data-[sidebar=brand]:border-slate-700/40"></div>
                        <div
                            class="grid grid-cols-12 sm:grid-cols-12 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4">
                            <div class="col-span-12 sm:col-span-12 md:col-span-5 text-end">
                                <span class="dark:text-slate-300">Tanggal Buat :</span>
                            </div><!--end col-->
                            <div class="col-span-12 sm:col-span-12 md:col-span-7">
                                <span class="dark:text-slate-400" id="_date_create">{{$user->date_create}}</span>
                            </div><!--end col-->
                            <div class="col-span-12 sm:col-span-12 md:col-span-5 text-end">
                                <span class="dark:text-slate-300">Terakhir Update :</span>
                            </div><!--end col-->
                            <div class="col-span-12 sm:col-span-12 md:col-span-7">
                                <span class="dark:text-slate-400" id="_date_update">{{$user->date_update}}</span>
                            </div><!--end col-->
                            <div class="col-span-12 sm:col-span-12 md:col-span-5 text-end">
                                <span class="dark:text-slate-300">Terakhir Login :</span>
                            </div><!--end col-->
                            <div class="col-span-12 sm:col-span-12 md:col-span-7">
                                <span class="dark:text-slate-400" id="_last_sign_in">{{$user->last_sign_in}}</span>
                            </div><!--end col-->
                            <div class="col-span-12 sm:col-span-12 md:col-span-12 text-center">
                                <button id="_edit" type="button"
                                        class="inline-block focus:outline-none text-primary-500 hover:bg-primary-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-primary-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-primary-500  text-sm font-medium py-1 px-3 rounded">
                                    <i
                                        class="fas fa-edit fa-2x"> </i>
                                    Edit
                                </button>
                                <button id="_cancel" type="button"
                                        class="hidden inline-block focus:outline-none text-red-500 hover:bg-red-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-red-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-danger-500  text-sm font-medium py-1 px-3 rounded">
                                    <i
                                        class="fas fa-times fa-2x"> </i>
                                    Batal
                                </button>
                                <button id="_save" type="button"
                                        class="hidden inline-block focus:outline-none text-green-500 hover:bg-green-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-green-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-success-500  text-sm font-medium py-1 px-3 rounded">
                                    <i
                                        class="fas fa-save fa-2x"> </i>
                                    Simpan
                                </button>
                            </div>
                        </div><!--end grid-->
                    </div>
                </form>
            </div><!--end col-->
            <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-9">
                <div class="grid  grid-cols-1 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-2 gap-4 p-4">
                    <div
                        class="bg-orange-500/5 dark:bg-pink-500/10 border border-dashed border-orange-500  rounded-md w-full relative ">
                        <div class="flex-auto p-4 text-center">

                                        <span
                                            class="inline-flex  justify-center items-center h-14 w-14 rounded-full bg-white dark:bg-gray-900 border border-dashed border-orange-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 data-lucide="shopping-cart"
                                                 class="lucide lucide-shopping-cart stroke-orange-500 text-3xl"><circle
                                                    cx="8" cy="21" r="1"></circle><circle cx="19" cy="21"
                                                                                          r="1"></circle><path
                                                    d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path></svg>
                                        </span>
                            <h4 class="my-1 font-semibold text-3xl dark:text-slate-200" id="_total_order">0</h4>
                            <h6 class="text-gray-800 dark:text-gray-400 text-lg mb-0 font-medium uppercase">Total
                                Order</h6>
                        </div><!--end card-body-->
                    </div> <!--end card-->
                    <div
                        class="bg-purple-500/5 dark:bg-cyan-500/5 border border-dashed border-purple-500  rounded-md w-full relative ">
                        <div class="flex-auto p-4 text-center">

                                        <span
                                            class="inline-flex  justify-center items-center h-14 w-14 rounded-full bg-white dark:bg-gray-900 border border-dashed border-purple-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 data-lucide="circle-dollar-sign"
                                                 class="lucide lucide-circle-dollar-sign stroke-purple-500 text-3xl"><circle
                                                    cx="12" cy="12" r="10"></circle><path
                                                    d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"></path><path
                                                    d="M12 18V6"></path></svg>
                                        </span>
                            <h4 class="my-1 font-semibold text-3xl dark:text-slate-200">
                                Rp. {{number_format($user->point)}}</h4>
                            <h6 class="text-gray-800 dark:text-gray-400 mb-0 text-lg font-medium uppercase">Point</h6>
                        </div><!--end card-body-->
                    </div> <!--end card-->
                </div>
                <div class="w-full relative mb-4">
                    <div class="flex-auto p-0 md:p-4">

                        <div id="myTabContent">
                            <div class="active  p-4 bg-gray-50 rounded-lg dark:bg-gray-700/20" id="orders"
                                 role="tabpanel" aria-labelledby="orders-tab">
                                <div class="grid grid-cols-1 p-0 md:p-4">
                                    <div class="sm:-mx-6 lg:-mx-8">
                                        <div class="relative overflow-x-auto block w-full sm:px-6 lg:px-8">
                                            @include('components.table',['url'=>route('users.data',$user->user_id),'theads'=>[
                                                '#',
                                                'Perkiraan Berat',
                                                'Foto',
                                                'Tanggal',
                                                'Status',
                                                'Aksi'
                                            ]])
                                        </div><!--end div-->
                                    </div><!--end div-->
                                </div><!--end grid-->
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->

            @if($user->latitude && $user->longitude)
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12" id="map">
                    <iframe width="100%" height="320"
                            src="https://maps.google.com/maps?q={{ $user->latitude }},{{ $user->longitude }}&hl=es;z=14&amp;output=embed"></iframe>
                </div>
            @endif
        </div> <!--end grid-->
        <!-- footer -->
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
                        statusClass = 'bg-gray-500 text-gray-700';
                        statusText = 'Menunggu';
                        break;

                    case 1:
                        statusClass = 'bg-blue-500 text-blue-700';
                        statusText = 'Selesai';
                        break;
                    case 3:
                        statusClass = 'bg-blue-500 text-blue-700';
                        statusText = 'Dibatalkan';
                        break;

                    default:
                        statusClass = 'bg-red-500 text-red-700';
                        statusText = 'Diambil';
                        break;
                }

                html += `<tr class=" bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700
            /40">
            <td class="p-3 text-sm font-medium dark:text-white border dark:border-slate-100">${rowIndex}</td>
            <td class="p-3 text-sm font-medium dark:text-white border dark:border-slate-100">${item.weight} Kg</td>
            <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 border dark:border-slate-700">
                <img src="{{asset('upload')}}/${item.photo}" alt="" class="rounded mx-auto float-left" width="40%">
            </td>
            <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 border dark:border-slate-700">
                Tanggal Order : ${formatIndonesianDate(item.date_create)} <br>
                Tanggal Pick Up : ${formatIndonesianDate(item.date_pick)}
            </td>
            <td class="p-3 text-sm border dark:border-slate-700"><span
                    class="${statusClass} text-white text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded-full"> ${statusText}</span>
            </td> <!-- Status dengan kelas dan teks -->
            <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400 border dark:border-slate-700">
                <a href="${$('#_table-data').data('url')}/${item.user_id}"
                   class="text-primary-500 hover:text-primary-700"><i class="fas fa-edit fa-1x"></i> Detail</a>
            </td>
            </tr>`;
            });

            return html;
        }

        function getData(page = 1) {
            const per_page = parseInt($('#per_page').val(), 5) || 5;
            const search = $('#search').val() || '';
            let status = $('#tab_filter button[aria-selected="true"]').data('status') || '';

            const url = $('#_table-data').data('url') +
                `?page=${page}&per_page=5&filter[status]=${status}&filter[search]=${search}`;
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
                $('#_total_order').text(data.data.total);
            });
        }

        $('#per_page, #search').on('change keyup', function () {
            getData();
        });

        getData();

        $('#_date_create').text(formatIndonesianDate($('#_date_create').text()))
        // if _date_update
        if ($('#_date_update').text() != '') {
            $('#_date_update').text(formatIndonesianDate($('#_date_update').text()));
        } else {
            $('#_date_update').text('-');
        }

        // if _last_sign_in
        if ($('#_last_sign_in').text() != '') {
            $('#_last_sign_in').text(formatIndonesianDate($('#_last_sign_in').text()));
        } else {
            $('#_last_sign_in').text('-');
        }

        // Edit
        $('#_edit').on('click', function () {
            $('#_edit').addClass('hidden');
            $('#_cancel').removeClass('hidden');
            $('#_save').removeClass('hidden');
            $('#name').removeClass('hidden').val($('#_name').text());
            $('#email').removeClass('hidden').val($('#_email').text());
            $('#phone').removeClass('hidden').val($('#_phone').text());
            $('#birth').removeClass('hidden').val($('#_birth').text());
            $('#address').removeClass('hidden').val($('#_address').text());

            $('#_email').addClass('hidden');
            $('#_phone').addClass('hidden');
            $('#_birth').addClass('hidden');
            $('#_address').addClass('hidden');
            $('#name').addClass('hidden');


        });

        // Cancel
        $('#_cancel').on('click', function () {
            $('#_edit').removeClass('hidden');
            $('#_cancel').addClass('hidden');
            $('#_save').addClass('hidden');
            $('#email').addClass('hidden');
            $('#phone').addClass('hidden');
            $('#birth').addClass('hidden');
            $('#address').addClass('hidden');

            $('#_email').removeClass('hidden');
            $('#_phone').removeClass('hidden');
            $('#_birth').removeClass('hidden');
            $('#_address').removeClass('hidden');
        });

        // Save
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
                        // add error div
                        // Menambahkan event handler untuk menghapus error saat mengetik
                        $(`#${key}`).on('keyup', function () {
                            document.getElementById('error-' + key).innerHTML = '';
                        });
                    });
                }
            }
            if (data) {
                $('#_edit').removeClass('hidden');
                $('#_cancel').addClass('hidden');
                $('#_save').addClass('hidden');
                $('#email').addClass('hidden');
                $('#phone').addClass('hidden');
                $('#birth').addClass('hidden');
                $('#name').addClass('hidden');
                $('#address').addClass('hidden');

                $('#_email').removeClass('hidden');
                $('#_phone').removeClass('hidden');
                $('#_birth').removeClass('hidden');
                $('#_address').removeClass('hidden');

                $('#_email').text(data.email);
                $('#_phone').text(data.phone);
                $('#_birth').text(data.birth);
                $('#_address').text(data.address);
                $('#_name').text(data.name);
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
