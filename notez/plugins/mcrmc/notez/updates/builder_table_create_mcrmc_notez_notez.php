<?php namespace Mcrmc\Notez\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMcrmcNotezNotez extends Migration
{
    public function up()
    {
        Schema::create('mcrmc_notez_notez', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('userid')->nullable();
            $table->text('notez')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('mcrmc_notez_notez');
    }
}
