<?php
require_once("ORDataObject.class.php");

/**
 * class X12Partner
 *
 */
 
class X12Partner extends ORDataObject{

	var $id;
	var $name;
	var	$id_number;
	var $x12_sender_id;
	var $x12_receiver_id;
	var $x12_version;
	var $processing_format;
	var $processing_format_array;
			
	/**
	 * Constructor sets all Insurance attributes to their default value
	 */
	
	function X12Partner ($id = "", $prefix = "")	{
		parent::ORDataObject();
		$this->id = $id;
		$this->_table = "x12_partners";
		$this->processing_format_array = $this->_load_enum("processing_format",false);
		$this->processing_format = $this->processing_format_array[0];		
		//most recent x12 version mandated by HIPAA and CMS
		$this->x12_version = "004010X098A1";
		if ($id != "") {
			$this->populate();
		}
	}
	
	function x12_partner_factory() {
		$partners = array();
		$x = new X12Partner();
		$sql = "SELECT id FROM "  . $x->_table . " order by name";
		$result = $x->_db->Execute($sql);
		while($result && !$result->EOF) {
			$partners[] = new X12Partner($result->fields['id']);
			$result->MoveNext();
		}
		return $partners;	
	}
	
	function get_id() {
		return $this->id;
	}
	
	function set_id($id) {
		if (is_numeric($id)) {
			$this->id = $id;
		}
	}
	
	function get_name() {
		return $this->name;
	}
	
	function set_name($string) {
			$this->name = $string;
	}
	
	function get_id_number() {
		return $this->id_number;
	}
	
	function set_id_number($string) {
			$this->id_number = $string;
	}
	
	function get_x12_sender_id() {
		return $this->x12_sender_id;
	}
	
	function set_x12_sender_id($string) {
			$this->x12_sender_id = $string;
	}
	
	function get_x12_receiver_id() {
		return $this->x12_receiver_id;
	}
	
	function set_x12_receiver_id($string) {
			$this->x12_receiver_id = $string;
	}
	
	function get_x12_version() {
		return $this->x12_version;
	}
	
	function set_x12_version($string) {
			$this->x12_version = $string;
	}
	
	function get_processing_format() {
		//this is enum so it can be string or int
		if (!is_numeric($this->processing_format)) {
			$ta = $this->processing_format_array;
			return $ta[$this->processing_format];
		}
		return $this->processing_format;
	}
	
	function get_processing_format_array() {
		//flip it because normally it is an id to name lookup, for templates it needs to be a name to id lookup 
		return array_flip($this->processing_format_array);
	}
	
	function set_processing_format($string) {
			$this->processing_format = $string;
	}
	
} 
?>
