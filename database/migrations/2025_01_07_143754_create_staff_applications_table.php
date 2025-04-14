<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffApplicationsTable extends Migration
{
    public function up()
    {
        Schema::create('staff_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('total_applications')->default(0);
            $table->integer('pending')->default(0);
            $table->integer('approved')->default(0);
            $table->integer('rejected')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('staff_applications');
    }
}
