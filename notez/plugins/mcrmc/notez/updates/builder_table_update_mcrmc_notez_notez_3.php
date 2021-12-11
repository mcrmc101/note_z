<?php namespace Mcrmc\Notez\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMcrmcNotezNotez3 extends Migration
{
    public function up()
    {
        Schema::table('mcrmc_notez_notez', function($table)
        {
            $table->string('type')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('mcrmc_notez_notez', function($table)
        {
            $table->dropColumn('type');
        });
    }
}
