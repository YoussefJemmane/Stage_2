@props(['layout' => 'side-menu'])

<!-- BEGIN: Top Bar -->
<div @class([ 'h-[70px] md:h-[65px] z-[51] border-b border-white/[0.08] mt-12 md:mt-0 -mx-3 sm:-mx-8 md:-mx-0 px-3 md:border-b-0 relative md:fixed md:inset-x-0 md:top-0 sm:px-8 md:px-10 md:pt-10 md:bg-gradient-to-b md:from-slate-100 md:to-transparent dark:md:from-darkmode-700' , 'dark:md:from-darkmode-800'=> $layout == 'top-menu',
    "before:content-[''] before:absolute before:h-[65px] before:inset-0 before:top-0 before:mx-7 before:bg-primary/30 before:mt-3 before:rounded-xl before:hidden before:md:block before:dark:bg-darkmode-600/30",
    "after:content-[''] after:absolute after:inset-0 after:h-[65px] after:mx-3 after:bg-primary after:mt-5 after:rounded-xl after:shadow-md after:hidden after:md:block after:dark:bg-darkmode-600",
    ])>
    <div class="flex items-center h-full">
        <!-- BEGIN: Logo -->
        <a href="" @class([ '-intro-x hidden md:flex' , 'xl:w-[180px]'=> $layout == 'side-menu',
            'xl:w-auto' => $layout == 'simple-menu',
            'w-auto' => $layout == 'top-menu',
            ])
            >
            <img class="w-6" src="{{ Vite::asset('resources/images/Layer-1.png') }}" alt="SIB Tailwind HTML Admin Template" />
            <span @class([ 'ml-3 text-lg text-white' , 'hidden xl:block'=> $layout == 'side-menu',
                'hidden' => $layout == 'simple-menu',
                ])>

                SIB
            </span>
        </a>
        <!-- END: Logo -->
        <!-- BEGIN: Breadcrumb -->
        <x-base.breadcrumb @class([ 'h-[45px] md:ml-10 md:border-l border-white/[0.08] dark:border-white/[0.08] mr-auto -intro-x' , 'md:pl-6'=> $layout != 'top-menu',
            'md:pl-10' => $layout == 'top-menu',
            ])
            light
            >
            {{-- TODO: add links {{ route('@yield('link')') }}
            -> add condition to show the chevronright just when there is a header2
            --}}
            <x-base.breadcrumb.link :index="0">@yield("header1")</x-base.breadcrumb.link>
            <x-base.lucide class="w-4 h-4" icon="ChevronRight" />
            <x-base.breadcrumb.link :index="0">@yield("header2")</x-base.breadcrumb.link>

        </x-base.breadcrumb>
        <!-- END: Breadcrumb -->


        <!-- BEGIN: Account Menu -->
        <x-base.menu>
            <x-base.menu.button class="block w-8 h-8 overflow-hidden scale-110 rounded-full shadow-lg image-fit zoom-in intro-x">
                <img src="{{ asset('storage/'. Auth::user()->photo ) }}" alt="Midone Tailwind HTML Admin Template" />
            </x-base.menu.button>
            <x-base.menu.items class="relative mt-px w-56 bg-primary/80 text-white before:absolute before:inset-0 before:z-[-1] before:block before:rounded-md before:bg-black">
                <x-base.menu.header class="font-normal">
                    <div class="font-medium">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</div>
                    <div class="mt-0.5 text-xs text-white/70 dark:text-slate-500">
                        {{ Auth::user()->poste }}
                    </div>
                </x-base.menu.header>
                <x-base.menu.divider class="bg-white/[0.08]" />
                @if(Auth::user()->poste !== "CEO")

                <form action="{{ route('employees.editProfile',Auth::user()->id) }}" method="get">
                    @csrf
                    <button type="submit">
                        <x-base.menu.item class="hover:bg-white/5">
                            <x-base.lucide class="w-4 h-4 mr-2" icon="User" />
                            Edit Profile
                        </x-base.menu.item>
                    </button>

                </form>
                @endif
                @if(Auth::user()->poste === "CEO")
                <form action="{{ route('employees.edit',Auth::user()->id) }}" method="get">
                    @csrf
                    <button type="submit">
                        <x-base.menu.item class="hover:bg-white/5">
                            <x-base.lucide class="w-4 h-4 mr-2" icon="User" />
                            Edit Profile
                        </x-base.menu.item>
                    </button>

                </form>
                <form action="{{ route('employees.create') }}" method="get">
                    @csrf
                    <button type="submit">
                        <x-base.menu.item class="hover:bg-white/5">
                            <x-base.lucide class="w-4 h-4 mr-2" icon="Edit" /> Ajouter Employée
                        </x-base.menu.item>

                    </button>

                </form>

                @endif

                <x-base.menu.divider class="bg-white/[0.08]" />
                <form action="{{ route('logout') }}" method="get">
                    @csrf
                    <button type="submit">
                        <x-base.menu.item class="hover:bg-white/5">
                            <x-base.lucide class="w-4 h-4 mr-2" icon="ToggleRight" /> Logout


                        </x-base.menu.item>
                    </button>
                </form>
            </x-base.menu.items>
        </x-base.menu>
        <!-- END: Account Menu -->
    </div>
</div>
<!-- END: Top Bar -->

@once
@push('scripts')
@vite('resources/js/components/top-bar/index.js')
@endpush
@endonce
