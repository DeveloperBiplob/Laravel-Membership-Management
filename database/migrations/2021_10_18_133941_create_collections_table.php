<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->unsignedBigInteger('installment_id')->nullable();
            $table->float('total_amount')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->mediumText('description')->nullable();
            $table->unsignedBigInteger('year');
            $table->unsignedBigInteger('month');
            $table->date('collection_date');
            $table->float('current_collection')->default(0);
            $table->string('receipt_image')->nullable();
            $table->boolean('is_send_sms_to_member')->default(false);
            $table->boolean('is_send_sms_to_reference')->default(false);
            $table->enum('collection_type', ['fixed', 'monthly'])->default('monthly');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collections');
    }
}
