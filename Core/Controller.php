<?php

namespace Core;

class Controller {
	
	protected $request;
	protected $blade;
	
	public function __construct($request) {
		$this->request = $request;
		$this->blade = app()->make('BladeInstance');		
	}
}