<x-sessions-layout class="w-full lg:flex px-4 lg:px-28">
    <div class = "my-6 flex flex-col w-full items-center lg:gap-36">
        <div class = "flex items-center gap-10 lg:justify-center lg:w-full">
            <img src="{{asset('images/logo.png')}}" class = "mb-10 lg:mb-14 lg:mt-10">
            <x-change-language :route="request()->route()->getName()"/>
        </div>
        <form method="post" action = "{{route('password.update', [app()->getLocale()])}}" class = "w-full lg:w-96 flex flex-col gap-64 lg:gap-10">
            @csrf
            <input type="hidden" name="token" id="token" value="{{$token}}">
            <input type="hidden" name="email" id="email" value="{{$email}}">
            <div class = "flex flex-col items-center w-full gap-4 m-auto">
                <h1 class = "text-xl font-black lg:text-2xl lg:mb-4 lg:whitespace-nowrap mb-10">@lang('reset.reset')</h1>
                <x-session-input title="{{__('register.password')}}" field="password" type="password" placeholder="{{__('register.enter-password')}}"/>
                <x-session-input title="{{__('register.repeat-password')}}" field="password_confirmation" type="password" placeholder="{{__('register.repeat-password')}}"/>
            </div>
            <x-session-button action="{{__('reset.save')}}"/>
        </form>
    </div>

</x-sessions-layout>