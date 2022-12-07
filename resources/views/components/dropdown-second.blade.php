<div {{$attributes->merge(['class' => 'relative'])}}>
    <label 
        id = "dropdown-2"
        class = "flex items-center cursor-pointer"
    >
        {{app()->getLocale() == 'en' ? 'English' : 'Georgian'}}
        <img class = "w-6" src="/images/down-small.png">
    </label>
    <div 
        id = "box-2" 
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
    const label2 = document.querySelector(`#dropdown-2`);
    const box2 = document.querySelector(`#box-2`);
    show2 = false;
    
    label2.addEventListener('click', event => {
        show2 = !show2;
        if (show2) {
            box2.style.display = "inline-block";
        } else {
            box2.style.display = "none";
        }
    });
</script>


