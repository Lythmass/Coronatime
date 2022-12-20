
<form class = "form">
    <img src="{{ asset('images/landing.png') }}" class = "image">
    <div class = "header">
        <h1 class = "title">@lang('register.email-title')</h1>
        <p class = "desc">@lang('register.email-description')</p>
    </div>
    <a
        href = "{{$url}}"
        class = "button"
    >
        @lang('register.email-button')
    </a>
</form>
