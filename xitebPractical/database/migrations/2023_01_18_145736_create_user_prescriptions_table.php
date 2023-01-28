<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_prescriptions', function (Blueprint $table) {
            $table->id();
            $table->string('prescriptionId');
            $table->string('userId');
            $table->string('image');
            $table->string('note');
            $table->text('deliveryAddress');
            $table->text('deliveryTime');
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
        Schema::dropIfExists('user_prescriptions');
    }
}
