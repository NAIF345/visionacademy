<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->default(1);
            $table->integer('university_id')->default(1);
            $table->integer('department_id')->default(1);
            $table->string('name');
            $table->boolean('isFree')->default(false);
            $table->integer('price')->default(500);
            $table->integer('verified')->default(1);
            $table->text('description');
            $table->text('logo_url');
            $table->string('preview')->default(null);
            $table->string('prerequisites')->default('');
            $table->string('classLink')->default('');
            $table->text('classTableInfo');
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
        Schema::dropIfExists('courses');
    }
}
