<div class = "form">
    <img src="{{ asset('images/landing.png') }}" class = "image">
    <div class = "header">
        <h1 class = "title">@lang('reset.email-title')</h1>
        <p class = "desc">@lang('reset.email-description')</p>
    </div>
    <a 
        href = "{{route('reset-edit', [app()->getLocale(), $url, $email])}}"
        type="submit" 
        class = "button"
    >
        @lang('reset.email-button')
    </a>
</div>
