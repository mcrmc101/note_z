<?php namespace Mcrmc\Notez\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMcrmcNotezAccount2 extends Migration
{
    public function up()
    {
        Schema::table('mcrmc_notez_account', function($table)
        {
            $table->string('email')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('mcrmc_notez_account', function($table)
        {
            $table->dropColumn('email');
        });
    }
}
