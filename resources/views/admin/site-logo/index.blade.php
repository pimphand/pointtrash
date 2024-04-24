@extends('layouts.app')
@section('content')
@include('components.breadcrumb',['title'=>'Informasi Situs'])
<div class="sm:col-span-12  md:col-span-12 lg:col-span-8 xl:col-span-6 xl:col-start-4 ">
    <div
        class="bg-white dark:bg-gray-900 border border-slate-200 dark:border-slate-700/40  rounded-md w-full relative mb-4">
        <div class="border-b border-slate-200 dark:border-slate-700/40 py-3 px-4 dark:text-slate-300/70">
            <div class="flex-none md:flex">
                <h4 class="font-medium text-lg flex-1 self-center mb-2 md:mb-0">Update Informasi Situs</h4>
            </div>
        </div>
        <!--end header-title-->
        <div class="flex-auto p-4 ">
            @foreach ($site_logo as $logo)
            <form action="{{ route('logo.update', [$logo->logo_id]) }}" method="POST" id="form-{{ $logo->logo_id }}">
                @method('put')
                @csrf
                <div class="mb-2">
                    <label for="site_name" class="font-medium text-sm text-slate-600 dark:text-slate-400">
                        {{ $logo->file_type }}</label>
                    <img src="{{ asset('upload/'.$logo->file_name) }}" alt="{{ $logo->file_type }}" width="10%"
                        id="show_{{ $logo->logo_id }}">
                    <input type="file" id="site_name_{{ $logo->logo_id }}" name="logo_{{ $logo->logo_id }}"
                        data-id="{{ $logo->logo_id }}"
                        class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                        required="">
                    <div class="text-red-500 text-xs italic" id="error-logo_{{ $logo->logo_id }}">
                    </div>
                </div>
            </form>
            @endforeach
        </div>
        <!--end card-body-->
    </div>
    <!--end card-->
</div>
@endsection

@push('js')
<script>
    var elements = document.getElementsByClassName('form-input');
    for (var i = 0; i < elements.length; i++) {
        elements[i].addEventListener('change', function (e) {
            let id = e.target.getAttribute('data-id');
            console.log(id);
            let form = document.getElementById('form-' + id);
            let formData = new FormData(form);
            $.ajax({
                type: "post",
                url: form.action,
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    let file = e.target.files[0];
                    let url = URL.createObjectURL(file);
                    document.getElementById('show_' + id).setAttribute('src', url);
                },
                error: function (response) {
                   //each error
                    $.each(response.responseJSON.errors, function (key, value) {
                        document.getElementById('error-logo_' + id).innerHTML = value;
                    });
                }
            });
        });
    }

</script>
@endpush