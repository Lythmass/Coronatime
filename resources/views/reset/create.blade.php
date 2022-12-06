<x-sessions-layout class="w-full lg:flex lg:justify-between min-h-screen px-4 lg:px-28">
    <div class = "my-6 lg:flex lg:flex-col lg:w-full lg:items-center lg:gap-36">
        <div class = "flex items-center gap-10 lg:justify-center lg:w-full">
            <img src="{{asset('images/logo.png')}}" class = "mb-10 lg:mb-14 lg:mt-10">
            <x-change-language :route="request()->route()->getName()"/>
        </div>
        <form action = "{{route('password.email', [app()->getLocale()])}}" class = "w-full lg:w-96 flex flex-col gap-96 lg:gap-10" method="post">
            @csrf
            <div class = "flex flex-col items-center w-full gap-10 m-auto">
                <h1 class = "text-xl font-black lg:text-2xl lg:mb-4 lg:whitespace-nowrap">@lang('reset.reset')</h1>
                <x-session-input title="{{__('reset.email')}}" field="email" type="email" placeholder="{{__('reset.enter-email')}}"/>
            </div>
            <x-session-button action="{{__('reset.reset')}}"/>
        </form>
    </div>

</x-sessions-layout>