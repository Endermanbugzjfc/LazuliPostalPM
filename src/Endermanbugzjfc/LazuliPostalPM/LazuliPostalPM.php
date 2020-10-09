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

final class LazuliPostalPM extends \pocketmine\plugin\PluginBase {

	public function onEnable() : void {
		if (!this->initConfig()) {
			$this->getServer()->getPluginManager()->disablePlugin($this);
			return;
		}
		$this->
	}
	
	private function initConfig() : bool {
		$this->saveDefaultConfig();
		$conf = $this->getConfig();
		$all = $conf->getAll();
		foreach ($all as $k => $v) $conf->remove($k);
		
		$conf->set('enable-plugin', (bool)($all['enable-plugin'] ?? true));
		foreach (($all['world-groups'] ?? [
			default => [
				'allow-secret-letter-copies' => true,
				'allow-secret-letter-replies' => true,
				'allow-percels' => true,
				'percel-items-blacklist' => []
			],
			[
			skyblock-server => [
				'allow-secret-letter-copies' => true,
				'allow-secret-letter-replies' => true,
				'allow-percels' => true
			]
		]) as $name =>
	}

}