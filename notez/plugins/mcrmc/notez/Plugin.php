<?php namespace Mcrmc\Notez;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
 public function registerComponents()
    {
        

        return [
            'Mcrmc\Notez\Components\NoteForm' => 'noteZ',        
        ];
    }

    public function registerSettings()
    {
    }
    
   public function registerMarkupTags()
    {
        return [
            'filters' => [
                'dCode' => [$this, 'dCode'],
                'nCode' => [$this, 'nCode']
            ],
            'functions' => [
            ]
        ];
    }
        public function dCode($text)
        {
        return json_decode($text,false);
        }
    
        public function nCode($text)
        {
        return json_encode($text);
        }

    
    
}
