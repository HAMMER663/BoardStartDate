<?php
/**
*
* @package - BoardStartDate
* @copyright (c) alg
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace hammer663\BoardStartDate\migrations;

class v_1_0_0 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['boardsd']) && version_compare($this->config['boardsd_version'], '1.0.*', '>=');
		return false;

	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\dev');
	}
	public function update_schema()
	{
		return array(
		);
	}

	public function revert_schema()
	{
		return array(
		);
	}
	 
	 public function update_data()
	 {
		  return array(
			// Add new configs
			// Current version
			array('config.add', array('boardsd_version', '1.0.0')),
		 );

	 }
	public function revert_data()
	{
		return array(
			// remove from configs
			// Current version
			array('config.remove', array('boardsd_version')),

		);
	}
	 

}