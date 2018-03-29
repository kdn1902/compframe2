<?php
namespace Core;

class Paging extends \JasonGrimes\Paginator
{
	
	public function __construct($totalItems, $currentPage )
	{
		$urlPattern = '/page/(:num)';
		$itemsPerPage = require_once("../config/paging.php");
		$this->setPreviousText("Назад");
		$this->setNextText("Вперед");
		parent::__construct($totalItems, $itemsPerPage, $currentPage, $urlPattern);
	}
	
	public function getitemsPerPage()
	{
		return $this->itemsPerPage;
	}
}