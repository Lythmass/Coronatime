
<div {{ $attributes->merge(['class' => 'flex flex-col gap-2 w-full']) }}>
    <label 
        for="{{$field}}"
        class = "text-sm font-bold"
    >
        {{ $title }}
    </label>
    <input 
        type="{{$type}}" 
        id = '{{$field}}' 
        name = '{{$field}}' 
        placeholder="{{$placeholder}}" 
        autocomplete="off"
        class = "py-4 rounded-lg border border-color-neutral-200 px-6"
    >
</div>