<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        // Create users table
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // User name
            $table->string('email')->unique(); // Unique email
            $table->string('password'); // User password
            $table->enum('role', ['admin', 'hr_manager', 'accountant']); // User role
            $table->boolean('is_active')->default(true); // Active status
            $table->timestamps(); // Timestamps for created_at and updated_at
        });

        // Create password_reset_tokens table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Primary key is the email
            $table->string('token'); // Reset token
            $table->timestamp('created_at')->nullable(); // Creation timestamp
        });

        // Create sessions table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Primary key session ID
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->index(); // Foreign key for user
            $table->string('ip_address', 45)->nullable(); // IP address (IPv4/IPv6)
            $table->text('user_agent')->nullable(); // User agent data
            $table->longText('payload'); // Session data
            $table->integer('last_activity')->index(); // Index for last activity timestamp
        });
    }

    public function down()
    {
        // Drop all tables when rolling back the migration
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
}
