<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_pay_slips_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaySlipsTable extends Migration
{
    public function up()
    {
        Schema::create('pay_slips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');

            // Additional employee details
            $table->string('title')->nullable();
            $table->string('grade')->nullable();

            // Salary Details
            $table->decimal('base_salary', 10, 2);
            $table->decimal('housing_allowance', 10, 2)->default(0);
            $table->decimal('transport_allowance', 10, 2)->default(0);
            $table->decimal('public_services_allowance', 10, 2)->default(0);

            // Deductions
            $table->decimal('tax_paye', 10, 2)->default(0);
            $table->decimal('cnss', 10, 2)->default(0);
            $table->decimal('total_deductions', 10, 2)->default(0);

            // Final Computation
            $table->decimal('net_salary', 10, 2);
            $table->decimal('gross_salary', 10, 2);

            // Other Info
            $table->string('reference_number')->unique();
            $table->date('payment_date');

            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('pay_slips');
    }
}
