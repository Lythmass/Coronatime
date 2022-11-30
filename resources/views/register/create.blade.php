<x-sessions-layout class="w-full lg:flex lg:justify-between min-h-screen">
    <div class = "px-4 lg:px-28">
        <header class = "my-6">
            <img src="images/logo.png" class = "mb-10 lg:mb-14 lg:mt-10">
            <h1 class = "text-xl font-black lg:text-2xl lg:mb-4">Welcome to Coronatime</h1>
            <p class = "text-zinc-500 lg:text-xl">Please enter required info to sign up</p>
        </header>
    
        <form action="{{route('create-user')}}" method="post">
            @csrf
            <div class = "flex flex-col gap-4 lg:gap-6 items-center w-full m-auto">
                <x-session-input title="Username" field="username" type="text" placeholder="Enter unique username"/>
                <x-session-input title="Email" field="email" type="email" placeholder="Enter your email"/>
                <x-session-input title="Password" field="password" type="password" placeholder="Fill in password"/>
                <x-session-input title="Repeat password" field="password_confirmation" type="password" placeholder="Repeat password"/>
            </div>
            <div class = "flex flex-col gap-6 w-full m-auto mt-6">
                <x-session-checkbox title="Remember this device" field="remember"/>
                <x-session-button action="SIGN UP"/>
                <x-session-link text="Already have an account?" action="Log in"/>
            </div>
        </form>
    </div>
    <img id = "corona-image" src="images/image.png" class = "hidden lg:inline-block">
</x-sessions-layout>