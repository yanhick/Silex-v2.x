<?php

class cocktail_port_platform_nativeHttp_AbstractNativeHttp {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("cocktail.port.platform.nativeHttp.AbstractNativeHttp::new");
		$製pos = $GLOBALS['%s']->length;
		$GLOBALS['%s']->pop();
	}}
	public function get_loaded() {
		$GLOBALS['%s']->push("cocktail.port.platform.nativeHttp.AbstractNativeHttp::get_loaded");
		$製pos = $GLOBALS['%s']->length;
		{
			$GLOBALS['%s']->pop();
			return -1;
		}
		$GLOBALS['%s']->pop();
	}
	public function get_total() {
		$GLOBALS['%s']->push("cocktail.port.platform.nativeHttp.AbstractNativeHttp::get_total");
		$製pos = $GLOBALS['%s']->length;
		{
			$GLOBALS['%s']->pop();
			return -1;
		}
		$GLOBALS['%s']->pop();
	}
	public function doLoad($url, $method, $data, $authorRequestHeaders) {
		$GLOBALS['%s']->push("cocktail.port.platform.nativeHttp.AbstractNativeHttp::doLoad");
		$製pos = $GLOBALS['%s']->length;
		$GLOBALS['%s']->pop();
	}
	public function close() {
		$GLOBALS['%s']->push("cocktail.port.platform.nativeHttp.AbstractNativeHttp::close");
		$製pos = $GLOBALS['%s']->length;
		$GLOBALS['%s']->pop();
	}
	public function load($url, $method, $data, $authorRequestHeaders) {
		$GLOBALS['%s']->push("cocktail.port.platform.nativeHttp.AbstractNativeHttp::load");
		$製pos = $GLOBALS['%s']->length;
		$this->status = 0;
		$this->total = 0;
		$this->loaded = 0;
		$this->responseHeaders = new Hash();
		$this->responseHeadersLoaded = false;
		$this->response = null;
		$this->error = false;
		$this->complete = false;
		$this->doLoad($url, $method, $data, $authorRequestHeaders);
		$GLOBALS['%s']->pop();
	}
	public $complete;
	public $error;
	public $responseHeadersLoaded;
	public $response;
	public $responseHeaders;
	public $loaded;
	public $total;
	public $status;
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->蜿ynamics[$m]) && is_callable($this->蜿ynamics[$m]))
			return call_user_func_array($this->蜿ynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call �'.$m.'�');
	}
	static $__properties__ = array("get_total" => "get_total","get_loaded" => "get_loaded");
	function __toString() { return 'cocktail.port.platform.nativeHttp.AbstractNativeHttp'; }
}
