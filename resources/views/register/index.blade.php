<x-sessions-layout class="w-full">

    <header class = "my-6 ml-4">
        <img src="images/logo.png" class = "mb-10">
        <h1 class = "text-xl font-black">Welcome to Coronatime</h1>
        <p class = "text-zinc-500">Please enter required info to sign up</p>
    </header>

    <form action="" method="post">
        @csrf
        <div class = "flex flex-col gap-4 items-center w-full m-auto px-4">
            <x-session-input title="Username" field="username" type="text" placeholder="Enter unique username"/>
            <x-session-input title="Email" field="email" type="email" placeholder="Enter your email"/>
            <x-session-input title="Password" field="password" type="password" placeholder="Fill in password"/>
            <x-session-input title="Repeat password" field="password" type="password" placeholder="Repeat password"/>
        </div>
        <div class = "flex flex-col gap-6 w-full m-auto px-4 mt-6">
            <x-session-checkbox title="Remember this device" field="remember"/>
            <x-session-button action="SIGN UP"/>
            <x-session-link text="Already have an account?" action="Log in"/>
        </div>
    </form>



</x-sessions-layout>