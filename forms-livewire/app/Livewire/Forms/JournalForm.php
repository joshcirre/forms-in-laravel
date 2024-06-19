<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class JournalForm extends Form
{
    #[Validate('required|string|min:3')]
    public $summary = '';

    #[Validate('sometimes|nullable|string|min:5')]
    public $notes = '';

    #[Validate('required|integer|min:0|max:10')]
    public $rating = 0;

    public function store()
    {
        $this->validate();

        Auth::user()->journals()->create($this->pull());
    }
}
