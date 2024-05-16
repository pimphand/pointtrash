@php use Illuminate\Support\Str; @endphp
<div
    class="min-h-full z-[99]  fixed inset-y-0 print:hidden bg-gradient-to-t from-[#6f3dc3] from-10% via-[#603dc3] via-40% to-[#5c3dc3] to-100% dark:bg-[#603dc3] main-sidebar duration-300 group-data-[sidebar=dark]:bg-[#603dc3] group-data-[sidebar=brand]:bg-brand group-[.dark]:group-data-[sidebar=brand]:bg-[#603dc3]">
    <div
        class=" text-center border-b bg-[#603dc3] border-r h-[64px] flex justify-center items-center brand-logo dark:bg-[#603dc3] dark:border-slate-700/40 group-data-[sidebar=dark]:bg-[#603dc3] group-data-[sidebar=dark]:border-slate-700/40 group-data-[sidebar=brand]:bg-brand group-[.dark]:group-data-[sidebar=brand]:bg-[#603dc3] group-data-[sidebar=brand]:border-slate-700/40">
        <a href="{{ route('dashboard') }}" class="logo">
            <span>
                <img src="{{asset('assets')}}/pointtrash_logo.png" alt="logo-small"
                     class="logo-sm h-12 align-middle inline-block">
            </span>
        </a>
    </div>
    <div
        class="border-r pb-14 h-[100vh] dark:bg-[#603dc3] dark:border-slate-700/40 group-data-[sidebar=dark]:border-slate-700/40 group-data-[sidebar=brand]:border-slate-700/40"
        data-simplebar>
        <div class="p-4 block">
            <ul class="navbar-nav">
                <li
                    class="uppercase text-[11px]  text-primary-500 dark:text-primary-400 mt-0 leading-4 mb-2 group-data-[sidebar=dark]:text-primary-400 group-data-[sidebar=brand]:text-primary-300">
                    <span
                        class="text-[9px] text-slate-600 dark:text-slate-500 group-data-[sidebar=dark]:text-slate-500 group-data-[sidebar=brand]:text-slate-400">Dashboard</span>
                </li>
                <li>
                    <div id="parent-accordion" data-fc-type="accordion">


                        <a href="{{route('dashboard')}}"
                           class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-slate-200 ">
                            <span data-lucide="home"
                                  class="w-5 h-5 text-center text-slate-800 dark:text-slate-400 me-2 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-400"></span>
                            <span>Dashboard</span>

                        </a>

                        @if(Auth::guard('admin')->user()->roles == "admin")
                            <a href="#"
                               class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-slate-200 "
                               data-fc-type="collapse" data-fc-parent="parent-accordion">
                            <span data-lucide="laptop"
                                  class="w-5 h-5 text-center text-slate-800 dark:text-slate-400 me-2 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-400"></span>
                                <span>Content</span>
                                <i
                                    class="icofont-thin-down ms-auto inline-block text-[14px] transform transition-transform duration-300 text-slate-800 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-400 fc-collapse-open:rotate-180 "></i>
                            </a>
                            <div id="Customer-flush" class="hidden  overflow-hidden">
                                <ul class="nav flex-col flex flex-wrap ps-0 mb-0 ms-2">
                                    <li class="nav-item relative block">
                                        <a href="{{ route('about-site.index') }}"
                                           class="nav-link  hover:text-primary-500  rounded-md dark:hover:text-primary-500 relative   flex items-center decoration-0 px-3 py-3 group-data-[sidebar=brand]:hover:text-slate-200">
                                            <i
                                                class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400 "></i>
                                            Tentang Kami
                                        </a>
                                    </li>
                                    <li class="nav-item relative block">
                                        <a href="{{route('services.index')}}"
                                           class="nav-link  hover:text-primary-500  rounded-md dark:hover:text-primary-500 relative   flex items-center decoration-0 px-3 py-3 group-data-[sidebar=brand]:hover:text-slate-200">
                                            <i
                                                class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                            Layanan
                                        </a>
                                    </li>
                                    <li class="nav-item relative block">
                                        <a href="{{route('portfolio.index')}}"
                                           class="nav-link  hover:text-primary-500  rounded-md dark:hover:text-primary-500 relative   flex items-center decoration-0 px-3 py-3 group-data-[sidebar=brand]:hover:text-slate-200">
                                            <i
                                                class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                            Portofolio
                                        </a>
                                    </li>
                                    <li class="nav-item relative block">
                                        <a href="{{route('blogs.index')}}"
                                           class="nav-link  hover:text-primary-500  rounded-md dark:hover:text-primary-500 relative   flex items-center decoration-0 px-3 py-3 group-data-[sidebar=brand]:hover:text-slate-200">
                                            <i
                                                class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                            Blog
                                        </a>
                                    </li>
                                    <li class="nav-item relative block">
                                        <a href="{{route('our-team.index')}}"
                                           class="nav-link  hover:text-primary-500  rounded-md dark:hover:text-primary-500 relative   flex items-center decoration-0 px-3 py-3 group-data-[sidebar=brand]:hover:text-slate-200">
                                            <i
                                                class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                            Tim Kami
                                        </a>
                                    </li>
                                    <li class="nav-item relative block">
                                        <a href="{{route('advertisment.index')}}"
                                           class="nav-link  hover:text-primary-500  rounded-md dark:hover:text-primary-500 relative   flex items-center decoration-0 px-3 py-3 group-data-[sidebar=brand]:hover:text-slate-200">
                                            <i
                                                class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                            Iklan
                                        </a>
                                    </li>
                                    <li class="nav-item relative block">
                                        <a href="{{route('terms-of-service.index')}}"
                                           class="nav-link  hover:text-primary-500  rounded-md dark:hover:text-primary-500 relative   flex items-center decoration-0 px-3 py-3 group-data-[sidebar=brand]:hover:text-slate-200">
                                            <i
                                                class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                            Syarat & Ketentuan
                                        </a>
                                    </li>
                                    <li class="nav-item relative block">
                                        <a href="{{route('privacy-policy.index')}}"
                                           class="nav-link  hover:text-primary-500  rounded-md dark:hover:text-primary-500 relative   flex items-center decoration-0 px-3 py-3 group-data-[sidebar=brand]:hover:text-slate-200">
                                            <i
                                                class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                            Kebijakan Privasi
                                        </a>
                                    </li>
                                    <li class="nav-item relative block">
                                        <a href="{{route('mobile-version.index')}}"
                                           class="nav-link  hover:text-primary-500  rounded-md dark:hover:text-primary-500 relative   flex items-center decoration-0 px-3 py-3 group-data-[sidebar=brand]:hover:text-slate-200">
                                            <i
                                                class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                            Versi Mobile
                                        </a>
                                    </li>
                                    <li class="nav-item relative block">
                                        <a href="{{route('mobile-guide.index')}}"
                                           class="nav-link  hover:text-primary-500  rounded-md dark:hover:text-primary-500 relative   flex items-center decoration-0 px-3 py-3 group-data-[sidebar=brand]:hover:text-slate-200">
                                            <i
                                                class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                            Panduan Mobile
                                        </a>
                                    </li>
                                    <li class="nav-item relative block">
                                        <a href="{{route('general-question.index')}}"
                                           class="nav-link  hover:text-primary-500  rounded-md dark:hover:text-primary-500 relative   flex items-center decoration-0 px-3 py-3 group-data-[sidebar=brand]:hover:text-slate-200">
                                            <i
                                                class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                            Pertanyaan Umum
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div data-fc-type="collapse" data-fc-parent="parent-accordion">
                                <a href="#"
                                   class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-slate-200">
                                <span data-lucide="grid"
                                      class="w-5 h-5 text-center text-slate-800 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-400"></span>
                                    <span>Pengaturan WEB</span>
                                    <i
                                        class="icofont-thin-down fc-collapse-open:rotate-180 ms-auto inline-block text-[14px] transform transition-transform duration-300 text-slate-800 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-400"></i>
                                </a>
                            </div>
                            <div class="hidden  overflow-hidden">
                                <ul class="nav flex-col flex flex-wrap ps-0 mb-0 ms-2" id="apps-accordion"
                                    data-fc-type="accordion">
                                    <li class="nav-item relative block">
                                        <a href="{{ route('information.index') }}"
                                           class="nav-link  hover:text-primary-500  rounded-md dark:hover:text-primary-500 relative group-data-[sidebar=brand]:hover:text-slate-200   flex items-center decoration-0 px-3 py-3">
                                            <i
                                                class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                            Informasi
                                        </a>
                                    </li>
                                    <li class="nav-item relative block">
                                        <a href="{{ route('logo.index') }}"
                                           class="nav-link  hover:text-primary-500  rounded-md dark:hover:text-primary-500 relative group-data-[sidebar=brand]:hover:text-slate-200   flex items-center decoration-0 px-3 py-3">
                                            <i
                                                class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                            Logo
                                        </a>
                                    </li>
                                    <li class="nav-item relative block">
                                        <a href="{{ route('social-media.index') }}"
                                           class="nav-link  hover:text-primary-500  rounded-md dark:hover:text-primary-500 relative group-data-[sidebar=brand]:hover:text-slate-200   flex items-center decoration-0 px-3 py-3">
                                            <i
                                                class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                            Media Sosial
                                        </a>
                                    </li>
                                    <li class="nav-item relative block">
                                        <a href="{{ route('site-contact.index') }}"
                                           class="nav-link  hover:text-primary-500  rounded-md dark:hover:text-primary-500 relative group-data-[sidebar=brand]:hover:text-slate-200   flex items-center decoration-0 px-3 py-3">
                                            <i
                                                class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                            Kontak
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        @endif

                        <div
                            class="border-b border-dashed dark:border-slate-700/40 my-3 group-data-[sidebar=dark]:border-slate-700/40 group-data-[sidebar=brand]:border-slate-700/40">
                        </div>
                        <div
                            class="text-[9px] text-slate-600 dark:text-slate-500 group-data-[sidebar=dark]:text-slate-500 group-data-[sidebar=brand]:text-slate-400">
                            DATA MOBILE
                        </div>
                        <div data-fc-type="collapse" data-fc-parent="parent-accordion">
                            <a href="#"
                               class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-slate-200">
                                <span data-lucide="users"
                                      class="w-5 h-5 text-center text-slate-800 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-400"></span>
                                <span>Data Pengguna</span>
                                <i
                                    class="icofont-thin-down fc-collapse-open:rotate-180 ms-auto inline-block text-[14px] transform transition-transform duration-300 text-slate-800 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-400"></i>
                            </a>
                        </div>
                        <div class="hidden  overflow-hidden">
                            <ul class="nav flex-col flex flex-wrap ps-0 mb-0 ms-2" id="UI_Kit-accordion"
                                data-fc-type="accordion">
                                <li>
                                    <div id="UI_Elements" data-fc-type="collapse" data-fc-parent="UI_Kit-accordion">
                                        <a href="{{route('partners.index')}}"
                                           class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-slate-200"
                                           aria-expanded="false" aria-controls="UI_Elements-flush">
                                            <i
                                                class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                            <span>Mitra</span>
                                        </a>
                                    </div>
                                </li>

                                <li>
                                    <div id="Advanced_UI" data-fc-type="collapse" data-fc-parent="UI_Kit-accordion">
                                        <a href="{{route('users.index')}}"
                                           class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-slate-200 "
                                           aria-expanded="false" aria-controls="Advanced_UI-flush">
                                            <i
                                                class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                            <span>User</span>
                                        </a>
                                    </div>
                                </li>
                                @if(Auth::guard('admin')->user()->roles == "admin")
                                    <li>
                                        <div id="Advanced_UI" data-fc-type="collapse" data-fc-parent="UI_Kit-accordion">
                                            <a href="{{route('accounts.index')}}"
                                               class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-slate-200 "
                                               aria-expanded="false" aria-controls="Advanced_UI-flush">
                                                <i
                                                    class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                                <span>Cabang</span>
                                            </a>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <a href="#"
                           class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-slate-200"
                           data-fc-type="collapse" data-fc-parent="parent-accordion">
                            <span data-lucide="file-plus"
                                  class="w-5 h-5 text-center text-slate-800 dark:text-slate-400 me-2 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-400"></span>
                            <span>Order</span>
                            <i
                                class="icofont-thin-down ms-auto inline-block text-[14px] transform transition-transform duration-300 text-slate-800 dark:text-slate-400  fc-collapse-open:rotate-180 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-400"></i>
                        </a>

                        <div id="Pages-flush" class="hidden  overflow-hidden">
                            <ul class="nav flex-col flex flex-wrap ps-0 mb-0 ms-2">
                                @php
                                    $SideOrders =['pickup','drop_off','company','event'];
                                    $widraws = ['ovo_widraw','gopay_widraw','shopeepay_widraw'];
                                @endphp
                                @foreach($SideOrders as $SideOrder)
                                    <li class="nav-item relative block">
                                        <a href="{{route('orders.index',$SideOrder)}}"
                                           class="nav-link  hover:text-primary-500  rounded-md dark:hover:text-primary-500 relative group-data-[sidebar=brand]:hover:text-slate-200   flex items-center decoration-0 px-3 py-3">
                                            <i
                                                class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                            {{str_replace('_',' ',Str::title($SideOrder))}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="#"
                           class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-slate-200"
                           data-fc-type="collapse" data-fc-parent="parent-accordion">
                            <span data-lucide="circle-dollar-sign"
                                  class="w-5 h-5 text-center text-slate-800 me-2 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-400"></span>
                            <span>Request</span>
                            <i
                                class="icofont-thin-down  fc-collapse-open:rotate-180 ms-auto inline-block text-[14px] transform transition-transform duration-300 text-slate-800 dark:text-slate-400 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-400"></i>
                        </a>
                        <div id="Authentication-flush" class="hidden  overflow-hidden"
                             aria-labelledby="Authentication">
                            <ul class="nav flex-col flex flex-wrap ps-0 mb-0 ms-2">
                                @if(Auth::guard('admin')->user()->roles == "cabang")
                                    @foreach($widraws as $widraw)
                                        <li class="nav-item relative block">
                                            <a href="{{route('widraws.index',$widraw)}}"
                                               class="nav-link  hover:text-primary-500  rounded-md dark:hover:text-primary-500 relative group-data-[sidebar=brand]:hover:text-slate-200   flex items-center decoration-0 px-3 py-3">
                                                <i
                                                    class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                                {{str_replace('_',' ',Str::title($widraw))}}
                                            </a>
                                        </li>
                                    @endforeach
                                @endif

                                <li class="nav-item relative block">
                                    <a href="{{route('saldo.index')}}"
                                       class="nav-link  hover:text-primary-500  rounded-md dark:hover:text-primary-500 relative group-data-[sidebar=brand]:hover:text-slate-200   flex items-center decoration-0 px-3 py-3">
                                        <i
                                            class="icofont-dotted-right me-2 text-slate-600 text-[8px] group-data-[sidebar=brand]:text-slate-400"></i>
                                        Request Saldo
                                    </a>
                                </li>

                            </ul>
                        </div>

                        <a href="{{route('trash.index')}}"
                           class="nav-link hover:bg-transparent hover:text-black  rounded-md dark:hover:text-slate-200   flex items-center  decoration-0 px-3 py-3 cursor-pointer group-data-[sidebar=dark]:hover:text-slate-200 group-data-[sidebar=brand]:hover:text-slate-200 ">
                            <span data-lucide="trash-2"
                                  class="w-5 h-5 text-center text-slate-800 dark:text-slate-400 me-2 group-data-[sidebar=dark]:text-slate-400 group-data-[sidebar=brand]:text-slate-400"></span>
                            <span>List Sampah</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
