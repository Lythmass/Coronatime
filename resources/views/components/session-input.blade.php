
<div {{ $attributes->merge(['class' => 'flex flex-col gap-2 w-full']) }}>
    <label 
        for="{{$field}}"
        class = "text-sm font-bold lg:text-base"
    >
        {{ $title }}
    </label>
    <input
        onchange='validator(event)' 
        type="{{$type}}" 
        id = '{{$field}}' 
        name = '{{$field}}' 
        placeholder="{{$placeholder}}" 
        autocomplete="off"
        value='{{old($field)}}'
        class = "py-4 outline-none rounded-lg border border-color-neutral-200 px-6 focus:border-blue-700 focus:shadow-smooth"
    >
    <div id = "incorrect" class = "hidden">
        <img class="w-6" src="{{asset('images/error.png')}}" >
        <p class = "text-red-700"></p>
    </div>
    @error($field)
        <div class = "flex gap-2 items-center">
            <img class="w-6" src="{{asset('images/error.png')}}" >
            <p class = "text-red-700">{{$message}}</p>
        </div>
        <script>
            var id = {{ Js::from($field) }}
            document.querySelector(`#${id}`).style.borderColor = '#CC1E1E';
        </script>
    @enderror

    <script>
        function validator(event) {
            locale = {{ Js::from(app()->getLocale()) }}
            if (event.target.name == 'username') {
                if (username(event.target.value)) {
                    correct();
                } else {
                    incorrect('username', locale);
                }
            }

            if (event.target.name == 'email') {
                if (email(event.target.value)) {
                    correct();
                } else {
                    incorrect('email', locale);
                }
            }

            if (event.target.name == 'password') {
                if (password(event.target.value)) {
                    correct();
                } else {
                    incorrect('password', locale);
                }
            }

            if (event.target.name == 'password_confirmation') {
                if (passwordConfirmation(event.target.value)) {
                    correct();
                } else {
                    incorrect('password_confirmation', locale);
                }
            }

            function correct() {
                event.target.style.borderColor = '#249E2C';
                document.querySelector(`#${event.target.id} + #incorrect`).setAttribute('class', 'hidden');
                if(document.querySelector(`#${event.target.id} + #incorrect + div`) != null) {
                    document.querySelector(`#${event.target.id} + #incorrect + div`).setAttribute('class', 'hidden');
                }
                event.target.setAttribute('class', "py-4 outline-none rounded-lg border border-color-neutral-200 px-6 focus:border-blue-700 focus:shadow-smooth bg-no-repeat bg-[center_right_1rem] bg-[url('/public/images/correct.png')] bg-[length:1.5rem_1.5rem]");
            }

            function incorrect(type, locale) {
                event.target.style.borderColor = '#CC1E1E';
                event.target.setAttribute('class', "py-4 outline-none rounded-lg border border-color-neutral-200 px-6 focus:border-blue-700 focus:shadow-smooth");
                message = document.querySelector(`#${event.target.id} + #incorrect`);
                message.setAttribute("class", "flex gap-2 items-center");
                message = document.querySelector(`#${event.target.id} + #incorrect > p`);
                switch (type) {
                    case 'email':
                        message.innerText = (locale == 'en') ? 'The email must be a valid email address.' : 'ელ-ფოსტის მონაცემები უნდა შეესაბამებოდეს ელ-ფოსტის ფორმატს.';
                        break;
                    case 'password':
                        message.innerText = (locale == 'en') ? `The password must be at least 3 characters.` : 'პაროლი უნდა იყოს არანაკლებ 3 სიმბოლოს ტოლი.';
                        break;
                    case 'username':
                        message.innerText = (locale == 'en') ? `The username must be at least 3 characters.` : `მომხმარებლის სახელი უნდა იყოს არანაკლებ 3 სიმბოლოს ტოლი.`;
                        break;
                    case 'password_confirmation':
                        message.innerText = (locale == 'en') ? `The password confirmation does not match` : `პაროლის მონაცემები ერთმანეთს არ ემთხვევა.`;
                        break;
                }
            }

            function username(text) {
                return text.length >= 3 ? true : false;
            }

            function email(text) {
                const regex = new RegExp(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
                return regex.test(text);
            }

            function password(text) {
                return text.length >= 3 ? true : false;
            }

            function passwordConfirmation(text) {
                password = document.getElementById('password');
                return text == password.value;
            }
        }
    </script>

</div>