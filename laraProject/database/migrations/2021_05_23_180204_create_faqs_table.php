<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //Crea la tabella delle faq
        Schema::create('faqs', function (Blueprint $table) {
            $table->bigIncrements('faqId')->unsigned()->index();
            $table->string('domanda', 300);
            $table->string('risposta', 300);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('faqs');
    }

}
