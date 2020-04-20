<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->text('subject');
            $table->text('message');
            $table->boolean('viewed')->default(false);
            $table->string('file')->nullable();
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->unsignedBigInteger('closed_user_id')->nullable();
            $table->timestamps();
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
