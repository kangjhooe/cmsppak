<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homepage_widgets', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('tipe'); // prayer_times, hijri_calendar, agenda_mini, quick_links, custom_html
            $table->json('config')->nullable();
            $table->integer('urutan')->default(0);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_widgets');
    }
};
