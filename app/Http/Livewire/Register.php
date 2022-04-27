<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $email;
    public $password;
    public $passwordConfirmation;

    public function render()
    {
        return view('livewire.register');
    }

    public function register(){
        $data = $this->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|same:passwordConfirmation'
        ]);

        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        auth()->login($user);
        return redirect('/');
    }


}
