<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::select('DROP PROCEDURE IF EXISTS sp_GetStocks;');
        DB::select('CREATE PROCEDURE sp_GetStocks(IN date_from DATE, IN date_to DATE)
        BEGIN
            SELECT `id`, `ticker`, `date`, `open`, `high`, `low`, `close`, `adj_close`, `volume`
            FROM stocks
            WHERE `date` >= date_from AND `date` <= date_to;
        END');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::select('DROP PROCEDURE IF EXISTS sp_GetStocks;');
    }
};
