<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magic_phrases', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description')->nullable(true)->default(null);

            $table->boolean('notified')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('magic_id');
            $table->foreign('magic_id')
                ->references('id')
                ->on('magics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magic_phrases');
    }
};
