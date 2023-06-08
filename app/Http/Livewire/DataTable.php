<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use App\Notifications\SendReportOverEmailNotification;
use App\Services\ExportToExcel;
use App\Services\ExportToPdf;
use App\Tables\Columns\StatusSwitcher;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class DataTable extends Component implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $listeners = [
        'didFilterReport' => 'applyFilters',
    ];

    public $filters = [];

    public function render()
    {
        return view('livewire.data-table');
    }

    // public function getRows()
    // {
    //     return StoredProcedure::call('sp_get_stocks', ['date_from' => '2021-01-01']);
    // }

    public function exportToExcel()
    {
        $exporter = new ExportToExcel();
        return response()
            ->download($exporter->export($this->getQuery(), [
                'A' => 'ticker',
                'B' => 'date',
                'C' => 'open',
                'D' => 'high',
                'E' => 'low',
                'F' => 'close',
                'G' => 'adj_close',
                'H' => 'volume',
                'I' => 'is_favorite',
            ]), 'datatable.xlsx')
            ->deleteFileAfterSend();
    }

    public function exportToPdf()
    {
        $exporter = new ExportToPdf();
        return response()
            ->download(
                $exporter->export([
                    'ticker' => 'Ticker',
                    'date' => 'Fecha',
                ],
                $this->getQuery()->get(),
                'pdf.stocks-report'
                ), 'datatable.pdf'
            )
            ->deleteFileAfterSend();
    }

    public function sendOverEmail()
    {
        $exporter = new ExportToExcel();
        $pdfPath = $exporter->export($this->getQuery(), [
            'A' => 'ticker',
            'B' => 'date',
            'C' => 'open',
            'D' => 'high',
            'E' => 'low',
            'F' => 'close',
            'G' => 'adj_close',
            'H' => 'volume',
            'I' => 'is_favorite',
        ]);

        // Mail::to('hi@raullg.com')->send(new SendReportOverEmail($pdfPath));
        // Notification::send($users, new SendReportOverEmailNotification($pdfPath));)
        Notification::route('mail', 'hi@raullg.com')
            ->notify(new SendReportOverEmailNotification($pdfPath));
    }

    public function applyFilters($filters)
    {
        $this->filters = $filters;
        $this->table->query($this->getQuery());
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getQuery())
            ->columns([
                Tables\Columns\TextColumn::make('ticker')
                    ->searchable(isIndividual: true)
                    ->limit(4)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }

                        // Only render the tooltip if the column contents exceeds the length limit.
                        return $state;
                    }),
                Tables\Columns\TextColumn::make('date')
                    ->date('d/m/Y')
                    ->sortable(),
                StatusSwitcher::make('is_favorite'),
                Tables\Columns\TextColumn::make('open')
                    ->sortable()
                    ->color(fn ($record) => $record->open > 8700 ? 'success' : null)
                    ->summarize([
                        Tables\Columns\Summarizers\Average::make(),
                    ]),
                Tables\Columns\TextColumn::make('high')
                    ->sortable(),
                Tables\Columns\TextColumn::make('low')
                    ->sortable(),
                Tables\Columns\TextColumn::make('close')
                    ->sortable(),
                Tables\Columns\TextColumn::make('adj_close')
                    ->sortable(),
                Tables\Columns\TextColumn::make('volume')
                    ->sortable(),
            ])
            ->groups([
                Tables\Grouping\Group::make('ticker'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                Tables\Actions\Action::make('Ver más')
                    ->url(fn ($record) => 'https://google.com?id=' . $record->id)
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-link')
                    ->label('')
                    ->color('success'),
            ])
            ->bulkActions([
                // ...
            ])
            ->striped();
    }

    public function toggle($id)
    {
        $record = Stock::find($id);
        $record->is_favorite = !$record->is_favorite;
        $record->save();
    }

    private function getQuery()
    {
        return Stock::query()
            ->when(Arr::get($this->filters, 'date_from'), fn ($query) => $query->where('date', '>=', Arr::get($this->filters, 'date_from')));
    }
}
