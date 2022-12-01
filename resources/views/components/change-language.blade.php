<div class = "flex gap-2 mb-10 lg:mb-14 lg:mt-10">
    @if (app()->getLocale() == 'en')
        <a class = "text-white font-semibold bg-green-500 px-1 rounded" href = "{{route('create-user', ['en'])}}">en</a>
        <a class = "text-green-500 font-semibold px-1" href = "{{route($route, ['ka'])}}">ka</a>
    @else
        <a class = "text-green-500 font-semibold px-1" href = "{{route($route, ['en'])}}">en</a>
        <a class = "text-white font-semibold bg-green-500 px-1 rounded" href = "{{route('create-user', ['ka'])}}">ka</a>
    @endif
</div>