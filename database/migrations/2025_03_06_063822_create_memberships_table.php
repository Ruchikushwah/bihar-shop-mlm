<?php

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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->unsigned()->nullable()->index();
            $table->bigInteger('left_id')->unsigned()->nullable()->index();
            $table->bigInteger('right_id')->unsigned()->nullable()->index();
            $table->string('referal_id')->nullable();
            $table->string('membership_id')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable()->index();
            $table->string('token')->nullable();
            $table->string('name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->text('home_address')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->string('state')->nullable();
            $table->string('mobile')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('nominee_name')->nullable();
            $table->string('nominee_relation')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('account_no')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('pancard')->nullable();
            $table->string('aadhar_card')->nullable();
            $table->string('image')->nullable();
            $table->string('transaction_no')->nullable();
            $table->string('terms_and_condition')->nullable();
            $table->tinyInteger('isPaid')->default(0);
            $table->string('payment_status')->nullable();
            $table->tinyInteger('isVerified')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('parent_id')->references('id')->on('memberships')->onDelete('cascade');
            $table->foreign('left_id')->references('id')->on('memberships')->onDelete('set null');
            $table->foreign('right_id')->references('id')->on('memberships')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
