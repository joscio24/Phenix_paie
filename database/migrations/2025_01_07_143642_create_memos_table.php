<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemosTable extends Migration
{
    public function up()
    {
        Schema::create('memos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('sent_by')->constrained('employees')->onDelete('cascade'); // Foreign key for sender
            $table->foreignId('recipient')->constrained('employees')->onDelete('cascade'); // Foreign key for recipient
            $table->string('status'); // Example: "Validé", "En cours"
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('memos');
    }
}
