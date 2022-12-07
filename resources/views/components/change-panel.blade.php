@if (request()['panel'] != 'bycountry')
    <a 
        href = "{{route(request()->route()->getName(), [app()->getLocale(), 'worldwide'])}}" 
        class = "text-sm lg:text-base font-bold h-1 translate-y-[-0.5rem] shadow-shadow-border">Worldwide
    </a>
    <a 
        href = "{{route(request()->route()->getName(), [app()->getLocale(), 'bycountry'])}}" 
        class = "text-sm lg:text-base">By Country
    </a>
@elseif((request()['panel'] == 'bycountry'))
    <a 
        href = "{{route(request()->route()->getName(), [app()->getLocale(), 'worldwide'])}}" 
        class = "text-sm lg:text-base">Worldwide
    </a>
    <a 
        href = "{{route(request()->route()->getName(), [app()->getLocale(), 'bycountry'])}}/" 
        class = "text-sm lg:text-base font-bold h-1 translate-y-[-0.5rem] shadow-shadow-border">By Country
    </a>
@endif