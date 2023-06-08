<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportToExcel {
    public function export(Builder $query, array $columns): string
    {
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $rowIndex = 1;
        $query->each(function ($row) use ($activeWorksheet, $columns, &$rowIndex) {
            foreach ($columns as $excelColumn => $recordColumn) {
                $activeWorksheet->setCellValue($excelColumn . $rowIndex, $row->{$recordColumn});
            }

            $rowIndex += 1;
        });

        $tmpName = tempnam(sys_get_temp_dir(), 'excel');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tmpName);

        return $tmpName;
    }
}
