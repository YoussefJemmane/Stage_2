@extends('../layouts/' . $layout)

@section('head')
    <title>Error Page - SIB</title>
@endsection

@section('content')
    <div class="py-2">

        <div class="container">
            <!-- BEGIN: Error Page -->
            <div class="flex flex-col items-center justify-center h-screen text-center error-page lg:flex-row lg:text-left">
                <div class="-intro-x lg:mr-20">
                    <img
                        class="h-48 w-[450px] lg:h-auto"
                        src="{{ Vite::asset('resources/images/error-illustration.svg') }}"
                        alt="Midone Tailwind HTML Admin Template"
                    />
                </div>
                <div class="mt-10 lg:mt-0">
                    <div class="font-medium intro-x text-8xl">404</div>
                    <div class="mt-5 text-xl font-medium intro-x lg:text-3xl">
                        Oops. This page has gone missing.
                    </div>
                    <div class="mt-3 text-lg intro-x">
                        You may have mistyped the address or the page may have moved.
                    </div>
                        <a
                            href="{{ route('dashboard') }}"
                            class="px-4 py-3 mt-10 rounded-md bg-theme-1 dark:bg-darkmode-400 dark:text-slate-200"
                        >
                            <x-base.button
                            class="px-4 py-3 mt-10 border-gray-300 intro-x dark:border-darkmode-400 dark:text-slate-200"
                            >
                            Back to Home
                        </x-base.button>
                    </a>
                </div>
            </div>
            <!-- END: Error Page -->
        </div>
    </div>
@endsection
