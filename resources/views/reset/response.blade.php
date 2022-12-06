<x-sessions-layout class="w-full min-h-screen">
    <div class="flex flex-col w-[90%] lg:w-[25rem] m-auto relative h-screen">
        <header class = "self-start lg:self-center lg:px-28 my-6">
            <div class = "flex items-center gap-10">
                <img src="{{asset('images/logo.png')}}" class = "mb-10 lg:mb-14 lg:mt-10" />
                <x-change-language :route="request()->route()->getName()"/>
            </div>
        </header>
        <div class = "px-4 lg:px-28 w-full flex flex-col m-auto gap-4 items-center mt-48 text-center">
            <img class = "w-14" src="{{asset('images/confirm.png')}}">
            
            <div class = "flex flex-col gap-24">
                <p class = "text-black lg:text-lg lg:w-96">@lang('passwords.reset')</p>
                <a 
                    href="{{route('login-user', [app()->getLocale()])}}"
                    class = "absolute bottom-10 w-full left-0 lg:relative bg-green-500 rounded-lg py-4 text-white text-sm font-black lg:text-base"
                >
                    @lang('register.signin')
                </a>
            </div>
        </div>
    </div>
</x-sessions-layout>