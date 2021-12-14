<?php

use Core\models\Database;

/**
 * This script automatically loads the database
 */

require(dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php');
require(dirname(dirname(dirname(__FILE__))) . '/config/config.php');


const SCHEMA =  './tests/database/test.sql';

$query = file_get_contents(SCHEMA);

try {
    Database::execute($query, []);
    print "\e[0;30;42mScript successfully executed \e[0m\n" . PHP_EOL;
    exit(0);
} catch (\Throwable $ex) {
    print "\e[0;30;41mAn error has occurred :\e[0m\n" . PHP_EOL;
    print $ex->getMessage();
    exit(1);
}
