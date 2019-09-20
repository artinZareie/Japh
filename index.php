<?php

/**
 * Japh framework
 * 
 * Japh is a php framework that its goal is developing frontend and backend very easily.
 * 
 * @author Artin Zareie <artin.zareie@yahoo.com>
 * @version 1.0.0-beta 
 */

require_once implode(DIRECTORY_SEPARATOR, [__DIR__, 'vendor', 'autoload.php']);

(new App\Bootstrap\Bootstrap());
