<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMigrationViews\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $query = DB::table('students')->join('tuitions', 'tuition_fk_id', '=', 'tuitions.id')
        ->join('classes', 'class_fk_id', '=', 'classes.id')
        ->select('students.*', 'grade', 'major','enter','out','price');

        Schema::createView('student_views', $query);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_views');
    }
};
