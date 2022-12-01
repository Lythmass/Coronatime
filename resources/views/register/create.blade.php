<x-sessions-layout class="w-full lg:flex lg:justify-between min-h-screen">
    <div class = "px-4 lg:px-28">
        <header class = "my-6">
            <div class = "flex items-center gap-10">
                <img src="{{asset('images/logo.png')}}" class = "mb-10 lg:mb-14 lg:mt-10">
                <div class = "flex gap-2 mb-10 lg:mb-14 lg:mt-10">
                    @if (app()->getLocale() == 'en')
                        <a class = "text-white font-semibold bg-green-500 px-1 rounded" href = "{{route('create-user', ['en'])}}">en</a>
                        <a class = "text-green-500 font-semibold px-1" href = "{{route('create-user', ['ka'])}}">ka</a>
                    @else
                        <a class = "text-green-500 font-semibold px-1" href = "{{route('create-user', ['en'])}}">en</a>
                        <a class = "text-white font-semibold bg-green-500 px-1 rounded" href = "{{route('create-user', ['ka'])}}">ka</a>
                    @endif
                </div>
            </div>
            <h1 class = "text-xl font-black lg:text-2xl lg:mb-4 lg:whitespace-nowrap">@lang('register.welcome')</h1>
            <p class = "text-zinc-500 lg:text-xl lg:whitespace-nowrap">@lang('register.enter-info')</p>
        </header>
    
        <form class = "lg:w-[24.5rem]" action="{{route('create-user', [app()->getLocale()])}}" method="post">
            @csrf
            <div class = "flex flex-col gap-4 lg:gap-6 items-center w-full m-auto">
                <x-session-input title="{{__('register.username')}}" field="username" type="text" placeholder="{{__('register.enter-username')}}"/>
                <x-session-input title="{{__('register.email')}}" field="email" type="email" placeholder="{{__('register.enter-email')}}"/>
                <x-session-input title="{{__('register.password')}}" field="password" type="password" placeholder="{{__('register.enter-password')}}"/>
                <x-session-input title="{{__('register.repeat-password')}}" field="password_confirmation" type="password" placeholder="{{__('register.enter-password')}}"/>
            </div>
            <div class = "flex flex-col gap-6 w-full m-auto mt-6">
                <x-session-checkbox title="{{__('register.remember')}}" field="remember"/>
                <x-session-button action="{{__('register.signup')}}"/>
                <x-session-link text="{{__('register.ask')}}" action="{{__('register.login')}}"/>
            </div>
        </form>
    </div>
    <img id = "corona-image" src="{{asset('images/image.png')}}" class = "hidden lg:inline-block">
</x-sessions-layout>