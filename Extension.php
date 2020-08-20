<?php namespace Thoughtco\Tables;

use Admin\Widgets\Form;
use Event;
use Igniter\Local\Classes\Location;
use Illuminate\Foundation\AliasLoader;
use System\Classes\BaseExtension;

class Extension extends BaseExtension
{
    public function boot()
    {
        Event::listen('admin.form.extendFieldsBefore', function (Form $form) use (&$isExtended) {
	        
	        // if its an orders form	        
            if ($form->model instanceof \Admin\Models\Orders_model) {
				
				// add a print docket button on the items page
				$form->tabs['fields']['table_number'] = [
		            'label' => 'lang:thoughtco.tables::default.label_table_number',
		            'type' => 'text',
					'disabled' => TRUE,
		        ];		
								
            }
            
        }); 
        
        // make table_number fillable
		\Admin\Models\Orders_model::extend(function ($model){
			$model->fillable(array_merge($model->getFillable(), ["table_number"]));	
		});        
    }
    
    public function registerNavigation()
    {
	    return [];
    }    

}

?>