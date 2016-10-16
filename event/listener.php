<?php
/**
 *
 * @package BoardStartDate
 * @copyright (c) 2015 HAMMER663 
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace hammer663\BoardStartDate\event;

/**
* Event listener
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{

	public function __construct(\phpbb\config\config $config, \phpbb\template\template $template, \phpbb\user $user, $phpbb_root_path, $php_ext )
	{
		$this->template = $template;
		$this->user = $user;
		$this->config = $config;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.index_modify_page_title'	=> 'board_start_date',
		);
	}

	public function board_start_date()
	{
		$this->user->add_lang_ext('hammer663/BoardStartDate', 'BoardStartDate');

/*		
  function getWord($number, $suffix) {
    $keys = array(2, 0, 1, 1, 1, 2);
    $mod = $number % 100;
    $suffix_key = ($mod > 7 && $mod < 20) ? 2: $keys[min($mod % 10, 5)];
    return $suffix[$suffix_key];
  }
  $array = array("минута", "минуты", "минут");   $n = 21;
  $word = getWord($n, $array);
  echo "$n $word<br />";
  $n = 11;
  $word = getWord($n, $array);
  echo "$n $word<br />";
  $n = 4;
  $word = getWord($n, $array);
  echo "$n $word<br />";
*/
		
		$board_start_date = array(
			'start_date'	=> $this->user->format_date($this->config['board_startdate']),
			'existed_for'	=> floor((time()- $this->config['board_startdate'])/60/60/24),
		);

		$this->template->assign_vars(array(
			'BOARD_START_DATE'	=> sprintf($this->user->lang['BOARD_START_DATE_INFO'], $board_start_date['start_date'], $board_start_date['existed_for']),

//			'BOARD_START_DATE'	=> sprintf($this->user->lang('BOARD_START_DATE_INFO', $board_start_date['start_date'], $board_start_date['existed_for'])),
			
		//	$user->lang('GUEST_USERS_ONLINE', (int) $guest_counter),
		));
	}


}
