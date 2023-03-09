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
        $query = DB::table('payments')
        ->join('students', 'nisn_fk_id', '=', 'nisn')
        ->join('tuitions', 'tuition_fk_id', '=', 'tuitions.id')
        ->join('classes', 'class_fk_id', '=', 'classes.id')
        ->join('users', 'user_fk_id', '=', 'users.id')
        ->join('months', 'months.id', '=', 'month')
        ->select('payments.*', 'grade', 'major','nis','users.name as treasurer','students.name as name','enter','out','price','month_name');

        Schema::createView('payment_views', $query);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_views');
    }
};
