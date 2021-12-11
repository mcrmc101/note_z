<?php namespace Mcrmc\Notez\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMcrmcNotezAccount extends Migration
{
    public function up()
    {
        Schema::create('mcrmc_notez_account', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('userid')->nullable();
            $table->string('pword')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mcrmc_notez_account');
    }
}
