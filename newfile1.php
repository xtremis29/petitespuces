<?php
class ShoppingCart
{
	private $user;
	/**
	 * @return the $user
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * @param field_type $user
	 */
	public function setUser($user) {
		$this->user = $user;
	}

	function __construct()
	{
		
	}
}
?>