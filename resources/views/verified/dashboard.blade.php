<x-sessions-layout class="overflow-hidden">
    <header class = "my-6">
        <div class = "flex items-center justify-between gap-10 px-4 lg:hidden">
            <img src="{{asset('images/logo.png')}}">
            <x-dropdown />
            <img 
                src="/images/hamburger.png" 
                class = "w-6"
            />
        </div>
        <div class = "maxLg:hidden flex items-center justify-between gap-10 px-28">
            <img src="{{asset('images/logo.png')}}">
            <form method="post" action="{{route('first-login', [app()->getLocale()])}}" class = "flex gap-4">
                @csrf
                <x-dropdown-second class="mr-6"/>
                <p class = "font-bold text-black">{{auth()->user()->username}}</p>
                <button type = "submit" class = "border-l pl-4">Log Out</button>
            </form>
        </div>
        <hr class = "border-neutral-100 w-screen mr-7 my-6">
        <h1 class = "px-4 lg:px-28 text-xl font-black lg:text-2xl lg:mb-4 lg:whitespace-nowrap">Worldwide Statistics</h1>
    </header>

    <section class = "px-4 lg:px-28">
        <div class = "flex gap-6 items-center">
           <x-change-panel />
        </div>
        <hr class = "border-neutral-100 w-screen my-6">
    </section>
    @if (request()['panel'] == 'worldwide')
        <section class="flex px-4 lg:px-28 w-full flex-wrap lg:flex-nowrap gap-4">
            <div class = "gap-4 w-full lg:w-[40%] lg:text-xl bg-lightBlue h-52 lg:h-64 rounded-2xl flex flex-col justify-center items-center">
                <img src="/images/blue-line.png" class = "w-24">
                New cases
                <p class = "text-2xl lg:text-4xl font-black text-blue-700">000,000</p>
            </div>
            <div class = "gap-4 grow w-[40%] lg:text-xl bg-lightGreen h-52 lg:h-64 rounded-2xl flex flex-col justify-center items-center">
                <img src="/images/green-line.png" class = "w-24">
                Recovered
                <p class = "text-2xl lg:text-4xl font-black text-green-500">000,000</p>
            </div>
            <div class = "gap-4 grow w-[40%] lg:text-xl bg-lightYellow h-52 lg:h-64 rounded-2xl flex flex-col justify-center items-center">
                <img src="/images/yellow-line.png" class = "w-24">
                Death
                <p class = "text-2xl lg:text-4xl font-black text-yellow-400">000,000</p>
            </div>
        </section>
    @endif
</x-sessions-layout>