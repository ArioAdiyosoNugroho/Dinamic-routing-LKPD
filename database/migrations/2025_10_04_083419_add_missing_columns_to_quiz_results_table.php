<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToQuizResultsTable extends Migration
{
    public function up()
    {
        Schema::table('quiz_results', function (Blueprint $table) {
            if (!Schema::hasColumn('quiz_results', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            }

            if (!Schema::hasColumn('quiz_results', 'total_questions')) {
                $table->integer('total_questions')->after('score')->default(0);
            }
        });
    }

    public function down()
    {
        Schema::table('quiz_results', function (Blueprint $table) {
            if (Schema::hasColumn('quiz_results', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            if (Schema::hasColumn('quiz_results', 'total_questions')) {
                $table->dropColumn('total_questions');
            }
        });
    }
}
