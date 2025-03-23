<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevToolPackageVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('dev_tool_package_versions', function (Blueprint $table) {
            $table->id();
            $table->string('package_name');
            $table->enum('package_type', ['plugin', 'theme']);
            $table->string('version');
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->string('download_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('changelog')->nullable();
            $table->string('requires_cms_version')->nullable();
            $table->timestamps();
            
            // Replace this line:
            // $table->unique(['package_name', 'package_type', 'version']);
            
            // With this (using a shorter index name):
            $table->unique(['package_name', 'package_type', 'version'], 'pkg_type_version_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('dev_tool_package_versions');
    }
};