@extends('layouts.app')
@section('content')
@include('components.breadcrumb',['title'=>'Media Sosial'])
<div class="sm:col-span-12  md:col-span-12 lg:col-span-8 xl:col-span-6 xl:col-start-4 ">
    <div
        class="bg-white dark:bg-gray-900 border border-slate-200 dark:border-slate-700/40  rounded-md w-full relative mb-4">
        <div class="border-b border-slate-200 dark:border-slate-700/40 py-3 px-4 dark:text-slate-300/70">
            <div class="flex-none md:flex">
                <h4 class="font-medium text-lg flex-1 self-center mb-2 md:mb-0">Update Media Sosial</h4>
            </div>
        </div>
        <!--end header-title-->
        <div class="flex-auto p-4 ">
            <form action="{{ route('about-site.update', [$about_us->about_id]) }}" method="POST"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-2">
                    <label for="site_name" class="font-medium text-sm text-slate-600 dark:text-slate-400">Tentang
                        Kami</label>
                    <textarea id="basic-conf" rows="4" name="content"
                        class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                        style="height: 350px;">{!! $about_us->content !!}</textarea>
                    @if ($errors->has('content'))
                    <span class="text-red-500 text-xs italic">{{ $errors->first('content') }}</span>
                    @endif
                </div>
                <div class="mb-2">
                    <label for="site_name"
                        class="font-medium text-sm text-slate-600 dark:text-slate-400">Profile</label>
                    <input
                        class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                        type="file" name="profile" value="{{ $about_us->profile }}">
                    <div class="text-xs italic">*) File format PDF. Kosongkan inputan bila tidak diubah. <a
                            class="text-blue-500" href="{{ asset('uploads/'.$about_us->profile) }}" target="_blank">
                            Download file</a>
                    </div>
                    @if ($errors->has('profile'))
                    <span class="text-red-500 text-xs italic">{{ $errors->first('profile') }}</span>
                    @endif
                </div>
                <div class="mb-2">
                    <label for="site_name" class="font-medium text-sm text-slate-600 dark:text-slate-400">Status
                        Profil</label>
                    <select id="countries" name="show_profile"
                        class="w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-[6.5px] focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                        <option value="0" @if ($about_us->show_profile == '0')
                            selected
                            @endif>Jangan Tampilkan</option>
                        <option value="1" @if ($about_us->show_profile == '1')
                            selected
                            @endif>Tampilkan</option>
                    </select>
                    @if ($errors->has('content'))
                    <span class="text-red-500 text-xs italic">{{ $errors->first('content') }}</span>
                    @endif
                </div>
                <button type="submit"
                    class="inline-block mt-2 focus:outline-none text-primary-500 hover:bg-primary-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-primary-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-primary-500  text-sm font-medium py-1 px-3 rounded mb-1">Submit</button>
            </form>
        </div>
        <!--end card-body-->
    </div>
    <!--end card-->
</div>
@endsection

@push('css')
@vite('resources/assets/css/summernote.css')
@endpush
@push('js')
<script src="https://cdn.tiny.cloud/1/wwx0cl8afxdfv85dxbyv3dy0qaovbhaggsxpfqigxlxw8pjx/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>
@vite('resources/assets/js/pages/editor.init.js')
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
</script>
@endpush