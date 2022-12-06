<div class = "flex gap-2 mb-10 lg:mb-14 lg:mt-10">
    @if (app()->getLocale() == 'en')
        <a class = "text-white font-semibold bg-green-500 px-1 rounded" href = "{{route($route, ['en', 'token' => request()->route('token'), 'email' => request()->route('email')])}}">en</a>
        <a class = "text-green-500 font-semibold px-1" href = "{{route($route, ['ka', 'token' => request()->route('token'), 'email' => request()->route('email')])}}">ka</a>
    @else
        <a class = "text-green-500 font-semibold px-1" href = "{{route($route, ['en', 'token' => request()->route('token'), 'email' => request()->route('email')])}}">en</a>
        <a class = "text-white font-semibold bg-green-500 px-1 rounded" href = "{{route($route, ['ka', 'token' => request()->route('token'), 'email' => request()->route('email')])}}">ka</a>
    @endif
</div>