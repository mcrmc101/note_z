<?php namespace Mcrmc\Notez\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMcrmcNotezNotez4 extends Migration
{
    public function up()
    {
        Schema::table('mcrmc_notez_notez', function($table)
        {
            $table->text('yfile')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('mcrmc_notez_notez', function($table)
        {
            $table->dropColumn('yfile');
        });
    }
}
