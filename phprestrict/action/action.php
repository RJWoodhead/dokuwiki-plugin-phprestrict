<?php
/**
 * DokuWiki Plugin phprestrict (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author	Robert Woodhead <trebor@animeigo.com>
 *
 * Version 1.0 - Initial release
 *
 * Version 1.1 - Added disable of revision history on PHP pages.
 */

if(!defined('DOKU_INC')) die(); // must be run within Dokuwiki

class action_plugin_phprestrict_action extends DokuWiki_Action_Plugin {

	/**
	 * Registers a callback function for a given event
	 *
	 * @param Doku_Event_Handler $controller DokuWiki's event controller object
	 * @return void
	 */

	public function register(Doku_Event_Handler $controller) {
		
		// Future feature: To kill PHP in non-enabled pages, will need to hook IO_WIKIPAGE_READ
				
		$controller->register_hook('DOKUWIKI_STARTED', 'BEFORE', $this, 'handle_action');
		
	}

	/**
	 * adjust conf to permit php if namespace/page matches
	 */

	public function handle_action(Doku_Event &$event, $param) {
	
		global $conf;
		global $INFO;
		
		// default to php being disabled on all pages

		$conf['phpok'] = 0;
		
		// check for path match and enable PHP if found

		$paths = explode(',',
						 str_replace(array("\r\n","\r","\n"),',',
									 $this->getConf('paths')
						));
		
		$id = $INFO['id'];
		
		foreach ($paths as $path) {
					
			switch (substr($path,-1)) {
			
				case false:		// empty string
				
					continue;	// try next path
					
				case ':':
				
					$phpok = (strpos($id,$path) === 0);
					break;
					
				case '*':
				
					$phpok = (strpos($id,substr($path,0,-1)) === 0);
					break;
					
				default:
				
					$phpok = ($id === $path);
					break;
					
			}
				
			if ($phpok) {
			
				$conf['phpok'] = 1;
				
				// source display/export/revisions can be disabled on potential PHP pages
				
				if ($this->getConf('hide') === 1) {
					if (strpos($conf['disableactions'],'source') === false) $conf['disableactions'] .= ',source';
					if (strpos($conf['disableactions'],'export_raw') === false) $conf['disableactions'] .= ',export_raw';
					if (strpos($conf['disableactions'],'revisions') === false) $conf['disableactions'] .= ',revisions';
				}
				
				return;
				
			}		
		   
		}
		
		// fall through to default of no php!

	}

}

// vim:ts=4:sw=4:et:
