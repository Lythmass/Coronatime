@if (request()->route()->getName() == 'login-user')
    <p class = "self-center text-zinc-500">{!!$text!!} <span class = "text-black font-bold"><a href = "{{route('create-user', [app()->getLocale()])}}"> {{$action}}</a></span> </p>
@else
    <p class = "self-center text-zinc-500">{!!$text!!} <span class = "text-black font-bold"><a href = "{{route('login-user', [app()->getLocale()])}}"> {{$action}}</a></span> </p>
@endif
