@extends('layouts.app')
@section('content')
@include('components.breadcrumb',['title'=>' Kategori Sampah'])
<div
    class="bg-white dark:bg-gray-900 border border-slate-200 dark:border-slate-700/40  rounded-md w-full relative mb-4">
    <div class="border-b border-slate-200 dark:border-slate-700/40 py-3 px-4 dark:text-slate-300/70">
        <div class="flex-none md:flex">
            <h4 class="font-medium text-lg flex-1 self-center mb-2 md:mb-0">Tambah Kategori Sampah</h4>
            <div class="dropdown inline-block">
                <a href="{{route('trash.index')}}"
                    class="dropdown-toggle px-3 py-1 text-xs font-medium text-red-500 focus:outline-none bg-white rounded border border-red-200 hover:bg-gray-50 hover:text-slate-800 focus:z-10 dark:bg-red-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 fc-collapse"
                    type="button">
                    <i class=" fas fa-backward me-2"></i> List Sampah
                </a>
            </div>
        </div>
    </div>
    <!--end header-title-->
    <div class="flex-auto p-4 ">
        <div class="grid md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4">
            <div class="sm:col-span-12  md:col-span-5 lg:col-span-5">
                <form action="" enctype="multipart/form-data" method="post" id="_form_input">
                    @csrf
                    <div class="mb-2">
                        <label for="email"
                            class="font-medium text-sm text-slate-600 dark:text-slate-400">Kategori</label>
                        <input type="text" id="category" name="category"
                            class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                            placeholder="masukan kategori" required>
                        <span id="error-category" class="text-xs text-red-500"></span>
                    </div>
                    <div class="mb-2">
                        <label for="Background"
                            class="font-medium text-sm text-slate-600 dark:text-slate-400">Background</label>
                        <input type="file" id="background" name="background"
                            class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                            required>
                        <span id="error-background" class="text-xs text-red-500"></span>
                    </div>
                    <button type="button" id="_save"
                        class="inline-block focus:outline-none text-primary-500 hover:bg-primary-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-primary-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-primary-500  text-sm font-medium py-1 px-3 rounded mb-1">
                        Submit
                    </button>
                    <button type="button"
                        class="inline-block focus:outline-none text-red-500 hover:bg-red-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-red-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-red-500  text-sm font-medium py-1 px-3 rounded mb-1">
                        Cancel
                    </button>
                </form>

            </div>
            <!--end col-->
            <div class="sm:col-span-12  md:col-span-7 lg:col-span-7">
                <div class="rounded-md w-full p-3 relative">
                    <table class="w-full border-collapse border dark:border-slate-700">
                        <thead class="bg-slate-100 dark:bg-slate-700/20">
                            <tr>
                                <th scope="col"
                                    class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    #
                                </th>
                                <th scope="col"
                                    class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Kategori
                                </th>
                                <th scope="col"
                                    class="p-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Opsi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr class="bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700/40"
                                data-count="{{$loop->count}}">
                                <td class="p-3 text-sm font-medium whitespace-nowrap dark:text-white">
                                    {{$loop->iteration}}
                                </td>
                                <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    {{$category->category}}
                                </td>
                                <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    <button data-category="{{$category->category}}" data-id="{{$category->category_id}}"
                                        class="text-primary-500 hover:text-primary-700 dark:text-primary-500 dark:hover:text-primary-700 _edit">
                                        <i class="fas fa-edit"> </i> Edit
                                    </button>
                                    <button
                                        class="text-red-500 hover:text-red-700 dark:text-red-500 dark:hover:text-red-700 _delete"
                                        data-id="{{$category->category_id}}">
                                        <i class="fas fa-trash"> </i> Hapus
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $('#_save').on('click', function () {
            const form = $('#_form_input'); // Mengambil elemen form
            const formData = new FormData(form[0]); // Membuat FormData dari form
            const url = form.attr('action'); // Mengambil URL aksi dari atribut form
            const method = 'POST'; // Metode request, bisa diubah jika diperlukan

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
                //reset form
                $('#_form_input').trigger('reset');
                Swal.fire({
                    title: 'Berhasil',
                    text: data.message,
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oke'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    } else {
                        window.location.reload();
                    }
                });
            }
        }

        $(document).on('click', '._delete', function () {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(id)
                    let url = "{{route('trash-categories.destroy',':id')}}";
                    url = url.replace(':id', id);
                    const method = 'DELETE';
                    postData(url, method, {_token: "{{csrf_token()}}"}, handleResponse);
                }
            });
        });

        $(document).on('click', '._edit', function () {
            const category = $(this).data('category');
            const id = $(this).data('id');
            $('#category').val(category);

            $("#_form_input").attr('action', "{{route('trash-categories.update',':id')}}".replace(':id', id));
            //add method
            $("#_form_input").append('<input type="hidden" name="_method" value="PUT">');

        });
</script>
@endpush