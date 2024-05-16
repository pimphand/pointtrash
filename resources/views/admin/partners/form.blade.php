@extends('layouts.app')
@section('content')
    @php
        $title = 'Mitra';
    @endphp
    @include('components.breadcrumb',['title'=>$title])
    <div class="sm:col-span-12  md:col-span-12 lg:col-span-8 xl:col-span-6 xl:col-start-4 ">
        <div
            class="bg-white dark:bg-gray-900 border border-slate-200 dark:border-slate-700/40  rounded-md w-full relative mb-4">
            <form action="{{route('partners.store')}}" id="form" method="post" enctype="multipart/form-data">
                @csrf

                <input
                    type="text"
                    id="partner_id"
                    name="partner_id" hidden
                    class="form-input w-full rounded-md mt-1 border border-slate-300 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500"
                    placeholder="Masukkan Nama Mitra"
                >
                <div class="flex-auto p-4 row grid-cols-1gap-4">
                    <div class="container mx-auto px-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="p-1 mb-1">
                                <label for="name"
                                       class="block font-medium text-sm text-slate-600 dark:text-slate-400">
                                    Nama Mitra
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Nama Mitra"
                                    required>
                                <div class="text-xs text-red-500 mt-1" id="error-name"></div>
                            </div>
                            <div class="p-1 mb-1">
                                <label for="gender"
                                       class="block font-medium text-sm text-slate-600 dark:text-slate-400">
                                    Jenis Kelamin
                                </label>
                                <select id="gender" name="gender"
                                        class="w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-[6.5px] focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                                    <option value="" selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki - Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>

                                <div class="text-xs text-red-500 mt-1" id="error-gender"></div>
                            </div>
                            <div class="p-1 mb-1">
                                <label for="phone"
                                       class="block font-medium text-sm text-slate-600 dark:text-slate-400">
                                    Nomor Telepon
                                </label>
                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Nomor Telepon"
                                    required>
                                <div class="text-xs text-red-500 mt-1" id="error-phone"></div>
                            </div>
                            <div class="p-1 mb-1">
                                <label for="email"
                                       class="block font-medium text-sm text-slate-600 dark:text-slate-400">
                                    Alamat Email
                                </label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Alamat Email"
                                    required>
                                <div class="text-xs text-red-500 mt-1" id="error-email"></div>
                            </div>
                            {{--                            <div class="p-1 mb-1">--}}
                            {{--                                <label for="password"--}}
                            {{--                                       class="block font-medium text-sm text-slate-600 dark:text-slate-400">--}}
                            {{--                                    Kata Sandi--}}
                            {{--                                </label>--}}
                            {{--                                <input--}}
                            {{--                                    type="password"--}}
                            {{--                                    id="password"--}}
                            {{--                                    name="password"--}}
                            {{--                                    class="form-input w-full rounded-md mt-1 border border-slate-300 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500"--}}
                            {{--                                    placeholder="Masukkan Kata Sandi" {{isset($partner) ? '' : 'required'}}--}}
                            {{--                                >--}}
                            {{--                                <div class="text-xs text-red-500 mt-1" id="error-password"></div>--}}
                            {{--                            </div>--}}
                            <div class="p-1 mb-1">
                                <label for="provinces"
                                       class="block font-medium text-sm text-slate-600 dark:text-slate-400">
                                    Provinsi
                                </label>
                                <input
                                    type="text"
                                    id="provinces"
                                    name="provinces"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Provinsi"
                                >
                                <div class="text-xs text-red-500 mt-1" id="error-provinces"></div>
                            </div>
                            <div class="p-1 mb-1">
                                <label for="regencies"
                                       class="block font-medium text-sm text-slate-600 dark:text-slate-400">
                                    Kabupaten/Kota
                                </label>
                                <input
                                    type="text"
                                    id="regencies"
                                    name="regencies"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Kabupaten/Kota"
                                    required>
                                <div class="text-xs text-red-500 mt-1" id="error-regencies"></div>
                            </div>
                            <div class="p-1 mb-1">
                                <label for="districts"
                                       class="block font-medium text-sm text-slate-600 dark:text-slate-400">
                                    Kecamatan
                                </label>
                                <input
                                    type="text"
                                    id="districts"
                                    name="districts"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Kecamatan"
                                    required>
                                <div class="text-xs text-red-500 mt-1" id="error-districts"></div>
                            </div>
                            <div class="p-1 mb-1">
                                <label for="villages"
                                       class="block font-medium text-sm text-slate-600 dark:text-slate-400">
                                    Desa/Kelurahan
                                </label>
                                <input
                                    type="text"
                                    id="villages"
                                    name="villages"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Desa/Kelurahan"
                                    required>
                                <div class="text-xs text-red-500 mt-1" id="error-villages"></div>
                            </div>
                            <div class="p-1 mb-1">
                                <label for="trans_number"
                                       class="block font-medium text-sm text-slate-600 dark:text-slate-400">
                                    No. Kendaraan
                                </label>
                                <input
                                    type="text"
                                    id="trans_number"
                                    name="trans_number"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan No. Kendaraan"
                                    required>
                                <div class="text-xs text-red-500 mt-1" id="error-trans_number"></div>
                            </div>
                            <div class="p-1 mb-1 ">
                                <label for="trans_info"
                                       class="block font-medium text-sm text-slate-600 dark:text-slate-400">
                                    Info Kendaraan
                                </label>
                                <input
                                    type="text"
                                    id="trans_info"
                                    name="trans_info"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Info Kendaraan"
                                    required>
                                <div class="text-xs text-red-500 mt-1" id="error-trans_info"></div>
                            </div>
                            <div class="p-1 mb-1">
                                <label for="address"
                                       class="block font-medium text-sm text-slate-600 dark:text-slate-400">
                                    Alamat
                                </label>
                                <textarea
                                    type="text"
                                    id="address"
                                    name="address"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Alamat"
                                    required></textarea>
                                <div class="text-xs text-red-500 mt-1" id="error-address"></div>
                            </div>
                            <div class="p-1 mb-1">
                                <label for="photo"
                                       class="block font-medium text-sm text-slate-600 dark:text-slate-400">
                                    Foto
                                </label>
                                <img src="http://pointtrash.test/images/logo.png" width="50%" id="_photo">
                                <input
                                    type="file"
                                    id="photo"
                                    name="photo"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Foto"
                                    {{isset($partner) ? '' : 'required'}}>
                                <div class="text-xs text-red-500 mt-1" id="error-photo"></div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="save"
                            class="inline-block focus:outline-none text-primary-500 hover:bg-primary-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-primary-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-primary-500  text-sm font-medium py-1 px-3 rounded mb-1">
                        Submit
                    </button>
                    <button type="button"
                            class="inline-block focus:outline-none text-red-600 hover:bg-red-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-red-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-red-500  text-sm font-medium py-1 px-3 rounded mb-1">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    @if(isset($partner))
        <script>
            $(document).ready(function () {
                let partners = @json($partner);

                $.each(partners, function (key, value) {
                    if (value === null) {
                        value = '';
                    }

                    let $element = $("#" + key); // Cache elemen dengan jQuery

                    if ($element.length === 0) {
                        return;
                    }

                    if (key === "photo") {
                        let imageUrl = "{{asset('upload')}}" + "/" + value;
                        $("#_" + key).attr('src', imageUrl);
                    } else {
                        $element.val(value); // Mengatur nilai input
                    }
                    $('#password').val('');
                });

            });
        </script>
    @endif
    <script>
        $("#save").click(function (e) {
            e.preventDefault();
            let formData = new FormData($('#form')[0]);
            $.ajax({
                url: "{{route('partners.store')}}",
                type: 'POST',
                data: formData,
                success: function (data) {
                    //swal button
                    Swal.fire({
                        title: "Success",
                        text: "Data berhasil disimpan",
                        icon: "success",
                        button: "OK",
                        //cant close alert with close icon
                        closeOnClickOutside: false,
                    }).then(function () {
                        window.location.href = "{{route('partners.index')}}";
                    });
                },
                error: function (data) {
                    $('.text-red-500').text('')
                    let errors = data.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        $("#error-" + key).text(value);
                    });
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    </script>
@endpush
