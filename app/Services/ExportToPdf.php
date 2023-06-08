<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Spatie\Browsershot\Browsershot;

class ExportToPdf {
    public function export(array $columns, Collection $rows, string $reportName): string
    {
        $tmpName = tempnam(sys_get_temp_dir(), 'pdf') . '.pdf';
        Browsershot::html(
            view($reportName, [
                'columns' => $columns,
                'rows' => $rows,
            ])->render()
        )->save($tmpName);

        return $tmpName;
    }
}
