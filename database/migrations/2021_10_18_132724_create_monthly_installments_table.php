<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->float('total_installment')->default(0);
            $table->date('from_date');
            $table->date('to_date');
            $table->unsignedBigInteger('total_amount');
            $table->float('per_month_installment')->default(0);
            $table->unsignedBigInteger('from_month');
            $table->unsignedBigInteger('to_month');
            $table->unsignedBigInteger('from_year');
            $table->unsignedBigInteger('to_year');
            $table->mediumText('description')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_installments');
    }
}
