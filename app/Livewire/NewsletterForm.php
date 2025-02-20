<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NewsletterSubscriber;

class NewsletterForm extends Component
{
    public $email = '';

    // Define validation rules
    protected $rules = [
        'email' => 'required|email|unique:newsletter_subscribers,email'
    ];

    // Define custom error messages
    protected function message()
    {
        return [
            'email.required' => 'please enter your email',
            'email.email' => 'please provide a valid email',
            'email.unique' => 'This email is already subscribed. Please use another one'
        ];
    }

    // Real time validate method
    public function updateEmail()
    {
        $this->validateOnly('email');
    }

    public function subscribe()
    {
        // Validate email before processing the subscribtion
        $this->validate();

        // Save into DB
        NewsletterSubscriber::create(['email' => $this->email]);

        // Clear input and notify the user
        $this->email = '';
        $this->dispatch('showToast', ['type' => 'success', 'message' => 'You have successfully subscribed']);
    }
    public function render()
    {
        return view('livewire.newsletter-form');
    }
}
