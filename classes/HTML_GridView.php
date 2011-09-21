<?php

/*
 * To change this template, choose Tools | Templates
* and open the template in the editor.
*/

/**
 * Description of HTML_GridView
 *
 * @author James
 */
class HTML_GridView extends HTML_Table {

	public function __construct(array $attributes = null, integer $tabOffset = 0, boolean $useTGroups = false) {
		parent::__construct($attributes, $tabOffset, $useTGroups);
	}

}

?>
