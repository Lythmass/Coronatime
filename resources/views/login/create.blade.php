<x-sessions-layout class="w-full lg:flex lg:justify-between min-h-screen">
    <div class = "px-4 lg:px-28">
        <header class = "my-6">
            <div class = "flex items-center gap-10">
                <img src="{{asset('images/logo.png')}}" class = "mb-10 lg:mb-14 lg:mt-10">
                <x-change-language :route="request()->route()->getName()"/>
            </div>
            <h1 class = "text-xl font-black lg:text-2xl lg:mb-4 lg:whitespace-nowrap">@lang('login.welcome')</h1>
            <p class = "text-zinc-500 lg:text-xl lg:whitespace-nowrap">@lang('login.enter-info')</p>
        </header>
    
        <form class = "lg:w-[24.5rem]" action="{{route('create-user', [app()->getLocale()])}}" method="post">
            @csrf
            <div class = "flex flex-col gap-4 lg:gap-6 items-center w-full m-auto">
                <x-session-input title="{{__('login.username')}}" field="username" type="text" placeholder="{{__('login.enter-username')}}"/>
                <x-session-input title="{{__('login.password')}}" field="password" type="password" placeholder="{{__('login.enter-password')}}"/>
            </div>
            <div class = "flex flex-col gap-6 w-full m-auto mt-6">
                <div class = "flex justify-between">
                    <x-session-checkbox title="{{__('login.remember')}}" field="remember"/>
                    <a class = "text-sm text-center text-blue-700 font-semibold" href="#">@lang('login.forget')</a>
                </div>
                <x-session-button action="{{__('login.signup')}}"/>
                <x-session-link text="{{__('login.ask')}}" action="{{__('login.signup')}}"/>
            </div>
        </form>
    </div>
    <img id = "corona-image" src="{{asset('images/image.png')}}" class = "hidden lg:inline-block">
</x-sessions-layout>