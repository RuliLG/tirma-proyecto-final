<?php

namespace App\Http\Livewire\Traits;

use Filament\Forms;

trait HasDateRangeForm {
    public ?string $date_from = null;
    public ?string $date_to = null;

    protected function dateRangeForm(): array
    {
        return [
            Forms\Components\DatePicker::make('date_from')
                ->required(),
            Forms\Components\DatePicker::make('date_to')
                ->required()
                ->rules([
                    'after:date_from',
                ]),
        ];
    }
}
