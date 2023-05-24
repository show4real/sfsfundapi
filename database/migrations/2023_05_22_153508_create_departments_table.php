<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->timestamps();
        });

        $this->importDepartments();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

      private function importDepartments() {

        $departments=[[
            'name' => 'Accounting',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'Finance',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'name' => 'Budget',
            'created_at' => now(),
            'updated_at' => now()
        ],];

        DB::table('departments')->insert($departments);

       
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
