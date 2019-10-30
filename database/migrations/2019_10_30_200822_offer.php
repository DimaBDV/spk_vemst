<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Offer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer', function ( Blueprint $table ) {
            $table->bigIncrements('id');

            $table->string('section');                      // Разде: Новости, Расписание, Документация
            $table->string('theme');                        // Тема, Отделение, Раздел
            $table->text('mainText')->nullable();                       // Основной текст, у раздела Новости
            $table->string('files')->nullable();            // (array) id из таблицы с файлами
            $table->text('description')->nullable();      // Описание
            $table->string('url')->nullable();              // Ссылка, только для Документации
            $table->tinyInteger('complete')->nullable();    // Отметка о выполнении
            $table->timestamp('deadline')->nullable();      // Выполнить до
            $table->timestamp('publishing')->nullable();    // Желаемое время публикации

            $table->integer('user_id'); // Автор

            // Системные строки
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('offer');
    }
}
