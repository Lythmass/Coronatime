<div {{$attributes->merge(['class' => 'relative'])}}>
    <label 
        id = "dropdown"
        class = "flex items-center cursor-pointer"
    >
        {{app()->getLocale() == 'en' ? 'English' : 'Georgian'}}
        <img class = "w-6" src="/images/down-small.png">
    </label>
    <div 
        id = "box" 
        class = "absolute left-0 hidden cursor-pointer"
    >
        <a
            class = "text-neutral-500"
            href = "{{ route(request()->route()->getName(), [app()->getLocale() != 'en' ? 'en' : 'ka', 'worldwide']) }}"
        >
            {{app()->getLocale() != 'en' ? 'English' : 'Georgian'}}
        </a>
    </div>
</div>
<script>
    const label = document.querySelector(`#dropdown`);
    const box = document.querySelector(`#box`);
    show = false;
    
    label.addEventListener('click', event => {
        show = !show;
        if (show) {
            box.style.display = "inline-block";
        } else {
            box.style.display = "none";
        }
    });
</script>


