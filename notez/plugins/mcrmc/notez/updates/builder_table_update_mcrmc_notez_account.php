<?php namespace Mcrmc\Notez\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateMcrmcNotezAccount extends Migration
{
    public function up()
    {
        Schema::table('mcrmc_notez_account', function($table)
        {
            $table->string('name')->nullable();
            $table->text('cats')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('mcrmc_notez_account', function($table)
        {
            $table->dropColumn('name');
            $table->dropColumn('cats');
        });
    }
}
