<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage CITYHOSTEL
 * @since CITYHOSTEL 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('cityhostel_storage_get')) {
	function cityhostel_storage_get($var_name, $default='') {
		global $CITYHOSTEL_STORAGE;
		return isset($CITYHOSTEL_STORAGE[$var_name]) ? $CITYHOSTEL_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('cityhostel_storage_set')) {
	function cityhostel_storage_set($var_name, $value) {
		global $CITYHOSTEL_STORAGE;
		$CITYHOSTEL_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('cityhostel_storage_empty')) {
	function cityhostel_storage_empty($var_name, $key='', $key2='') {
		global $CITYHOSTEL_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($CITYHOSTEL_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($CITYHOSTEL_STORAGE[$var_name][$key]);
		else
			return empty($CITYHOSTEL_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('cityhostel_storage_isset')) {
	function cityhostel_storage_isset($var_name, $key='', $key2='') {
		global $CITYHOSTEL_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($CITYHOSTEL_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($CITYHOSTEL_STORAGE[$var_name][$key]);
		else
			return isset($CITYHOSTEL_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('cityhostel_storage_inc')) {
	function cityhostel_storage_inc($var_name, $value=1) {
		global $CITYHOSTEL_STORAGE;
		if (empty($CITYHOSTEL_STORAGE[$var_name])) $CITYHOSTEL_STORAGE[$var_name] = 0;
		$CITYHOSTEL_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('cityhostel_storage_concat')) {
	function cityhostel_storage_concat($var_name, $value) {
		global $CITYHOSTEL_STORAGE;
		if (empty($CITYHOSTEL_STORAGE[$var_name])) $CITYHOSTEL_STORAGE[$var_name] = '';
		$CITYHOSTEL_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('cityhostel_storage_get_array')) {
	function cityhostel_storage_get_array($var_name, $key, $key2='', $default='') {
		global $CITYHOSTEL_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($CITYHOSTEL_STORAGE[$var_name][$key]) ? $CITYHOSTEL_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($CITYHOSTEL_STORAGE[$var_name][$key][$key2]) ? $CITYHOSTEL_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('cityhostel_storage_set_array')) {
	function cityhostel_storage_set_array($var_name, $key, $value) {
		global $CITYHOSTEL_STORAGE;
		if (!isset($CITYHOSTEL_STORAGE[$var_name])) $CITYHOSTEL_STORAGE[$var_name] = array();
		if ($key==='')
			$CITYHOSTEL_STORAGE[$var_name][] = $value;
		else
			$CITYHOSTEL_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('cityhostel_storage_set_array2')) {
	function cityhostel_storage_set_array2($var_name, $key, $key2, $value) {
		global $CITYHOSTEL_STORAGE;
		if (!isset($CITYHOSTEL_STORAGE[$var_name])) $CITYHOSTEL_STORAGE[$var_name] = array();
		if (!isset($CITYHOSTEL_STORAGE[$var_name][$key])) $CITYHOSTEL_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$CITYHOSTEL_STORAGE[$var_name][$key][] = $value;
		else
			$CITYHOSTEL_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('cityhostel_storage_merge_array')) {
	function cityhostel_storage_merge_array($var_name, $key, $value) {
		global $CITYHOSTEL_STORAGE;
		if (!isset($CITYHOSTEL_STORAGE[$var_name])) $CITYHOSTEL_STORAGE[$var_name] = array();
		if ($key==='')
			$CITYHOSTEL_STORAGE[$var_name] = array_merge($CITYHOSTEL_STORAGE[$var_name], $value);
		else
			$CITYHOSTEL_STORAGE[$var_name][$key] = array_merge($CITYHOSTEL_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('cityhostel_storage_set_array_after')) {
	function cityhostel_storage_set_array_after($var_name, $after, $key, $value='') {
		global $CITYHOSTEL_STORAGE;
		if (!isset($CITYHOSTEL_STORAGE[$var_name])) $CITYHOSTEL_STORAGE[$var_name] = array();
		if (is_array($key))
			cityhostel_array_insert_after($CITYHOSTEL_STORAGE[$var_name], $after, $key);
		else
			cityhostel_array_insert_after($CITYHOSTEL_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('cityhostel_storage_set_array_before')) {
	function cityhostel_storage_set_array_before($var_name, $before, $key, $value='') {
		global $CITYHOSTEL_STORAGE;
		if (!isset($CITYHOSTEL_STORAGE[$var_name])) $CITYHOSTEL_STORAGE[$var_name] = array();
		if (is_array($key))
			cityhostel_array_insert_before($CITYHOSTEL_STORAGE[$var_name], $before, $key);
		else
			cityhostel_array_insert_before($CITYHOSTEL_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('cityhostel_storage_push_array')) {
	function cityhostel_storage_push_array($var_name, $key, $value) {
		global $CITYHOSTEL_STORAGE;
		if (!isset($CITYHOSTEL_STORAGE[$var_name])) $CITYHOSTEL_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($CITYHOSTEL_STORAGE[$var_name], $value);
		else {
			if (!isset($CITYHOSTEL_STORAGE[$var_name][$key])) $CITYHOSTEL_STORAGE[$var_name][$key] = array();
			array_push($CITYHOSTEL_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('cityhostel_storage_pop_array')) {
	function cityhostel_storage_pop_array($var_name, $key='', $defa='') {
		global $CITYHOSTEL_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($CITYHOSTEL_STORAGE[$var_name]) && is_array($CITYHOSTEL_STORAGE[$var_name]) && count($CITYHOSTEL_STORAGE[$var_name]) > 0) 
				$rez = array_pop($CITYHOSTEL_STORAGE[$var_name]);
		} else {
			if (isset($CITYHOSTEL_STORAGE[$var_name][$key]) && is_array($CITYHOSTEL_STORAGE[$var_name][$key]) && count($CITYHOSTEL_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($CITYHOSTEL_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('cityhostel_storage_inc_array')) {
	function cityhostel_storage_inc_array($var_name, $key, $value=1) {
		global $CITYHOSTEL_STORAGE;
		if (!isset($CITYHOSTEL_STORAGE[$var_name])) $CITYHOSTEL_STORAGE[$var_name] = array();
		if (empty($CITYHOSTEL_STORAGE[$var_name][$key])) $CITYHOSTEL_STORAGE[$var_name][$key] = 0;
		$CITYHOSTEL_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('cityhostel_storage_concat_array')) {
	function cityhostel_storage_concat_array($var_name, $key, $value) {
		global $CITYHOSTEL_STORAGE;
		if (!isset($CITYHOSTEL_STORAGE[$var_name])) $CITYHOSTEL_STORAGE[$var_name] = array();
		if (empty($CITYHOSTEL_STORAGE[$var_name][$key])) $CITYHOSTEL_STORAGE[$var_name][$key] = '';
		$CITYHOSTEL_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('cityhostel_storage_call_obj_method')) {
	function cityhostel_storage_call_obj_method($var_name, $method, $param=null) {
		global $CITYHOSTEL_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($CITYHOSTEL_STORAGE[$var_name]) ? $CITYHOSTEL_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($CITYHOSTEL_STORAGE[$var_name]) ? $CITYHOSTEL_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('cityhostel_storage_get_obj_property')) {
	function cityhostel_storage_get_obj_property($var_name, $prop, $default='') {
		global $CITYHOSTEL_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($CITYHOSTEL_STORAGE[$var_name]->$prop) ? $CITYHOSTEL_STORAGE[$var_name]->$prop : $default;
	}
}
?>