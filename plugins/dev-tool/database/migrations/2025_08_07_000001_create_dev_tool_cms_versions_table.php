<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevToolCmsVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('dev_tool_cms_versions', function (Blueprint $table) {
            $table->id();
            $table->string('version');
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->string('download_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('changelog')->nullable();
            $table->timestamps();
            
            $table->unique('version');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('dev_tool_cms_versions');
    }
}; 