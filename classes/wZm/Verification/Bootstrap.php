<?php
/**
 * Verification
 * @author Nikolai Shcherbin
 * @license GNU Affero General Public License version 3
 * @copyright (c) Nikolai Shcherbin 2021
 * @link https://wzm.me
**/
namespace wZm\Verification;

use Elgg\Includer;
use Elgg\PluginBootstrap;

class Bootstrap extends PluginBootstrap {

	/**
	 * Get plugin root
	 * @return string
	 */
	protected function getRoot() {
		return $this->plugin->getPath();
	}

	/**
	 * Executed during 'plugin_boot:before', 'system' event
	 *
	 * Allows the plugin to require additional files, as well as configure services prior to booting the plugin
	 *
	 * @return void
	 */
	public function load() {
		Includer::requireFileOnce($this->getRoot() . '/autoloader.php');
	}
	
	/**
	 * Executed during 'plugin_boot:before', 'system' event
	 *
	 * Allows the plugin to register handlers for 'plugin_boot', 'system' and 'init', 'system' events,
	 * as well as implement boot time logic
	 *
	 * @return void
	 */
	public function boot() {

	}

	/**
	 * Executed during 'init', 'system' event
	 *
	 * Allows the plugin to implement business logic and register all other handlers
	 *
	 * @return void
	 */
	public function init() {
		$hooks = $this->elgg()->hooks;
		$events = $this->elgg()->events;
		
		//css
		elgg_extend_view('elgg.css', 'verification/verification.css');
		elgg_extend_view('admin.css', 'verification/verification.css');
		
		//menus
		$hooks->registerHandler('register', 'menu:user_hover', Menus::class);
		
		//views
		$hooks->registerHandler('view_vars', 'user/elements/summary', Views::class, 999);
		
		//events
		$events->registerHandler('validate', 'user', [Events::class, 'validateUserEvent']);
		
		if ((bool) elgg_get_plugin_setting('verify_admin', 'verification')) {
			$events->registerHandler('make_admin', 'user', [Events::class, 'makeAdminEvent']);
			$events->registerHandler('remove_admin', 'user', [Events::class, 'removeAdminEvent']);
		}
	}
	
	/**
	 * Executed during 'ready', 'system' event
	 *
	 * Allows the plugin to implement logic after all plugins are initialized
	 *
	 * @return void
	 */
	public function ready() {

	}

	/**
	 * Executed during 'shutdown', 'system' event
	 *
	 * Allows the plugin to implement logic during shutdown
	 *
	 * @return void
	 */
	public function shutdown() {

	}
	
	/**
	 * Executed when plugin is activated, after 'activate', 'plugin' event and before activate.php is included
	 *
	 * @return void
	 */
	public function activate() {
		$this->activatePluginEvent();
	}

	/**
	 * Executed when plugin is deactivated, after 'deactivate', 'plugin' event and before deactivate.php is included
	 *
	 * @return void
	 */
	public function deactivate() {

	}

	/**
	 * Registered as handler for 'upgrade', 'system' event
	 *
	 * Allows the plugin to implement logic during system upgrade
	 *
	 * @return void
	 */
	public function upgrade() {

	}
	
	protected function activatePluginEvent() {
		elgg_call(ELGG_IGNORE_ACCESS, function () {
			$admins = elgg_get_admins();
			foreach($admins as $admin) {
				$admin->verified_user = true;
				$admin->save();
			}
		});
	}
	
}