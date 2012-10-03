<?php

class StringBuf {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("StringBuf::new");
		$�spos = $GLOBALS['%s']->length;
		$this->b = "";
		$GLOBALS['%s']->pop();
	}}
	public function toString() {
		$GLOBALS['%s']->push("StringBuf::toString");
		$�spos = $GLOBALS['%s']->length;
		{
			$�tmp = $this->b;
			$GLOBALS['%s']->pop();
			return $�tmp;
		}
		$GLOBALS['%s']->pop();
	}
	public function addChar($c) {
		$GLOBALS['%s']->push("StringBuf::addChar");
		$�spos = $GLOBALS['%s']->length;
		$this->b .= chr($c);
		$GLOBALS['%s']->pop();
	}
	public function addSub($s, $pos, $len = null) {
		$GLOBALS['%s']->push("StringBuf::addSub");
		$�spos = $GLOBALS['%s']->length;
		$this->b .= _hx_substr($s, $pos, $len);
		$GLOBALS['%s']->pop();
	}
	public function add($x) {
		$GLOBALS['%s']->push("StringBuf::add");
		$�spos = $GLOBALS['%s']->length;
		if(is_null($x)) {
			$x = "null";
		} else {
			if(is_bool($x)) {
				$x = (($x) ? "true" : "false");
			}
		}
		$this->b .= Std::string($x);
		$GLOBALS['%s']->pop();
	}
	public $b;
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->�dynamics[$m]) && is_callable($this->�dynamics[$m]))
			return call_user_func_array($this->�dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call �'.$m.'�');
	}
	function __toString() { return $this->toString(); }
}