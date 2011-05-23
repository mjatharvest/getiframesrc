<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(
	'pi_name' => 'Get Iframe SRC',
	'pi_version' => '1.0',
	'pi_author' => 'Mike Moreau',
	'pi_author_url' => '',
	'pi_description' => 'Looks for the src attribute of an iframe and returns it.',
	'pi_usage' => Get_iframe_src::usage()
);

/**
* Get_iframe_src Class
*
* @package			ExpressionEngine
* @category			Plugin
* @author			Mike Moreau
* @copyright		Copyright (c) 2010, Jane Doe
* @link				http://example.com/
*/


class Get_iframe_src
{

	// --------------------------------------------------------------------
	
	/**
	* Getiframesrc
	*
	* constructor
	*/

	function __construct()
	{
		// needed for all plugins
		$this->EE =& get_instance();
		
		// load the xml parser
		$this->EE->load->library('xmlparser');
	}
	
	function vimeo()
	{
		// using pure php and simple xml
		/*
		$input = $this->EE->TMPL->tagdata;
		$sx = simplexml_load_string('<xml>'.$input.'</xml>');
		
		if($sx)
		{
			if($sx->iframe['src'])
			{
				return $sx->iframe['src'];
			}
			else
			{
				return 'could not find src attribute';
			}
		}
		else
		{
			return 'could not parse url from embed code';
		}
		*/
		
		// using EE's built in xml parser
		$xml_obj = $this->EE->xmlparser->parse_xml($this->EE->TMPL->tagdata);
		
		if ( ! empty($this->EE->xmlparser->errors))
		{
			echo "Could not convert to XML:<br /><br />";
		
			foreach ($this->EE->xmlparser->errors as $error)
			{
				//$this->EE->TMPL->log_item('error data here');
				echo "{$error}<br />";
				exit;
			}
		}
		else
		{
		  if($xml_obj->attributes['src'])
		  {
			  return $xml_obj->attributes['src'];
		  }
		}	
		
	}
	
	
	
	// --------------------------------------------------------------------
	
	/**
	* Usage
	*
	* This function describes how the plugin is used.
	*
	* @access	public
	* @return	string
	*/
	
	//  Make sure to use output buffering
	
	function usage()
	{
		ob_start(); 
		?>
		The Getiframesrc Plugin parses some html video embed code as xml and returns the src attribute as a string.
		
		{exp:get_iframe_src:vimeo}{tag_to_parse}{/exp:get_iframe_src:vimeo}
		
		<?php
		$buffer = ob_get_contents();
		
		ob_end_clean(); 
		
		return $buffer;
	}
	// END
	
}
/* End of file pi.get_iframe_src.php */ 
/* Location: ./system/expressionengine/third_party/get_iframe_src/pi.get_iframe_src.php */