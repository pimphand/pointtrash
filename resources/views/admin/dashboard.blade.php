@extends('layouts.app')
@section('content')
@include('components.breadcrumb',['title'=>'Dashboard'])
<style>
    .hover-zoom {
        transition: transform 0.2s;
    }

    .hover-zoom:hover {
        transform: scale(1.1);
    }
</style>
<div class="grid md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 mb-4">
    <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12">
        <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-4 gap-4 p-4" id="data">

        </div>
        <h1 class="font-medium text-3xl block dark:text-slate-100">Rating Mitra</h1>

        <div class="xl:w-full  min-h-[calc(100vh-152px)] relative pb-14 p-4">
            <div class="grid md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4 mb-4" id="mitra">

            </div>
            <table class="w-full border-collapse border dark:border-slate-700">
                <tbody id="table">
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

@push('js')
<script>
    $.get("{{ route('dashboard.data') }}",
        function (data, textStatus, jqXHR) {
            //mitra
            $('#data').append(`
                <div
                    class="bg-primary-500/5 dark:bg-primary-500/10 border border-dashed border-primary-500  rounded-md w-full relative ">
                    <div class="flex-auto p-2 text-center">
                        <a href="">
                            <span
                                class="inline-flex  justify-center items-center h-14 w-14 rounded-full bg-white dark:bg-gray-900 border border-dashed border-primary-500 hover-zoom">
                                <i class="fas fa-users fa-2x"></i>
                            </span>
                        </a>
                        <h4 class="my-1 font-semibold text-3xl dark:text-slate-200">${data.users}</h4>
                        <h6 class="text-gray-800 dark:text-gray-400 mb-0 text-lg font-medium uppercase">User</h6>
                    </div>
                    <!--end card-body-->
                </div>
            `)
            $('#data').append(`
                <div
                    class="bg-primary-500/5 dark:bg-primary-500/10 border border-dashed border-primary-500  rounded-md w-full relative ">
                    <div class="flex-auto p-4 text-center">
                        <a href="">
                        <span
                            class="inline-flex  justify-center items-center h-14 w-14 rounded-full bg-white dark:bg-gray-900 border border-dashed border-primary-500 hover-zoom">
                            <i class="fas fa-users fa-2x"></i>
                        </span>
                        </a>
                        <h4 class="my-1 font-semibold text-3xl dark:text-slate-200">${data.mitra}</h4>
                        <h6 class="text-gray-800 dark:text-gray-400 mb-0 text-lg font-medium uppercase">Mitra</h6>
                        <p class="truncate text-gray-700 dark:text-slate-500 text-sm font-normal">
                            <span class="text-green-500">
                                <i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>
                            </span>
                        </p>
                    </div>
                    <!--end card-body-->
                </div>
            `)

            $.each(data.order, function (orderI, order) {
                $('#data').append(`
                <div
                    class="bg-orange-500/5 dark:bg-primary-500/10 border border-dashed border-orange-500 rounded-md w-full relative ">
                    <div class="flex-auto p-4 text-center">
                        <a href="">
                        <span
                            class="inline-flex  justify-center items-center h-14 w-14 rounded-full bg-white dark:bg-gray-900 border border-dashed border-orange-500 hover-zoom">
                           <i class="fas fa-shopping-cart fa-2x" style="color:#fe7831 !important;"></i>
                        </span>
                         </a>
                        <h4 class="my-1 font-semibold text-3xl dark:text-slate-200">${order.count}</h4>
                        <h6 class="text-gray-800 dark:text-gray-400 mb-0 text-lg font-medium uppercase">Order ${order.type}</h6>
                        <p class="truncate text-gray-700 dark:text-slate-500 text-sm font-normal">
                            <span class="text-green-500">
                                <i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>
                            </span>
                        </p>
                    </div>
                    <!--end card-body-->
                </div>
                `)
            });

            $.each(data.widraw, function (widrawI, widraw) {
                $('#data').append(`
                    <div class="bg-purple-500/5 dark:bg-primary-500/10 border border-dashed border-purple-500 rounded-md w-full relative ">
                        <div class="flex-auto p-4 text-center">
                            <a href="">
                            <span
                                class="inline-flex  justify-center items-center h-14 w-14 rounded-full bg-white dark:bg-gray-900 border border-dashed border-purple-500 hover-zoom">
                                <i class="fas fa-money-check-alt fa-2x" style="color:#a855f7 !important;"></i>
                            </span>
                            </a>
                            <h4 class="my-1 font-semibold text-3xl dark:text-slate-200">${widraw}</h4>
                            <h6 class="text-gray-800 dark:text-gray-400 mb-0 text-lg font-medium uppercase">Order ${widrawI}</h6>
                            <p class="truncate text-gray-700 dark:text-slate-500 text-sm font-normal">
                                <span class="text-green-500">
                                    <i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>
                                </span>
                            </p>
                        </div>
                        <!--end card-body-->
                    </div>
                `)
            });

            $.each(data.rating, function (ratingI, rating) {
                //partner_rating change to int
                let rating_count = parseInt(parseFloat(rating.partner_rating));
                if (ratingI < 4) {
                    $('#mitra').append(`
                    <div class="sm:col-span-12  md:col-span-12 lg:col-span-4 xl:col-span-3 ">

                        <div class="bg-white dark:bg-gray-900 border border-slate-200 dark:border-slate-700/40  rounded-md w-full relative">
                            <span class="bg-yellow p-4 rounded-md">${ratingI+1}</span>
                            <div class="flex-auto p-4 text-center">
                                <img src="assets/images/users/avatar-8.png" alt="" class="h-20 inline-block rounded-full mb-4">
                                <h5 class="text-1xl font-semibold text-slate-700 dark:text-gray-400 leading-5">${rating.name}
                                </h5>
                                <span class="text-slate-500 text-sm">
                                    ${Array.from({ length: rating_count }, (_, index) => `<i class="fas fa-star"
                                        style="color:#f7d106 !important;"></i>`).join('')} <br>
                                    ${rating_count}.0
                                </span>

                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    `)
                }else{
                    $('#table').append(`
                        <tr class="bg-white border-b border-dashed dark:bg-gray-900 dark:border-gray-700/40">
                            <td class="p-2">${ratingI+1}</td>
                            <td class="p-3 text-sm font-medium whitespace-nowrap dark:text-white  border dark:border-slate-700">
                               <img src="assets/images/users/avatar-8.png" alt="" class="h-20 inline-block rounded-full mb-4">
                            </td>
                            <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400  border dark:border-slate-700">
                               ${rating.name}
                            </td>
                            <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400  border dark:border-slate-700">
                               ${Array.from({ length: rating_count }, (_, index) => `<i class="fas fa-star"
                                    style="color:#f7d106 !important;"></i>`).join('')} <br>
                            </td>
                            <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400  border dark:border-slate-700">
                                Rating ${rating_count}.0
                            </td>
                            <td class="p-3 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400  border dark:border-slate-700">
                               Rp. ${rating.point.toLocaleString('id-ID')}
                            </td>
                        </tr>
                    `)
                }
            });
        }
    );
</script>
@endpush