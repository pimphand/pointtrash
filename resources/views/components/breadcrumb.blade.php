<div class="xl:w-full">
    <div class="flex flex-wrap">
        <div class="flex items-center py-4 w-full">
            <div class="w-full">
                <div class="flex flex-wrap justify-between">
                    <div class="items-center ">
                        <h1 class="font-medium text-3xl block dark:text-slate-100">{{ $title ?? 'Dashboard' }}</h1>
                        <ol class="list-reset flex text-sm">
                            <li><a href="#"
                                    class="text-primary-500 dark:text-primary-500 hover:underline hover:text-primary-600">Home</a>
                            </li>
                            <li class="mx-2">/</li>
                            <li><a href="#"
                                    class="text-primary-500 dark:text-primary-500 hover:underline hover:text-primary-600">{{
                                    $title ?? 'Dashboard' }}</a>
                            </li>
                        </ol>
                    </div>
                    <!--end /div-->
                    {{-- <div class="flex items-center">
                        <div
                            class="today-date leading-5 mt-2 lg:mt-0 form-input w-auto rounded-md border inline-block border-primary-500/60 dark:border-primary-500/60 text-primary-500 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-primary-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                            <input type="text" class="dash_date border-0 focus:border-0 focus:outline-none" readonly
                                required="">
                        </div>
                    </div> --}}
                    <!--end /div-->
                </div>
                <!--end /div-->
            </div>
            <!--end /div-->
        </div>
        <!--end /div-->
    </div>
    <!--end /div-->
</div>