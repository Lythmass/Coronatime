<x-session-message>
    <form action="{{route('first-login', [app()->getLocale()])}}" method="post" class = "flex flex-col gap-24">
        @lang('register.confirmed')
        @csrf
        <x-session-button action="{{__('register.signin')}}"/>
    </form>
</x-session-message>