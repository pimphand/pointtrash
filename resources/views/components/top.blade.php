@php
    use Illuminate\Support\Facades\Auth;
$user = Auth::guard('admin')->user();
@endphp
<nav id="topbar" class="topbar border-b  dark:border-slate-700/40  fixed inset-x-0  duration-300
             block print:hidden z-50">
    <div
        class="mx-0 flex max-w-full flex-wrap items-center lg:mx-auto relative top-[50%] start-[50%] transform -translate-x-1/2 -translate-y-1/2">
        <div class="ltr:mx-2  rtl:mx-2">
            <button id="toggle-menu-hide" class="button-menu-mobile flex rounded-full md:me-0 relative">
                <!-- <i class="ti ti-chevrons-left text-3xl  top-icon"></i> -->
                <i data-lucide="menu" class="top-icon w-5 h-5"></i>
            </button>
        </div>
        <div class="flex items-center md:w-[40%] lg:w-[30%] xl:w-[20%]">
            <div class="relative ltr:mx-2 rtl:mx-2 self-center">
                Saldo : Rp {{number_format($user->saldo,0,',','.')}}
            </div>
        </div>

        <div class="order-1 ltr:ms-auto rtl:ms-0 rtl:me-auto flex items-center md:order-2">
            <div class="ltr:me-2 ltr:lg:me-4 rtl:me-0 rtl:ms-2 rtl:lg:me-0 rtl:md:ms-4 dropdown relative">
                <button type="button" class="dropdown-toggle flex rounded-full md:me-0" id="Notifications"
                        aria-expanded="false" data-fc-autoclose="both" data-fc-type="dropdown">
                    <span data-lucide="bell" class="top-icon w-5 h-5"></span>
                </button>

                <div class="left-auto right-0 z-50 my-1 hidden w-64
                    list-none divide-y h-52 divide-gray-100 rounded border border-slate-700/10
                   text-base shadow dark:divide-gray-600 bg-white
                    dark:bg-slate-800" id="navNotifications" data-simplebar>
                    <ul class="py-1" aria-labelledby="navNotifications">
                        <li class="py-2 px-4">
                            <a href="javascript:void(0);" class="dropdown-item">
                                <div class="flex">
                                    <img class="object-cover rounded-full h-8 w-8 shrink-0 me-3"
                                         src="assets/images/users/avatar-9.png" alt="logo"/>
                                    <div class="flex-grow flex-1 ms-0.5 overflow-hidden">
                                        <p class="text-sm font-medium  text-gray-900 truncate
                                dark:text-gray-300">Meeting with designers</p>
                                        <p class="text-gray-500 mb-0 text-xs truncate
                                dark:text-gray-400">
                                            It is a long established fact that a reader.
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="me-2  dropdown relative">
                <button type="button" class="dropdown-toggle flex items-center rounded-full text-sm
                    focus:bg-none focus:ring-0 dark:focus:ring-0 md:me-0" id="user-profile" aria-expanded="false"
                        data-fc-autoclose="both" data-fc-type="dropdown">
                    <img class="h-8 w-8 rounded-full" src="{{asset('upload')}}/{{$user->photo}}" alt="user photo"/>
                    <span class="ltr:ms-2 rtl:ms-0 rtl:me-2 hidden text-left xl:block">
                        <span
                            class="block font-medium text-slate-600 dark:text-gray-300">{{$user->name}}</span>
                        <span class="-mt-0.5 block text-xs text-slate-500 dark:text-gray-400">{{$user->roles}}</span>
                    </span>
                </button>

                <div class="left-auto right-0 z-50 my-1 hidden list-none
                    divide-y divide-gray-100 rounded border border-slate-700/10
                    text-base shadow dark:divide-gray-600 bg-white dark:bg-slate-800 w-40" id="navUserdata">

                    <ul class="py-1" aria-labelledby="navUserdata">
                        <li>
                            <a href="#" class="flex items-center py-2 px-3 text-sm text-gray-700 hover:bg-gray-50
                          dark:text-gray-200 dark:hover:bg-gray-900/20
                          dark:hover:text-white">
                                <span data-lucide="user"
                                      class="w-4 h-4 inline-block text-slate-800 dark:text-slate-400 me-2"></span>
                                Profile</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center py-2 px-3 text-sm text-gray-700 hover:bg-gray-50
                          dark:text-gray-200 dark:hover:bg-gray-900/20
                          dark:hover:text-white">
                                <span data-lucide="settings"
                                      class="w-4 h-4 inline-block text-slate-800 dark:text-slate-400 me-2"></span>
                                Settings</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center py-2 px-3 text-sm text-gray-700 hover:bg-gray-50
                          dark:text-gray-200 dark:hover:bg-gray-900/20
                          dark:hover:text-white">
                                <span data-lucide="dollar-sign"
                                      class="w-4 h-4 inline-block text-slate-800 dark:text-slate-400 me-2"></span>
                                Earnings</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" id="logout" class="flex items-center py-2 px-3 text-sm text-red-500 hover:bg-gray-50 hover:text-red-600
                          dark:text-red-500 dark:hover:bg-gray-900/20
                          dark:hover:text-red-500">
                                <span data-lucide="power"
                                      class="w-4 h-4 inline-block text-red-500 dark:text-red-500 me-2"></span>
                                Sign out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
