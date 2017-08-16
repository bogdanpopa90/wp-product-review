<?php
/**
 * Abstract class for Models.
 * Defines inheritable utility methods.
 *
 * @package     WPPR
 * @subpackage  Models
 * @copyright   Copyright (c) 2017, Bogdan Preda
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       3.0.0
 */

/**
 * Class WPPR_Model_Abstract
 */
class WPPR_Model_Abstract {

	/**
	 * The main options array.
	 *
	 * @since   3.0.0
	 * @access  private
	 * @var array $options The options array.
	 */
	private $options;

	/**
	 * The option namespace.
	 *
	 * @since   3.0.0
	 * @access  private
	 * @var string $namespace The options namespace.
	 */
	private $namespace = 'cwppos_options';

	/**
	 * The logger class.
	 *
	 * @since   3.0.0
	 * @access  public
	 * @var WPPR_Logger $logger The logger utility class.
	 */
	public $logger;

	/**
	 * WPPR_Model_Abstract constructor.
	 *
	 * @since   3.0.0
	 * @access  public
	 */
	public function __construct() {
		$this->options = get_option( $this->namespace, array() );
		$this->logger = new WPPR_Logger();
	}

	/**
	 * Get the key option value from DB.
	 *
	 * @since   3.0.0
	 * @access  protected
	 * @param   string $key The key name of the option.
	 * @return bool|mixed
	 */
	protected function get_var( $key ) {
		$this->logger->notice( 'Getting value for ' . $key );
		if ( isset( $this->options[ $key ] ) ) {
			return apply_filters( 'wppr_get_old_option', $this->options[ $key ], $key );
		}
		return apply_filters( 'wppr_get_old_option', false, $key );
	}

	/**
	 * Setter method for updating the options array.
	 *
	 * @since   3.0.0
	 * @access  protected
	 * @param   string $key The name of option.
	 * @param   string $value The value of the option.
	 * @return bool|mixed
	 */
	protected function set_var( $key, $value = '' ) {
		$this->logger->notice( 'Setting value for ' . $key . ' with ' . print_r( $value ) );
		if ( ! array_key_exists( $key, $this->options ) ) {
			$this->options[ $key ] = '';
		}
		$this->options[ $key ] = apply_filters( 'wppr_pre_option_' . $key, $value );

		return update_option( $this->namespace, $this->options );
	}

	/**
	 * Get the global wppr option.
	 *
	 * @since   3.0.0
	 * @access  public
	 * @param   string $key The option key.
	 * @return mixed
	 */
	public function wppr_get_option( $key = '' ) {
	    return $this->get_var( $key );
	}

	/**
	 * Update a global wppr option.
	 *
	 * @since   3.0.0
	 * @access  public
	 * @param   string $key The option key.
	 * @param   string $value The option value.
	 * @return mixed
	 */
	public function wppr_set_option( $key = '', $value = '' ) {
		return $this->set_var( $key, $value );
	}
}
