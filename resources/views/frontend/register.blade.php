<!DOCTYPE html>
<html lang="en" class="scroll-smooth group" data-sidebar="brand" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>Robotech - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta content="Tailwind Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="Mannatthemes" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets')}}/images/favicon.ico" />
    <!-- Css -->
    @vite('resources/assets/libs/icofont/icofont.min.css')
    @vite('resources/assets/libs/flatpickr/flatpickr.min.css')
    @vite('resources/assets/css/tailwind.min.css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .ui-autocomplete {
            max-height: 150px;
            /* Adjust the height as needed */
            overflow-y: auto;
            /* Enable vertical scrolling */
            overflow-x: hidden;
            /* Hide horizontal scrolling */
        }

        /* Optional: Add some padding and border for better appearance */
        .ui-menu-item {
            padding: 5px;
        }

        .ui-menu-item:hover {
            background-color: #f0f0f0;
            /* Highlight on hover */
        }
    </style>
</head>

<body data-layout-mode="light" data-sidebar-size="default" data-theme-layout="vertical"
    class="bg-[#EEF0FC] dark:bg-gray-900">

    <div class="relative flex flex-col justify-center min-h-screen overflow-hidden">
        <div class="w-full  m-auto bg-white dark:bg-slate-800/60 rounded shadow-lg ring-2 p-5"
            style="max-width:68rem !important">
            <!-- JS -->
            <h3 class="text-center text-[30px] font-bold mb-4 dark:text-slate-300">Pendaftaran Mitra Pointtrash</h3>
            <p class="text-center font-medium text-slate-400 text-[16px]">Silahkan lengkapi data</p>
            <form class=" block mt-5" id="demo-form">
                @csrf
                <ul class="w-full list-none flex p-0 justify-center mb-10">
                    <li
                        class="progress-bar-dot block w-3 h-3 rounded-full border-2 border-primary-500 cursor-pointer transition duration-150 ease-out bg-primary-500">
                    </li>
                    <li class="progress-bar-connector block bg-primary-500 rounded-full w-20 h-[1px] mt-[5.5px]"></li>
                    <li
                        class="progress-bar-dot block w-3 h-3 rounded-full border-2 border-primary-500 cursor-pointer transition duration-150 ease-out ">
                    </li>
                    <li class="progress-bar-connector block bg-primary-500 rounded-full w-20 h-[1px] mt-[5.5px]"></li>
                    <li
                        class="progress-bar-dot block w-3 h-3 rounded-full border-2 border-primary-500 cursor-pointer transition duration-150 ease-out">
                    </li>
                </ul>

                <div class="step step1">
                    <div class="grid md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 mb-4">
                        <div class="sm:col-span-12  md:col-span-12 lg:col-span-6 xl:col-span-6 ">
                            <div class="mb-2">
                                <label for="name" class="font-medium text-sm text-slate-600 dark:text-slate-400">Nama
                                    Lengkap
                                </label>
                                <input type="text" id="name" name="name" required placeholder="Nama Lengkap"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                                <div id="error_name" class="text-red"></div>
                            </div>
                            <div class="mb-2">
                                <label for="gender" class="font-medium text-sm text-slate-600 dark:text-slate-400">Jenis
                                    Kelamin</label>
                                <select id="gender" name="gender"
                                    class="w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-[6.5px] focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                                    <option value="">--Pilih Gender--</option>
                                    <option value="Laki - Laki">Laki - Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <div id="error_gender" class="text-red"></div>
                            </div>
                            <div class="mb-2">
                                <label for="phone" class="font-medium text-sm text-slate-600 dark:text-slate-400">No.
                                    Telp</label>
                                <input type="text" id="phone" name="phone" placeholder="08xxxxxxxxxx"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                                <div id="error_phone" class="text-red"></div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="sm:col-span-12  md:col-span-12 lg:col-span-6 xl:col-span-6 ">
                            <div class="mb-2">
                                <label for="Email" class="font-medium text-sm text-slate-600 dark:text-slate-400">
                                    Email
                                </label>
                                <input type="email" id="email" name="email" placeholder="masukkan email"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                                <div id="error_email" class="text-red"></div>
                            </div>
                            <div class="mb-2">
                                <label for="villages"
                                    class="font-medium text-sm text-slate-600 dark:text-slate-400">Pilih
                                    Desa/Kelurahan</label>

                                <input type="text" name="villages" id="villages" autocomplete="off"
                                    class="villages w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-[6.5px] focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                    placeholder="villages" />
                                <div id="error_villages" class="text-red"></div>
                            </div>
                            <div class="mb-2">
                                <label for="address" class="font-medium text-sm text-slate-600 dark:text-slate-400">
                                    Alamat Lengkap
                                </label>
                                <textarea id="address" name="address" rows="4"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                    placeholder="Masukan alamat lengkap"></textarea>
                                <div id="error_address" class="text-red"></div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end inner-grid-->
                </div>
                <!--end step1-->
                <div class="step step2 hidden">
                    <div class="grid md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 mb-4">
                        <div class="sm:col-span-12  md:col-span-12 lg:col-span-6 xl:col-span-6 ">
                            <div class="mb-2">
                                <img src="" alt="" id="img_kk">
                                <label for="kk"
                                    class="font-medium text-sm text-slate-600 dark:text-slate-400">KK</label>
                                <input type="file" id="kk" name="kk" onchange="displayImage('kk', 'img_kk')"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                                <div id="error_kk" class="text-red"></div>
                            </div>
                            <div class="mb-2">
                                <img src="" alt="" id="img_sim">
                                <label for="sim"
                                    class="font-medium text-sm text-slate-600 dark:text-slate-400">SIM</label>
                                <input type="file" id="sim" name="sim" onchange="displayImage('sim', 'img_sim')"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                                <div id="error_sim" class="text-red"></div>
                            </div>
                            <div class="mb-2 md:mb-0">
                                <img src="" alt="" id="img_ktp">
                                <label for="ktp"
                                    class="font-medium text-sm text-slate-600 dark:text-slate-400">KTP</label>
                                <input type="file" id="ktp" name="ktp" onchange="displayImage('ktp', 'img_ktp')"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                                <div id="error_ktp" class="text-red"></div>
                            </div>

                        </div>
                        <!--end col-->
                        <div class="sm:col-span-12  md:col-span-12 lg:col-span-6 xl:col-span-6 ">
                            <div class="mb-2">
                                <label for="trans_info"
                                    class="font-medium text-sm text-slate-600 dark:text-slate-400">Jenis
                                    Kendaraan</label>
                                <input type="text" id="trans_info" name="trans_info"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                                <div id="error_trans_info" class="text-red"></div>
                            </div>
                            <div class="mb-2">
                                <label for="trans_number"
                                    class="font-medium text-sm text-slate-600 dark:text-slate-400">Plat
                                    Kendaraan</label>
                                <input type="text" id="trans_number" name="trans_number"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                                <div id="error_trans_number" class="text-red"></div>
                            </div>
                            <div class="mb-2">
                                <img src="" alt="" id="img_kendaraan">
                                <label for="kendaraan"
                                    class="font-medium text-sm text-slate-600 dark:text-slate-400">FotoKendaraan</label>
                                <input type="file" id="kendaraan" name="kendaraan"
                                    onchange="displayImage('kendaraan', 'img_kendaraan')"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                                <div id="error_kendaraan" class="text-red"></div>
                            </div>
                            <div class="mb-2">
                                <img src="" alt="" id="img_gudang">
                                <label for="gudang" class="font-medium text-sm text-slate-600 dark:text-slate-400">Foto
                                    Gudang</label>
                                <input type="file" id="gudang" name="gudang"
                                    onchange="displayImage('gudang', 'img_gudang')"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                                <div id="error_gudang" class="text-red"></div>
                            </div>

                        </div>
                        <!--end col-->
                    </div>
                    <!--end inner-grid-->
                </div>

                <div class="step step3 hidden">
                    <div class="grid md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 mb-4">
                        <div class="sm:col-span-12  md:col-span-12 lg:col-span-6 xl:col-span-6 ">
                            <div class="mb-2">
                                <img src="" alt="" id="img_photo">
                                <label for="photo" class="font-medium text-sm text-slate-600 dark:text-slate-400">
                                    Photo
                                </label>
                                <input type="file" id="photo" name="photo" onchange="displayImage('photo', 'img_photo')"
                                    class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                            </div>
                        </div>
                        <!--end col-->
                        <div class="sm:col-span-12  md:col-span-12 lg:col-span-6 xl:col-span-6 ">
                            <label class="custom-label block dark:text-slate-300">
                                <div
                                    class="bg-white dark:bg-slate-700  border border-slate-200 dark:border-slate-600 rounded w-4 h-4  inline-block leading-4 text-center -mb-[3px]">
                                    <input type="checkbox" class="hidden" name="checkbox" required>
                                    <i class="fas fa-check hidden text-xs text-primary-500"></i>
                                </div>
                                Saya setuju dengan Syarat dan Ketentuan.
                            </label>
                            <div id="error_checkbox" class="text-red"></div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end inner-grid-->
                </div>
                <!--end step3-->

                <div class="flex justify-between">
                    <button id="previous"
                        class="inline-block focus:outline-none text-primary-500 hover:bg-primary-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-primary-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-primary-500  text-sm font-medium py-1 px-3 rounded mb-1 float-left opacity-50 cursor-not-allowed"
                        disabled tabindex="-1">
                        previous
                    </button>
                    <div>
                        <button id="next"
                            class="inline-block focus:outline-none text-primary-500 hover:bg-primary-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-primary-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-primary-500  text-sm font-medium py-1 px-3 rounded mb-1 float-right">
                            next
                        </button>
                        <button id="validate" type="button" data-sitekey="6LchpewpAAAAAPro9bcR_MwsAy6oL9ySgOfSCm6x"
                            class="hidden g-recaptcha focus:outline-none text-green-500 hover:bg-green-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-green-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-green-500  text-sm font-medium py-1 px-3 rounded mb-1 float-right">
                            Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- JAVASCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    @vite('resources/assets/libs/lucide/umd/lucide.min.js')
    @vite('resources/assets/libs/simplebar/simplebar.min.js')
    @vite('resources/assets/libs/flatpickr/flatpickr.min.js')
    @vite('resources/assets/libs/@frostui/tailwindcss/frostui.js')
    @vite('resources/assets/js/pages/wizard.init.js')
    @vite('resources/assets/js/app.js')
    <!-- JAVASCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        $(document).ready(function() {
            $("#villages").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "http://pointtrash.test/get-villages",
                        dataType: "json",
                        data: {
                            name: request.term
                        },
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    label: item.province_name + ", " + item.city_name + ", " + item.district_name + ", " + item.village_name,
                                    value: item.village_name,
                                    item: item
                                };
                            }));
                        }
                    });
                },
                minLength: 2, // Minimum characters before triggering autocomplete
                select: function(event, ui) {
                    $('#villages').val(ui.item.label);
                    return false;
                }
            });
        });

        function displayImage(inputId, imageId) {
            const input = document.getElementById(inputId);
            const image = document.getElementById(imageId);

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    image.src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        //submit form
       $('#validate').click(function(e) {
            e.preventDefault();
            submitForm()
        });

    </script>
    <script>
        $('#validate').click(function(e) {
            e.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('reCAPTCHA_site_key', { action: 'submit' }).then(function(token) {
                    $('#demo-form').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                    $('#demo-form').submit();
                });
            });
        });

        $('#previous').click(function(e) {
            e.preventDefault();
        });
        function submitForm(callback) {
            const formData = new FormData(document.getElementById('demo-form'));

            $.ajax({
                url: '{{ route("register.partner") }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        title: "Sukses!",
                        text: "Berhasil mendaftar sebagai mitra Pointtrash. Silahkan cek email untuk mengakifkan Akun. Terima kasih!",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok!",
                        //can't click out
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            //clear form
                            document.getElementById('demo-form').reset();
                            location.reload();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    if(callback) callback(xhr);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }

        let page = 1;
        $('#next').click(function(e) {
            e.preventDefault();
            if (page == 1) {
                submitForm(function(error, response) {
                    if (error) {
                        let errorJson = error.responseJSON.errors;
                        let required = ['name', 'gender', 'phone', 'address', 'email', 'villages'];
                        let execption = ['trans_number', 'trans_info','kk','sim','ktp','trans_info','trans_number','kendaraan','gudang'];
                        let foundException = false;
                        let foundRequiredEmpty = false; // Menambahkan variabel untuk menandai apakah ada field yang dibutuhkan kosong
                        $.each(errorJson, function(i, v) {
                            $(`#error_${i}`).text(v[0]);

                            // Remove error message after keyup
                            $(`#${i}`).keyup(function() {
                                $(`#error_${i}`).text('');
                            });

                            // Remove error message after change
                            $(`#${i}`).change(function() {
                                $(`#error_${i}`).text('');
                            });

                            if (execption.includes(i)) {
                                foundException = true;
                            }
                        });

                        // Check if any required fields are empty
                        required.forEach(function(fieldName) {
                            if ($(`#${fieldName}`).val() === '') {
                                foundRequiredEmpty = true;
                                $(`#error_${fieldName}`).text('This field is required.'); // Menampilkan pesan error untuk field yang dibutuhkan kosong
                            }
                        });

                        if (foundRequiredEmpty) {
                            $('#previous').click();
                            return; // Tidak berpindah halaman jika ada pengecualian atau field yang dibutuhkan kosong
                        }
                    }

                    page = 2;
                });

            } else if (page == 2) {
                submitForm(function(error, response) {
                    if (error) {
                        let errorJson = error.responseJSON.errors;
                        let required = ['trans_number', 'trans_info','kk','sim','ktp','trans_info','trans_number','kendaraan','gudang'];
                        let execption = ['name', 'gender', 'phone', 'address', 'email', 'villages'];
                        let foundException = false;
                        let foundRequiredEmpty = false; // Menambahkan variabel untuk menandai apakah ada field yang dibutuhkan kosong
                        $.each(errorJson, function(i, v) {
                            $(`#error_${i}`).text(v[0]);

                            // Remove error message after keyup
                            $(`#${i}`).keyup(function() {
                                $(`#error_${i}`).text('');
                            });

                            // Remove error message after change
                            $(`#${i}`).change(function() {
                                $(`#error_${i}`).text('');
                            });

                            if (execption.includes(i)) {
                                foundException = true;
                            }
                        });

                        // Check if any required fields are empty
                        required.forEach(function(fieldName) {
                            if ($(`#${fieldName}`).val() === '') {
                                foundRequiredEmpty = true;
                                $(`#error_${fieldName}`).text('This field is required.'); // Menampilkan pesan error untuk field yang dibutuhkan kosong
                            }
                        });

                        if (foundRequiredEmpty) {
                            $('#previous').click();
                            return; // Tidak berpindah halaman jika ada pengecualian atau field yang dibutuhkan kosong
                        }
                    }

                    page = 2;
                });
                page = 3;
            }
        });

    </script>
</body>

</html>