<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    /**
     * Группы пользователей
     * @var array
     */
    protected $group = [
        'U', // Default
        'M', //Moderator
        'A', //Admin
        'B', //Banned
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function ( Blueprint $table ) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->string('name');         // Имя
            $table->string('fathers_name'); // Отчество
            $table->string('unit');         // Подразделение

            $table->enum('group', $this->group)->default($this->group[0]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
