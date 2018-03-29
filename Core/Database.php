<?php
namespace Core;
use \Illuminate\Database\Capsule\Manager as Capsule;

class Database 
{
	public function __construct()
	{
		$capsule = app()->make(Capsule::class);
		$capsule->addConnection(require_once("../config/database.php"));
		$capsule->setAsGlobal();
		$capsule->bootEloquent();
	}
}