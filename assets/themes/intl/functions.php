<?php
/**
 * Automatically include each file in the /library directory
 *
 * @link http://lanyrd.com/2012/wordcamp-san-diego/srybr/
 */
foreach ( glob( dirname(__FILE__) . '/library/*.php' ) as $file ) {
  include $file;
}
?>
