<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeResultToLongtext extends Migration
{
    public function up() {
        DB::statement('ALTER TABLE options MODIFY result LONGTEXT;');
    }

    public function down() {
        DB::statement('ALTER TABLE options MODIFY result UNSIGNED INTEGER;');
    }
}
