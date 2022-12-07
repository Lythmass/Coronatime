<x-sessions-layout class="overflow-x-hidden pb-12">
    <header class = "my-6">
        <div class = "flex items-center justify-between flex-wrap gap-10 px-4 lg:hidden relative">
            <img src="{{asset('images/logo.png')}}">
            <x-dropdown />
            <input type="checkbox" id="hamburger" class = "hidden">
            <label id="img" for="hamburger" class = "cursor-pointer">
                <img 
                    src="/images/hamburger.png" 
                    class = "w-6"
                />
            </label>
            <div id = "menu" class = "w-full h-full bg-white absolute left-0 top-0">
                <form method="post" action="{{route('first-login', [app()->getLocale()])}}" class = "w-full flex items-center gap-4 justify-center">
                    @csrf
                    <p class = "font-bold text-black">{{auth()->user()->username}}</p>
                    <button type = "submit" class = "border-l pl-4">@lang('dashboard.logout')</button>
                    <div id = "close" class = "absolute top-1/2 translate-y-[-50%] right-4 cursor-pointer">X</div>
                </form>
            </div>
            <script>
                menu = document.querySelector('#menu');
                close = document.querySelector('#close');
                img = document.querySelector('#img');
                hamburger = document.querySelector('#hamburger');

                close.checked = false;
                hamburger.checked = false;
                menu.style.display = "none";


                hamburger.addEventListener('change', event => {
                    if (event.target.checked) {
                        menu.style.display = "flex";
                    } else {
                        menu.style.display = "none";
                    }
                });
                
                close.addEventListener('click', event => {
                    if (menu.style.display == 'flex') {
                        menu.style.display = "none";
                        hamburger.checked = false;
                    } else {
                        menu.style.display = "flex";
                    }
                })
            </script>
        </div>
        <div class = "maxLg:hidden flex items-center justify-between gap-10 px-28">
            <img src="{{asset('images/logo.png')}}">
            <form method="post" action="{{route('first-login', [app()->getLocale()])}}" class = "flex gap-4">
                @csrf
                <x-dropdown-second class="mr-6"/>
                <p class = "font-bold text-black">{{auth()->user()->username}}</p>
                <button type = "submit" class = "border-l pl-4">@lang('dashboard.logout')</button>
            </form>
        </div>
        <hr class = "border-neutral-100 w-screen mr-7 my-6">
        <h1 class = "px-4 lg:px-28 text-xl font-black lg:text-2xl lg:mb-4 lg:whitespace-nowrap">@lang('dashboard.title')</h1>
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
                <p class = "break-all text-center">@lang('dashboard.newcases')</p>
                <p class = "text-2xl lg:text-4xl font-black text-blue-700">{{$newCases}}</p>
            </div>
            <div class = "gap-4 grow w-[40%] lg:text-xl bg-lightGreen h-52 lg:h-64 rounded-2xl flex flex-col justify-center items-center">
                <img src="/images/green-line.png" class = "w-24">
                <p class = "break-all text-center">@lang('dashboard.recovered')</p>
                <p class = "text-2xl lg:text-4xl font-black text-green-500">{{$recovered}}</p>
            </div>
            <div class = "gap-4 grow w-[40%] lg:text-xl bg-lightYellow h-52 lg:h-64 rounded-2xl flex flex-col justify-center items-center">
                <img src="/images/yellow-line.png" class = "w-24">
                <p class = "break-all text-center">@lang('dashboard.death')</p>
                <p class = "text-2xl lg:text-4xl font-black text-yellow-400">{{$death}}</p>
            </div>
        </section>
    @endif
</x-sessions-layout>