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
namespace Endermanbugzjfc\LazuliPostalPM\utils;

use pocketmine\{item\Item, nbt\JsonNbtParser};

use function explode;
use function implode;
use function array_shift;
use function json_encode;
use function json_decode;

class ItemUtils {
	
	public static function checkValidItemString(string $item) : bool {
		$item = explode(':', $item);
		try {
			(new Item((int)$item[0], (int)$item[1]));
			/*array_shift($item);
			array_shift($item);
			$item = implode('', $item);
			if ($item) {
				if (!($item = json_decode($item, true))) return false;
				if ($item['nbt'] ?? []) {
					$item['nbt'] = json_encode($item['nbt']);
					JsonNbtParser::parseJson($item['nbt']);
				}
			}*/
		} catch (\InvalidArgumentException | \UnexpectedValueException $ero) {return false;}
		return true;
	}

	public static function dumpItem(Item $item) : string {
		$string = $item->getId() . ($item->getDamage() != 0 or $item->getNamedTag()->count() != 0 ? ':' . $item->getDamage() : '')/* . ($item->getNamedTag()->count() != 0 ? ':' . self::emitNbt($item->getNamedTag()) : '')*/;
		return $string;
	}
}
