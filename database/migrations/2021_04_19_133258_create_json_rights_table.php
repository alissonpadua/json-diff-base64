<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJsonRightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('json_rights', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('json_left_id');
            $table->foreign('json_left_id')
                ->references('id')
                ->on('json_lefts')
                ->onDelete('cascade');

            $table->integer('code')->unique();
            $table->text('json_base64');
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
        Schema::dropIfExists('json_rights');
    }
}
