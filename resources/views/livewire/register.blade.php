<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @livewireStyles
</head>
<body>
<form wire:submit.prevent="register">
    <div>
        <label for="email">email</label>
        <input type="text" wire:model="email" id="email" name="email">
        @error('email') <span>{{$message}}</span>@enderror
    </div>

    <div>
        <label for="password">password</label>
        <input type="password" wire:model="password" id="password" name="password">
        @error('password') <span>{{$message}}</span>@enderror
    </div>

    <div>
        <label for="passwordConfirmation">passwordConfirmation</label>
        <input type="password" wire:model="passwordConfirmation" id="passwordConfirmation" name="passwordConfirmation">
        @error('passwordConfirmation') <span>{{$message}}</span>@enderror
    </div>

    <div>
        <button type="submit" >
            Register
        </button>
    </div>

</form>
@livewireScripts
</body>
</html>


