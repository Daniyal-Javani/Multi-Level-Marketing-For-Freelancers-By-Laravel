<?php 
namespace App\CustomClasses;
 
class Tree{
	public $name;
 	public $childs;

 	/**
 	 * Get and set name of the person
 	 * @param string $givenName name of the person
 	 */
	public function __construct($givenName)
	{
		$this->name = $givenName;
	} 
}