<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class RequiredFieldsModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.required-fields-modal');
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
}
