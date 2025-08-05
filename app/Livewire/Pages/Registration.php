<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Registration extends Component
{
    #[Validate('required|min:2|max:255')]
    public string $name = '';

    #[Validate('required|email|unique:users,email|max:255')]
    public string $email = '';

    #[Validate('required|min:8|confirmed')]
    public string $password = '';

    #[Validate('required|min:8|same:password')]
    public string $password_confirmation = '';

    public function mount()
    {
        if (Auth::check()) {
            return redirect()->route('homepage');
        }
    }

    public function submit()
    {
        $this->validate();

        try {
            $user = User::create([
                'name'     => $this->name,
                'email'    => $this->email,
                'password' => Hash::make($this->password),
            ]);
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'Registration failed. Please try again.'
            ]);
        }

        Auth::login($user);

        return redirect()->route('homepage');
    }

    public function render()
    {
        return view('livewire.pages.registration');
    }
}
