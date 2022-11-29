<div class = "flex gap-2 items-center">    
    <input 
        type="checkbox" 
        id = "{{$field}}"
        class = "focus:outline-none rounded-[0.25rem] w-5 h-5 border border-neutral-200 appearance-none bg-no-repeat bg-center bg-contain checked:bg-[url('/public/images/check.png')]"
        onClick = 'check({{$field}})'
    >
    <label 
        for="{{$field}}"
    >
        {{$title}}
    </label>
</div>