<?php
namespace Resource;

require_once dirname(__FILE__) . '/../Resource.php';

class OpenSSL extends Resource {
	protected static $prefix = 'openssl_';
	protected $destructor = 'close';
	protected $resources = array(
		'OpenSSL key' => 'freeKey',
		'OpenSSL X.509' => 'x509Free',
		'OpenSSL X.509 CSR' => '',
	);
	
	static function csrNew($dn, &$privkey, $configargs = array(), $extraattribs = array()) {
		$return = openssl_csr_new($dn, $privkey, $configargs, $extraattribs);
		$args = func_get_args();
		return self::init($return, __FUNCTION__, $args);
	}
	
	function csrExport(&$out, $notext = true) {
		return openssl_csr_export($this->resource, $out, $notext);
	}
}
