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
        if(! Schema::hasTable('clients')) {
            Schema::create('clients', function (Blueprint $table) {
                $table->increments('id');
                $table->string('kyc_form')->nullable();
                $table->string('enrollment_list')->nullable();
                $table->string('signed_proposal')->nullable();
                $table->string('sec_articles')->nullable();
                $table->string('articles_incorp')->nullable();
                $table->string('by_laws')->nullable();
                $table->string('coc')->nullable();
                $table->string('cert_list')->nullable();
                $table->string('valid_id')->nullable();
                $table->string('statement')->nullable();
 
                

                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};