<?php

namespace App\Console\Commands;

use App\Models\Stock;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ImportStocks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:stocks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $files = [
            'IBEX35' => storage_path('app/IBEX35.csv'),
            'STOXX50E' => storage_path('app/STOXX50E.csv'),
        ];

        foreach ($files as $ticker => $filePath) {
            $this->info("Importing {$ticker} from {$filePath}");

            $contents = File::get($filePath);
            $lines = explode("\n", $contents);
            $header = null;
            $rows = [];
            foreach ($lines as $line) {
                if (!$header) {
                    $header = str_getcsv($line);
                    continue;
                }

                $row = array_combine($header, str_getcsv($line));
                $rows[] = [
                    'ticker' => $ticker,
                    'date' => $row['Date'],
                    'open' => $row['Open'],
                    'high' => $row['High'],
                    'low' => $row['Low'],
                    'close' => $row['Close'],
                    'adj_close' => $row['Adj Close'],
                    'volume' => $row['Volume'],
                ];
            }

            Stock::insert($rows);
        }
    }
}
