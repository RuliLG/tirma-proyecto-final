<?php

use App\Models\Frequency;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('frequencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $frequencies = ['Diaria', 'Semanal', 'Mensual'];
        foreach ($frequencies as $frequency) {
            $model = new Frequency();
            $model->name = $frequency;
            $model->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frequencies');
    }
};
