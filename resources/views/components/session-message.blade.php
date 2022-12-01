<x-sessions-layout class="w-full lg:flex lg:justify-between min-h-screen">
    <div class="flex flex-col items-center w-full">
        <header class = "self-start lg:self-center px-4 lg:px-28 my-6">
            <div class = "flex items-center gap-10">
                <img src="{{asset('images/logo.png')}}" class = "mb-10 lg:mb-14 lg:mt-10" />
                <x-change-language :route="request()->route()->getName()"/>
            </div>
        </header>
        <div class = "px-4 lg:px-28 w-full m-auto flex flex-col gap-4 items-center mt-48 text-center">
            <img class = "w-14" src="{{asset('images/confirm.png')}}">
            <p class = "text-black lg:text-lg">{{ $slot }}</p>
        </div>
    </div>
</x-sessions-layout>