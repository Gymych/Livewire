<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function registration_page_contains_livewire_component()
    {
        $this->get('/register')->assertSeeLivewire('register');
    }

    /** @test */
    function can_register()
    {
        Livewire::test('register')
            ->set('email', 'test@test.com')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertRedirect('/');

        $this->assertTrue(User::whereEmail('test@test.com')->exists());
        $this->assertEquals('test@test.com', auth()->user()->email);
    }

    /** @test */
    function email_is_required()
    {
        Livewire::test('register')
            ->set('email', '')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['email' => 'required']);
    }

    /** @test */
    function email_is_valid_email()
    {
        Livewire::test('register')
            ->set('email', 'john')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['email' => 'email']);
    }

    /** @test */
    function email_hasnt_been_taken_already()
    {
        User::create([
            'email' => 'kir@kir.ru',
            'password' => Hash::make('pass')
        ]);

        Livewire::test('register')
            ->set('email', 'kir@kir.ru')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['email' => 'unique']);
    }

    /** @test */
    function password_is_required()
    {
        Livewire::test('register')
            ->set('email', 'kir@kir.ru')
            ->set('password', '')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['password' => 'required']);
    }

    /** @test */
    function password_is_minimum_of_six()
    {
        Livewire::test('register')
            ->set('email', 'kir@kir.ru')
            ->set('password', '12345')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['password' => 'min']);
    }

    /** @test */
    function password_matches_password_confirmation()
    {
        Livewire::test('register')
            ->set('email', 'kir@kir.ru')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'not_secret')
            ->call('register')
            ->assertHasErrors(['password' => 'same']);
    }
}

