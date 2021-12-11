<?php namespace Mcrmc\Notez\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMcrmcNotezAccount3 extends Migration
{
    public function up()
    {
        Schema::table('mcrmc_notez_account', function($table)
        {
            $table->boolean('haspass')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('mcrmc_notez_account', function($table)
        {
            $table->dropColumn('haspass');
        });
    }
}
