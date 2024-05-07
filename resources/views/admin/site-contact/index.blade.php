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
                <form action="{{ route('site-contact.update', [$contact->contact_id]) }}" method="POST">
                    @method('put')
                    @csrf
                    @foreach ($contact->attributesToArray() as $key=> $item)
                        @if ($key != 'contact_id' || $key == 'created_at' || $key == 'updated_at')
                            <div class="mb-2">
                                <label for="site_name" class="font-medium text-sm text-slate-600 dark:text-slate-400">{{ $key
                        }}</label>
                                <input type="text" id="site_name" name="{{ $key }}"
                                       class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                                       placeholder="name@t-wind.com" value="{{ $item}}" required="">
                                @if ($errors->has($key))
                                    <span class="text-red-500 text-xs italic">{{ $errors->first($key) }}</span>
                                @endif
                            </div>
                        @endif
                    @endforeach
                    <button type="submit"
                            class="inline-block focus:outline-none text-primary-500 hover:bg-primary-500 hover:text-white bg-transparent border border-gray-200 dark:bg-transparent dark:text-primary-500 dark:hover:text-white dark:border-gray-700 dark:hover:bg-primary-500  text-sm font-medium py-1 px-3 rounded mb-1">
                        Submit
                    </button>
                </form>
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
@endsection
