<?php
/**
 *  WP Prodact Review front page layout.
 *
 * @package     WPPR
 * @subpackage  Layouts
 * @copyright   Copyright (c) 2017, Bogdan Preda
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       3.0.0
 */

$output = number_format( floor( $this->review->get_rating() ) / 10, 1 );