<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(
	'pi_name' => 'Get Iframe SRC',
	'pi_version' => '1.0',
	'pi_author' => 'Mike Moreau',
	'pi_author_url' => 'http://harvestmedia.com',
	'pi_description' => 'Looks for the src attribute of an iframe and returns it.',
	'pi_usage' => Getiframesrc::usage()
);

class Getiframesrc
{
	
	var $return_data = '';
	
	// --------------------------------------------------------------------
	
	/**
	* Get_iframe_src
	*
	* @access	public
	* @return	string
	*/
	
	function __construct()
	{
		$this->EE =& get_instance();
		
		$input = $this->EE->TMPL->tagdata;
		$sx = simplexml_load_string('<xml>'.$input.'</xml>');
		
		if($sx)
		{
			if($sx->iframe['src'])
			{
				$this->return_data = $sx->iframe['src'];
			}
			else
			{
				$this->return_data = 'could not find src attribute';
			}
		}
		else
		{
			$this->return_data = 'could not parse url from embed code';
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
	
	//  Make sure and use output buffering
	
	function usage()
	{
		ob_start(); 
		?>
		This is an incredibly simple Plugin that looks for the src attribute of an iframe and returns it.
		
		<?php
		$buffer = ob_get_contents();
		
		ob_end_clean(); 
		
		return $buffer;
	}
	// END

}
/* End of file pi.get_iframe_src.php */ 
/* Location: ./system/expressionengine/third_party/getiframesrc/pi.getiframesrc.php */