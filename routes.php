<?php
	
use Admin\Models\Locations_model;
use Igniter\Local\Classes\Location;

Route::group([
    'middleware' => ['web']
], function () {

	// add table end point
	Route::any('{location}/table/{id}', function($location, $id){
		
		// check location is valid
		$locationModel = Locations_model::where('permalink_slug', $location)->first();
		if ($locationModel)
		{
			// add to session data
			Session::put('thoughtco.tables', ['location' => $locationModel->location_id, 'table' => $id]);
			
			// set to collection
			$locationModel = App::make('location');
			$locationModel->updateOrderType('collection');
			flash()->success(sprintf(lang('thoughtco.tables::default.welcome_message')) . $id);
			// redirect to menus
			return redirect($location.'/menus');
		}
		
	});

});
