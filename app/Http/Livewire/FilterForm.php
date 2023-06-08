<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\HasDateRangeForm;
use App\Models\Frequency;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms;
use Livewire\Component;

class FilterForm extends Component implements HasForms
{
    use InteractsWithForms;
    use HasDateRangeForm;

    public string $display = 'historical';
    public int $frequency = 0;

    public function render()
    {
        return view('livewire.filter-form');
    }

    public function mount()
    {
        $this->autoFillForm();
    }

    public function askForMissingFields()
    {
        return;
        $fields = collect($this->getFormSchema())
            ->filter(fn (Forms\Components\Field $field) => $field->isRequired());
        $this->emit('openModal', 'required-fields-modal', [
            'fields' => $fields,
        ]);
    }

    public function submit()
    {
        $this->validate();
        $this->emit('didFilterReport', $this->form->getState());
    }

    protected function getFormSchema(): array
    {
        $frequencies = Frequency::all();
        return [
            ...$this->dateRangeForm(),
            Forms\Components\Select::make('display')
                ->options([
                    'historical' => 'Histórico',
                    'dividends' => 'Dividendos',
                    'plusvalia' => 'Plusvalía',
                ])
                ->default('historical')
                ->required(),
            Forms\Components\Select::make('frequency')
                ->options($frequencies->pluck('name', 'id'))
                ->default($frequencies->first()->id)
                ->required(),
        ];
    }

    private function autoFillForm()
    {
        $fields = collect($this->getFormSchema())
            ->map(fn (Forms\Components\Field $field) => [
                'name' => $field->getName(),
                'value' => request($field->getName(), $field->getDefaultState()),
            ])
            ->pluck('value', 'name')
            ->all();
        $this->form->fill($fields);
    }
}
