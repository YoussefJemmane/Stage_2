@extends('../layouts/' . $layout)

@section('head')
<title>Login - Midone - Tailwind HTML Admin Template</title>
@endsection

@section('content')
<div @class([ '-m-3 sm:-mx-8 p-3 sm:px-8 relative h-screen lg:overflow-hidden bg-primary xl:bg-white dark:bg-darkmode-800 xl:dark:bg-darkmode-600' , 'before:hidden before:xl:block before:content-[\' \'] before:w-[57%] before:-mt-[28%] before:-mb-[16%] before:-ml-[13%] before:absolute before:inset-y-0 before:left-0 before:transform before:rotate-[-4.5deg] before:bg-primary/20 before:rounded-[100%] before:dark:bg-darkmode-400', 'after:hidden after:xl:block after:content-[\' \'] after:w-[57%] after:-mt-[20%] after:-mb-[13%] after:-ml-[13%] after:absolute after:inset-y-0 after:left-0 after:transform after:rotate-[-4.5deg] after:bg-primary after:rounded-[100%] after:dark:bg-darkmode-700', ])>
    <x-dark-mode-switcher />
    <x-main-color-switcher />
    <div class="container relative z-10 sm:px-10">
        <div class="block grid-cols-2 gap-4 xl:grid">
            <!-- BEGIN: Login Info -->
            <div class="flex-col hidden min-h-screen xl:flex">
                <a class="flex items-center pt-5 -intro-x" href="">
                    <img class="w-6" src="{{ Vite::asset('resources/images/Layer-1.png') }}" alt="Midone Tailwind HTML Admin Template" />
                    <span class="ml-3 text-lg text-white"> SIB </span>
                </a>
                <div class="my-auto">
                    <img class="w-1/2 -mt-16 -intro-x" src="{{ Vite::asset('resources/images/illustration.svg') }}" alt="Midone Tailwind HTML Admin Template" />
                    <div class="mt-10 text-4xl font-medium leading-tight text-white -intro-x">
                        A few more clicks to <br />
                        sign in to your account.
                    </div>
                    <div class="mt-5 text-lg text-white -intro-x text-opacity-70 dark:text-slate-400">
                        Manage all your e-commerce accounts in one place
                    </div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="flex h-screen py-5 my-10 xl:my-0 xl:h-auto xl:py-0">
                <div class="w-full px-5 py-8 mx-auto my-auto bg-white rounded-md shadow-md dark:bg-darkmode-600 sm:w-3/4 sm:px-8 lg:w-2/4 xl:ml-20 xl:w-auto xl:bg-transparent xl:p-0 xl:shadow-none">
                    <h2 class="text-2xl font-bold text-center intro-x xl:text-left xl:text-3xl">
                        Sign In
                    </h2>
                    <div class="mt-2 text-center intro-x text-slate-400 xl:hidden">
                        A few more clicks to sign in to your account. Manage all your
                        e-commerce accounts in one place
                    </div>
                    <div class="mt-8 intro-x">
                        <x-base.form-input class="intro-x block min-w-full px-4 py-3 xl:min-w-[350px]" type="text" placeholder="Email" />
                        <x-base.form-input class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]" type="password" placeholder="Password" />
                    </div>
                    <div class="flex mt-4 text-xs intro-x text-slate-600 dark:text-slate-500 sm:text-sm">
                        <div class="flex items-center mr-auto">
                            <x-base.form-check.input class="mr-2 border" id="remember-me" type="checkbox" />
                            <label class="cursor-pointer select-none" for="remember-me">
                                Remember me
                            </label>
                        </div>
                        <a href="">Forgot Password?</a>
                    </div>
                    <div class="mt-5 text-center intro-x xl:mt-8 xl:text-left">
                        <x-base.button class="w-full px-4 py-3 align-top xl:mr-3 xl:w-32" variant="primary">
                            Login
                        </x-base.button>
                        <x-base.button class="w-full px-4 py-3 mt-3 align-top xl:mt-0 xl:w-32" variant="outline-secondary">
                            Register
                        </x-base.button>
                    </div>
                    <div class="mt-10 text-center intro-x text-slate-600 dark:text-slate-500 xl:mt-24 xl:text-left">
                        By signin up, you agree to our
                        <a class="text-primary dark:text-slate-200" href="">
                            Terms and Conditions
                        </a>
                        &
                        <a class="text-primary dark:text-slate-200" href="">
                            Privacy Policy
                        </a>
                    </div>
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
</div>
@endsection
