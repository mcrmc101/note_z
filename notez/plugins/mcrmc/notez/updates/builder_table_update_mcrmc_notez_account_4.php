<?php namespace Mcrmc\Notez\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMcrmcNotezAccount4 extends Migration
{
    public function up()
    {
        Schema::table('mcrmc_notez_account', function($table)
        {
            $table->boolean('dark')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('mcrmc_notez_account', function($table)
        {
            $table->dropColumn('dark');
        });
    }
}
