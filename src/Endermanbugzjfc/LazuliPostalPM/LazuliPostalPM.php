<?php

/*

     					_________	  ______________		
     				   /        /_____|_           /
					  /————/   /        |  _______/_____    
						  /   /_     ___| |_____       /
						 /   /__|    ||    ____/______/
						/   /    \   ||   |   |   
					   /__________\  | \   \  |
					       /        /   \   \ |
						  /________/     \___\|______
						                   |         \ 
							  PRODUCTION   \__________\	

							   翡翠出品 。 正宗廢品  
 
*/

declare(strict_types=1);
namespace Endermanbugzjfc\LazuliPostalPM;

use function strpos;
use function substr;

final class LazuliPostalPM extends \pocketmine\plugin\PluginBase {

	public function onEnable() : void {
		if (!$this->initConfig()) {
			$this->getServer()->getPluginManager()->disablePlugin($this);
			return;
		}
		$this->
	}

	public const ECO_PLUGIN_NONE = 0;
	public const ECO_PLUGIN_ECONOMYAPI = 1;
	public const ECO_PLUGIN_MULTIECONOMY = 2;
	
	private function initConfig() : bool {
		$this->saveDefaultConfig();
		$conf = $this->getConfig();
		$all = $conf->getAll();
		foreach ($all as $k => $v) $conf->remove($k);
		
		$conf->set('enable-plugin', (bool)($all['enable-plugin'] ?? true));
		$conf->set('economy-plugin-dependency', (int)($all['economy-plugin-dependency'] ?? self::ECO_PLUGIN_ECONOMYAPI));
		$conf->set('maxium-mails-per-mailbox', (int)($all['maxium-mails-per-mailbox'] ?? 2147483647));
		$conf->set('maxium-chars-per-letter', (int)($all['maxium-chars-per-letter'] ?? 2048));
		$conf->set('world-groups', (array)array_map(function (array $all) : array {
			$group = [];
			if (isset($all['allow-secret-letter-copies'])) $group['allow-secret-letter-copies'] = (bool)$all['allow-secret-letter-copies'];
			
			if (isset($all['allow-secret-letter-replies'])) $group['allow-secret-letter-replies'] = (bool)$all['allow-secret-letter-replies'];
			
			if (isset($all['allow-secret-letter-replies'])) $group['allow-secret-letter-replies'] = (bool)$all['allow-secret-letter-replies'];

			if (isset($all['allow-parcels'])) $group['allow-parcels'] = (bool)$all['allow-parcels'];

			if (isset($all['parcel-items-blacklist'])) {
				$group['parcel-items-blacklist'] = ($il = (array)$all['parcel-items-blacklist']);
				foreach ($il as $item) if (!Utils::checkValidItemString((string)$item)) $this->getLogger()->warning('Failed to parse item "' . $item . '", this item will not be ban from the parcels!');
			}

			if (isset($all['parcel-items-whitelist'])) {
				$group['parcel-items-whitelist'] = ($il = (array)$all['parcel-items-whitelist']);
				foreach ($il as $item) if (!Utils::checkValidItemString((string)$item)) $this->getLogger()->warning('Failed to parse item "' . $item . '", this item will not be allow in parcels!');
			}

			if (isset($all['default-parcel-item-price'])) $group['default-parcel-item-price'] = (float)$all['default-parcel-item-price'];

			if (isset($all['specified-parcel-price'])) {
				$group['specified-parcel-price'] = ($il = (array)$all['specified-parcel-price']);
				foreach ($il as $item => $price) if (!Utils::checkValidItemString(substr((string)$item, strpos($item, ':')))) $this->getLogger()->warning('Failed to parse item "' . $item . '", this item will have the default parcel item price!');
			}

			if (isset($all['maxium-items-per-parcel'])) $group['maxium-items-per-parcel'] = (int)$all['maxium-items-per-parcel'];
			
			return $group;
		}, $all['world-groups'] ?? self::getDefaultWorldGroups()));
		
		$conf->save();
		$conf->reload();
		return (bool)$conf->get('enable-plugin', true);
	}
	
	private static function getDefaultWorldGroups() : array {
		return [
			'global' => [
				'allow-secret-letter-copies' => true,
				'allow-secret-letter-replies' => true,
				'allow-parcels' => true,
				'parcel-items-blacklist' => [],
				'parcel-items-whitelist' => [],
				'default-parcel-item-price' => 0.0,
				'specified-parcel-price' => [],
				'maxium-items-per-parcel' => 64
			]
		];
	}

}