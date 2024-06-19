<?php

namespace App\Livewire;

use App\Livewire\Forms\JournalForm;
use Livewire\Component;

class AddJournalEntry extends Component
{
    public JournalForm $form;

    public function save()
    {
        $this->form->store();

        $this->dispatch('journal-added');

        redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.add-journal-entry');
    }
}
