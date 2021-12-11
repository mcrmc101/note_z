<?php namespace Mcrmc\Notez\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMcrmcNotezNotez extends Migration
{
    public function up()
    {
        Schema::table('mcrmc_notez_notez', function($table)
        {
            $table->integer('accid')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('mcrmc_notez_notez', function($table)
        {
            $table->dropColumn('accid');
        });
    }
}
