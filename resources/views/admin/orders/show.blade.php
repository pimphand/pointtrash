@php use Illuminate\Support\Facades\DB; @endphp
@extends('layouts.app')
@section('content')

    @include('components.breadcrumb',['title'=>'Detail '. $type])
    <div
        class="bg-white dark:bg-gray-900 border border-slate-200 dark:border-slate-700/40  rounded-md w-full relative mb-4">
        <div class="border-b border-slate-200 dark:border-slate-700/40 py-3 px-4 dark:text-slate-300/70">
            <div class="flex-none md:flex">
                <h4 class="font-medium text-lg flex-1 self-center mb-2 md:mb-0">Detail {{$type}}</h4>
                <div class="dropdown inline-block">
                    <a href="{{route('orders.index', $type)}}"
                       class="dropdown-toggle px-3 py-1 text-xs font-medium text-gray-500 focus:outline-none bg-white rounded border border-gray-200 hover:bg-gray-50 hover:text-slate-800 focus:z-10 dark:bg-red-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 fc-collapse"
                       type="button">
                        <i class=" fas fa-backward me-2"></i> Kembali
                    </a>
                </div>
            </div>
        </div><!--end header-title-->
        <div class="flex-auto p-4 ">
            <div class="grid md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-4">
                <div class="sm:col-span-12  md:col-span-4 lg:col-span-4">
                    <div class="bg-white dark:bg-slate-800 shadow  rounded-md w-full relative">
                        <div class="flex-auto p-4 text-center">
                            <img src="{{asset('upload/'.$data->photo)}}" alt="" width="100%">
                        </div><!--end card-body-->
                    </div> <!--end card-->
                </div><!--end col-->
                <div class="sm:col-span-12  md:col-span-8 lg:col-span-8">
                    <div class="rounded-md w-full p-3 relative">
                        <table class="w-full table-fixed">
                            <tbody>
                            <tr class="bg-white">
                                <!-- 40% lebar untuk kolom pertama -->
                                <td class="w-2/8 p-3 text-sm font-medium whitespace-nowrap">
                                    Tanggal Order
                                </td>
                                <!-- 10% lebar untuk kolom kedua -->
                                <td class="w-1/10 p-1 text-sm text-gray-500 text-center whitespace-nowrap">
                                    :
                                </td>
                                <!-- 50% lebar untuk kolom ketiga -->
                                <td class="w-1/2 p-3 text-sm text-gray-500 whitespace-nowrap">
                                    {{date('d M Y - H:i:s', strtotime($data->date_create))}}
                                    @php
                                        $date_create = substr($data->date_create, 0, 10);
                                        $time_create = substr($data->date_create, 11);
                                        $date_pick = substr($data->date_pick, 0, 10);
                                        $time_pick = substr($data->date_pick, 11);
                                        $now = date_default_timezone_set('Asia/Jakarta');
                                        $now = date('Y-m-d H:i:s');
                                        $date_now = substr($now, 0, 10);
                                    @endphp
                                    @if($data->status == 0 && $date_now != $date_create )
                                        <span
                                            class="bg-pink-500 text-white text-[11px] font-medium mr-1 px-2.5 py-0.5 rounded ">Expired</span>
                                    @endif
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <!-- 40% lebar untuk kolom pertama -->
                                <td class="w-2/8 p-3 text-sm font-medium whitespace-nowrap">
                                    Nama
                                </td>
                                <!-- 10% lebar untuk kolom kedua -->
                                <td class="w-1/10 p-1 text-sm text-gray-500 text-center whitespace-nowrap">
                                    :
                                </td>
                                <!-- 50% lebar untuk kolom ketiga -->
                                <td class="w-1/2 p-3 text-sm text-gray-500 whitespace-nowrap">
                                    <a class="text-blue-500 hover:underline"
                                       href="{{ route('users.show', $data->user_id) }}">
                                        {{ $data->user->name }}
                                    </a>
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <!-- 40% lebar untuk kolom pertama -->
                                <td class="w-2/8 p-3 text-sm font-medium whitespace-nowrap">
                                    Total Perkiraan
                                </td>
                                <!-- 10% lebar untuk kolom kedua -->
                                <td class="w-1/10 p-1 text-sm text-gray-500 text-center whitespace-nowrap">
                                    :
                                </td>
                                <!-- 50% lebar untuk kolom ketiga -->
                                <td class="w-1/2 p-3 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $data->weight }} Kg
                                </td>
                            </tr>

                            <tr class="bg-white">
                                <!-- 40% lebar untuk kolom pertama -->
                                <td class="w-2/8 p-3 text-sm font-medium whitespace-nowrap">
                                    Total Perkiraan
                                </td>
                                <!-- 10% lebar untuk kolom kedua -->
                                <td class="w-1/10 p-1 text-sm text-gray-500 text-center whitespace-nowrap">
                                    :
                                </td>
                                <!-- 50% lebar untuk kolom ketiga -->
                                <td class="w-1/2 p-3 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $data->total_weight ? $data->total_weight ." Kg" : "-" }}
                                </td>
                            </tr>

                            <tr class="bg-white">
                                <!-- 40% lebar untuk kolom pertama -->
                                <td class="w-2/8 p-3 text-sm font-medium whitespace-nowrap">
                                    Rincian
                                </td>
                                <!-- 10% lebar untuk kolom kedua -->
                                <td class="w-1/10 p-1 text-sm text-gray-500 text-center whitespace-nowrap">
                                    :
                                </td>
                                <!-- 50% lebar untuk kolom ketiga -->
                                <td class="w-1/2 p-3 text-sm text-gray-500 whitespace-nowrap">
                                    @foreach($data->details as $detail)
                                        {{ $detail->quantity ? $detail->quantity . "Kg" : ""}} {{$detail->category->sub_category}}
                                        @if($detail->sub_price)
                                            <span
                                                class="text-end "><?= 'Rp.' . number_format($detail->sub_price, 0, ',', '.'); ?></span>
                                        @endif
                                        <br>
                                    @endforeach
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <!-- 40% lebar untuk kolom pertama -->
                                <td class="w-2/8 p-3 text-sm font-medium whitespace-nowrap">
                                    Total Point
                                </td>
                                <!-- 10% lebar untuk kolom kedua -->
                                <td class="w-1/10 p-1 text-sm text-gray-500 text-center whitespace-nowrap">
                                    :
                                </td>
                                <!-- 50% lebar untuk kolom ketiga -->
                                <td class="w-1/2 p-3 text-sm text-gray-500 whitespace-nowrap">
                                    <?php if ($data->total_point != null){ ?>
                                        <?= 'Rp.' . number_format($data->total_point, 0, ',', '.'); ?>
                                    <?php }else{ ?>
                                    -
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <!-- 40% lebar untuk kolom pertama -->
                                <td class="w-2/8 p-3 text-sm font-medium whitespace-nowrap">
                                    Untuk User
                                </td>
                                <!-- 10% lebar untuk kolom kedua -->
                                <td class="w-1/10 p-1 text-sm text-gray-500 text-center whitespace-nowrap">
                                    :
                                </td>
                                <!-- 50% lebar untuk kolom ketiga -->
                                <td class="w-1/2 p-3 text-sm text-gray-500 whitespace-nowrap">
                                    <?php
                                    $profit = DB::table('share_profit_' . $type)->first();
                                    $for_user = $data->total_point * $profit->for_user / 100;
                                    $for_company = $data->total_point * $profit->for_company / 100;
                                    $for_partner = $data->total_point * $profit->for_partner / 100;
                                    ?>

                                    <?php if ($data->total_point != null){ ?>
                                        <?= 'Rp.' . number_format($for_user, 0, ',', '.'); ?>
                                    <?php }else{ ?>
                                    -
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <!-- 40% lebar untuk kolom pertama -->
                                <td class="w-2/8 p-3 text-sm font-medium whitespace-nowrap">
                                    Untuk Mitra
                                </td>
                                <!-- 10% lebar untuk kolom kedua -->
                                <td class="w-1/10 p-1 text-sm text-gray-500 text-center whitespace-nowrap">
                                    :
                                </td>
                                <!-- 50% lebar untuk kolom ketiga -->
                                <td class="w-1/2 p-3 text-sm text-gray-500 whitespace-nowrap">

                                    <?php if ($data->total_point != null){ ?>
                                        <?= 'Rp.' . number_format($for_partner, 0, ',', '.'); ?>
                                    <?php }else{ ?>
                                    -
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <!-- 40% lebar untuk kolom pertama -->
                                <td class="w-2/8 p-3 text-sm font-medium whitespace-nowrap">
                                    Untuk Perusahaan
                                </td>
                                <!-- 10% lebar untuk kolom kedua -->
                                <td class="w-1/10 p-1 text-sm text-gray-500 text-center whitespace-nowrap">
                                    :
                                </td>
                                <!-- 50% lebar untuk kolom ketiga -->
                                <td class="w-1/2 p-3 text-sm text-gray-500 whitespace-nowrap">

                                    <?php if ($data->total_point != null){ ?>
                                        <?= 'Rp.' . number_format($for_company, 0, ',', '.'); ?>
                                    <?php }else{ ?>
                                    -
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <!-- 40% lebar untuk kolom pertama -->
                                <td class="w-2/8 p-3 text-sm font-medium whitespace-nowrap">
                                    Tgl. Jemput
                                </td>
                                <!-- 10% lebar untuk kolom kedua -->
                                <td class="w-1/10 p-1 text-sm text-gray-500 text-center whitespace-nowrap">
                                    :
                                </td>
                                <!-- 50% lebar untuk kolom ketiga -->
                                <td class="w-1/2 p-3 text-sm text-gray-500 whitespace-nowrap">

                                    @if($data->date_pick)
                                        {{date('d M Y - H:i:s', strtotime($data->date_pick))}}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr class="bg-white">
                                <!-- 40% lebar untuk kolom pertama -->
                                <td class="w-2/8 p-3 text-sm font-medium whitespace-nowrap">
                                    Nama Mitra
                                </td>
                                <!-- 10% lebar untuk kolom kedua -->
                                <td class="w-1/10 p-1 text-sm text-gray-500 text-center whitespace-nowrap">
                                    :
                                </td>
                                <!-- 50% lebar untuk kolom ketiga -->
                                <td class="w-1/2 p-3 text-sm text-gray-500 whitespace-nowrap">
                                    @if($data->partner_id)
                                        <a class="text-blue-500 hover:underline"
                                           href="{{ route('partners.show', $data->partner_id) }}">
                                            {{ $data->partner->name }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!--end card-->
                </div><!--end col-->
            </div>
        </div>
    </div>
@endsection

