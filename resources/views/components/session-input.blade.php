
<div {{ $attributes->merge(['class' => 'flex flex-col gap-2 w-full']) }}>
    <label 
        for="{{$field}}"
        class = "text-sm font-bold lg:text-base"
    >
        {{ $title }}
    </label>
    <input 
        type="{{$type}}" 
        id = '{{$field}}' 
        name = '{{$field}}' 
        placeholder="{{$placeholder}}" 
        autocomplete="off"
        value='{{old($field)}}'
        class = "py-4 outline-none rounded-lg border border-color-neutral-200 px-6 focus:border-blue-700 focus:shadow-smooth"
    >
    @error($field)
        <div class = "flex gap-2 items-center">
            <img class="w-6" src="images/error.png" >
            <p class = "text-red-700">{{$message}}</p>
        </div>
        <script>
            var id = {{ Js::from($field) }}
            document.querySelector(`#${id}`).style.borderColor = '#CC1E1E';
        </script>
    @enderror
</div>