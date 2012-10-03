<?php

class org_silex_model_ModelBase {
	public function __construct($hoverChangeEventName, $selectionChangeEventName) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("org.silex.model.ModelBase::new");
		$製pos = $GLOBALS['%s']->length;
		$this->listeners = new HList();
		$this->hoverChangeEventName = $hoverChangeEventName;
		$this->selectionChangeEventName = $selectionChangeEventName;
		$GLOBALS['%s']->pop();
	}}
	public function createEvent($eventName, $detail = null) {
		$GLOBALS['%s']->push("org.silex.model.ModelBase::createEvent");
		$製pos = $GLOBALS['%s']->length;
		$event = cocktail_Lib::get_document()->createEvent("CustomEvent");
		$event->initCustomEvent($eventName, true, true, $detail);
		{
			$GLOBALS['%s']->pop();
			return $event;
		}
		$GLOBALS['%s']->pop();
	}
	public function dispatchEvent($event) {
		$GLOBALS['%s']->push("org.silex.model.ModelBase::dispatchEvent");
		$製pos = $GLOBALS['%s']->length;
		if(null == $this->listeners) throw new HException('null iterable');
		$蜴t = $this->listeners->iterator();
		while($蜴t->hasNext()) {
			$el = $蜴t->next();
			if($el->eventName === $event->type) {
				$el->callbackFunction($event);
			}
		}
		$GLOBALS['%s']->pop();
	}
	public function removeEventListener($eventName, $callbackFunction) {
		$GLOBALS['%s']->push("org.silex.model.ModelBase::removeEventListener");
		$製pos = $GLOBALS['%s']->length;
		$el = $this->getEventListener($callbackFunction, $eventName);
		if($el !== null) {
			$this->listeners->remove($el);
		}
		$GLOBALS['%s']->pop();
	}
	public function addEventListener($eventName, $callbackFunction) {
		$GLOBALS['%s']->push("org.silex.model.ModelBase::addEventListener");
		$製pos = $GLOBALS['%s']->length;
		if($this->getEventListener($callbackFunction, $eventName) === null) {
			$this->listeners->add(_hx_anonymous(array("callbackFunction" => $callbackFunction, "eventName" => $eventName)));
		}
		$GLOBALS['%s']->pop();
	}
	public function isSameEventListeners($el1, $el2) {
		$GLOBALS['%s']->push("org.silex.model.ModelBase::isSameEventListeners");
		$製pos = $GLOBALS['%s']->length;
		{
			$裨mp = $el1->callbackFunction == $el2->callbackFunction && $el1->eventName === $el2->eventName;
			$GLOBALS['%s']->pop();
			return $裨mp;
		}
		$GLOBALS['%s']->pop();
	}
	public function getEventListener($callbackFunction, $eventName) {
		$GLOBALS['%s']->push("org.silex.model.ModelBase::getEventListener");
		$製pos = $GLOBALS['%s']->length;
		if(null == $this->listeners) throw new HException('null iterable');
		$蜴t = $this->listeners->iterator();
		while($蜴t->hasNext()) {
			$el = $蜴t->next();
			if($el->eventName === $eventName && $el->callbackFunction == $callbackFunction) {
				$GLOBALS['%s']->pop();
				return $el;
			}
		}
		{
			$GLOBALS['%s']->pop();
			return null;
		}
		$GLOBALS['%s']->pop();
	}
	public $listeners;
	public function setSelectedItem($item) {
		$GLOBALS['%s']->push("org.silex.model.ModelBase::setSelectedItem");
		$製pos = $GLOBALS['%s']->length;
		if($this->selectedItem != $item) {
			$this->selectedItem = $item;
			$this->dispatchEvent($this->createEvent($this->selectionChangeEventName, null));
		}
		{
			$GLOBALS['%s']->pop();
			return $item;
		}
		$GLOBALS['%s']->pop();
	}
	public function setHoveredItem($item) {
		$GLOBALS['%s']->push("org.silex.model.ModelBase::setHoveredItem");
		$製pos = $GLOBALS['%s']->length;
		if($this->hoveredItem != $item) {
			$this->hoveredItem = $item;
			$this->dispatchEvent($this->createEvent($this->hoverChangeEventName, null));
		}
		{
			$GLOBALS['%s']->pop();
			return $item;
		}
		$GLOBALS['%s']->pop();
	}
	public $selectionChangeEventName;
	public $hoverChangeEventName;
	public $hoveredItem;
	public $selectedItem;
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
	static $__properties__ = array("set_selectedItem" => "setSelectedItem","set_hoveredItem" => "setHoveredItem");
	function __toString() { return 'org.silex.model.ModelBase'; }
}
