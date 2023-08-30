@extends('../layouts/' . $layout)

@section('subhead')
<title>Dashboard - Admin</title>
@endsection
@section('header1','Dashboard')
@section('subcontent')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-9">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="flex items-center h-10 intro-y">
                    <h2 class="mr-5 text-lg font-medium truncate">General Report</h2>
                    <a class="flex items-center ml-auto text-primary" href="">
                        <x-base.lucide class="w-4 h-4 mr-3" icon="RefreshCcw" /> Reload Data
                    </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 intro-y sm:col-span-6 xl:col-span-3">
                        <div @class([ 'relative zoom-in' , 'before:content-[\' \'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70', ])>
                            <div class="p-5 box">
                                <div class="flex">
                                    <x-base.lucide class="h-[28px] w-[28px] text-primary" icon="Substruction" />

                                </div>
                                <div class="mt-6 text-3xl font-medium leading-8">{{ $frais }}</div>
                                <div class="mt-1 text-base text-slate-500">Total Frais</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-6 mt-5">

                    <div class="col-span-12 mt-8 sm:col-span-6 lg:col-span-3">
                        <div class="flex items-center h-10 intro-y">
                            <h2 class="mr-5 text-lg font-medium truncate">Details Paiement Frais</h2>

                        </div>
                        <div class="p-5 mt-5 intro-y box">
                            <div class="mt-3">
                                <x-report-pie-chart.paiemetFrais height="h-[213px]" />
                            </div>
                            <div class="mx-auto mt-8 w-52 sm:w-auto">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 mr-3 rounded-full bg-pending"></div>
                                    <span class="truncate">Pending</span>
                                    <span class="ml-auto font-medium">{{ number_format($percenatageOfPendingFrais, 0) }} %</span>
                                </div>

                                <div class="flex items-center mt-4">
                                    <div class="w-2 h-2 mr-3 rounded-full bg-danger"></div>
                                    <span class="truncate">Unpaid</span>
                                    <span class="ml-auto font-medium">{{ number_format($percenatageOfUnpaidFrais, 0) }} %</span>
                                </div>
                                <div class="flex items-center mt-4">
                                    <div class="w-2 h-2 mr-3 rounded-full bg-info"></div>
                                    <span class="truncate">Paid</span>
                                    <span class="ml-auto font-medium">{{ number_format($percenatageOfPaidFrais, 0) }} %</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 mt-8 sm:col-span-6 lg:col-span-3">
                        <div class="flex items-center h-10 intro-y">
                            <h2 class="mr-5 text-lg font-medium truncate">Details Verefication Frais</h2>

                        </div>
                        <div class="p-5 mt-5 intro-y box">

                                <div class="mt-3">
                                    <x-report-pie-chart.VerifyByDTFrais height="h-[213px]" />
                                </div>
                                <div class="mt-3">
                                    <x-report-pie-chart.VerifyByPMFrais height="h-[213px]" />
                                </div>

                            <div class="mx-auto mt-8 w-52 sm:w-auto">

                                <div class="flex items-center mt-4">
                                    <div class="w-2 h-2 mr-3 rounded-full bg-warning"></div>
                                    <span class="truncate">Unverified by DT</span>
                                    <span class="ml-auto font-medium">{{ number_format($percenatageOfUnverifiedByDTFrais, 0) }} %</span>
                                </div>
                                <div class="flex items-center mt-4">
                                    <div class="w-2 h-2 mr-3 rounded-full bg-primary"></div>
                                    <span class="truncate">Verified by DT</span>
                                    <span class="ml-auto font-medium">{{ number_format($percenatageOfVerifiedByDTFrais, 0) }} %</span>
                                </div>
                                <div class="flex items-center mt-4">
                                    <div class="w-2 h-2 mr-3 rounded-full bg-success"></div>
                                    <span class="truncate">Verified by PM</span>
                                    <span class="ml-auto font-medium">{{ number_format($percenatageOfVerifiedByPMFrais, 0) }} %</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    window.pendingFrais = {{$pendingFrais}};
    window.paidFrais = {{ $paidFrais}};
    window.unpaidFrais = {{$unpaidFrais}};
    window.unverifiedByDTFrais = {{$unverifiedByDTFrais}};
    window.verifiedByDTFrais = {{$verifiedByDTFrais}};
    window.verifiedByPMFrais = {{$verifiedByPMFrais}};

</script>

@endsection
