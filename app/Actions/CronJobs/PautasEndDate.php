<?php
namespace App\Actions\CronJobs;

use Illuminate\Support\Facades\DB;


class PautasEndDate
{

    static public function endingVotes()
    {
        $tables_on = DB::table('pautas')->where('status', 2)->get();
        $today = date('d-m-Y');
        
        foreach ($tables_on as $table) {
            if (strtotime($table->final_date) < strtotime($today)) {
                if($table->neg_votes > $table->pos_votes){
                    DB::table('pautas')->where('id', $table->id)->update(['status' => 1, 'result' => 1]);
                }
                else if($table->neg_votes < $table->pos_votes){
                    DB::table('pautas')->where('id', $table->id)->update(['status' => 1, 'result' => 2]);
                }
                else{
                    $final_date = mktime(0, 0, 0, date('m'), date('d')+1, date('Y'));
                    $final_date = date('d-m-Y', $final_date);
                    DB::table('pautas')->where('id', $table->id)->update(['final_date' => $final_date]);                }
                
            }
        }
    }
}
