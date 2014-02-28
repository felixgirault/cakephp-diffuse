<?php

use Diffuse\Diffuse;



/**
 *	A simple proxy to configure and use Diffuse.
 *
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@package Essence.Model.Behavior
 *	@license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

class DiffuseHelper extends AppHelper {

	/**
	 *	Helpers.
	 *
	 *	@var array
	 */

	public $helpers = [ 'Html' ];



	/**
	 *	Custom services for Diffuse.
	 *
	 *	@var array
	 */

	public $services = [ ];



	/**
	 *	Diffuse instance.
	 *
	 *	@var Diffuse\Diffuse
	 */

	protected $_Diffuse = null;



	/**
	 *	Constructor.
	 *
	 *	@param View $View View using the helper.
	 *	@param array $settings Helper settings.
	 */

	public function __construct( View $View, array $settings = [ ]) {

		parent::__construct( $View, $settings );

		$this->_Diffuse = new Diffuse( $this->services );
	}



	/**
	 *	Provides shortcuts to the url( ) method:
	 *
	 *	@code
	 *	$Diffuse->link( 'facebook', 'Share on Facebook', 'http://example.com/page' );
	 *	// or
	 *	$Diffuse->facebook( 'Share on Facebook', 'http://example.com/page' );
	 *	@endcode
	 *
	 *	@param string $service Service name.
	 *	@param array $arguments Arguments.
	 *	@return string URL.
	 */

	public function __call( $service, $arguments = [ ]) {

		array_unshift( $arguments, $service );

		return call_user_func_array([ $this, 'link' ], $arguments );
	}



	/**
	 *	Builds and returns a link tag to share an URL on a social network.
	 *
	 *	@param string $service Service name.
	 *	@param string $text Text inside the link.
	 *	@param string|array $params URL to share or a set of Diffuse params.
	 *	@param array $options Options and HTML attributes.
	 *	@return string Link tag.
	 */

	public function link( $service, $text, $params, array $options = [ ]) {

		return $this->Html->link(
			$text,
			$this->_Diffuse->url( $service, $params ),
			$options
		);
	}
}
