<?php

namespace App\Livewire\Pages;

use App\Services\DataLayerHelper;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required')]
    public $password = '';

    public function mount()
    {
        if (\Auth::check()) {
            return redirect()->route('homepage');
        }
    }

    public function submit()
    {
        $this->validate();

        if (\Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->route('homepage');
        } else {
            throw ValidationException::withMessages(['email' => 'Email or password is incorrect.']);
        }
    }

    public function render()
    {
        return view('livewire.pages.login');
    }
}
