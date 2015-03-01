<?php

namespace Invoices\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Payments
 * @package Invoices\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="invoices")
*/
class Relation
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	*/
	public $id;

	/**
	 * @ORM\Column(type="integer")
	 */
	public $invoice_user_id;
	
	/**	 
	 * @ORM\Column(type="integer")
	 */
	public $client_id;
	
		
	/**
	 * @ORM\Column(type="string")
	 */
	public $created_on;
	
	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 *
	 * @return Test
	 */
	public function setId( $id ) {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDateTime() {
		return $this->created_on;
	}

	/**
	 * @param mixed $title
	 *
	 * @return Test
	 */
	public function setDateTime( $sDateTime ) {
		$this->created_on = $sDateTime;
		return $this;
	}
	
}