<?php

class cocktail_core_renderer_TextRenderer extends cocktail_core_renderer_InvalidatingElementRenderer {
	public function __construct($node) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("cocktail.core.renderer.TextRenderer::new");
		$製pos = $GLOBALS['%s']->length;
		parent::__construct($node);
		$this->_text = $node;
		$this->_textNeedsRendering = true;
		$this->_textTokensNeedParsing = true;
		$GLOBALS['%s']->pop();
	}}
	public function get_bounds() {
		$GLOBALS['%s']->push("cocktail.core.renderer.TextRenderer::get_bounds");
		$製pos = $GLOBALS['%s']->length;
		$textLineBoxesBounds = new _hx_array(array());
		$length = $this->lineBoxes->length;
		{
			$_g = 0;
			while($_g < $length) {
				$i = $_g++;
				$textLineBoxesBounds->push(_hx_array_get($this->lineBoxes, $i)->get_bounds());
				unset($i);
			}
		}
		{
			$裨mp = $this->getChildrenBounds($textLineBoxesBounds);
			$GLOBALS['%s']->pop();
			return $裨mp;
		}
		$GLOBALS['%s']->pop();
	}
	public function isInlineLevel() {
		$GLOBALS['%s']->push("cocktail.core.renderer.TextRenderer::isInlineLevel");
		$製pos = $GLOBALS['%s']->length;
		{
			$GLOBALS['%s']->pop();
			return true;
		}
		$GLOBALS['%s']->pop();
	}
	public function isText() {
		$GLOBALS['%s']->push("cocktail.core.renderer.TextRenderer::isText");
		$製pos = $GLOBALS['%s']->length;
		{
			$GLOBALS['%s']->pop();
			return true;
		}
		$GLOBALS['%s']->pop();
	}
	public function isPositioned() {
		$GLOBALS['%s']->push("cocktail.core.renderer.TextRenderer::isPositioned");
		$製pos = $GLOBALS['%s']->length;
		{
			$GLOBALS['%s']->pop();
			return false;
		}
		$GLOBALS['%s']->pop();
	}
	public function isFloat() {
		$GLOBALS['%s']->push("cocktail.core.renderer.TextRenderer::isFloat");
		$製pos = $GLOBALS['%s']->length;
		{
			$GLOBALS['%s']->pop();
			return false;
		}
		$GLOBALS['%s']->pop();
	}
	public function createTextLineBoxFromTextToken($textToken, $fontMetrics, $fontManager) {
		$GLOBALS['%s']->push("cocktail.core.renderer.TextRenderer::createTextLineBoxFromTextToken");
		$製pos = $GLOBALS['%s']->length;
		$text = null;
		$textLineBox = null;
		$裨 = ($textToken);
		switch($裨->index) {
		case 0:
		$value = $裨->params[0];
		{
			$text = $value;
			$textLineBox = new cocktail_core_linebox_TextLineBox($this, $text, $fontMetrics, $fontManager);
		}break;
		case 1:
		{
			$textLineBox = new cocktail_core_linebox_SpaceLineBox($this, $fontMetrics, $fontManager);
		}break;
		case 2:
		{
			$textLineBox = new cocktail_core_linebox_TextLineBox($this, "", $fontMetrics, $fontManager);
		}break;
		case 3:
		{
			$textLineBox = new cocktail_core_linebox_TextLineBox($this, "", $fontMetrics, $fontManager);
		}break;
		}
		{
			$GLOBALS['%s']->pop();
			return $textLineBox;
		}
		$GLOBALS['%s']->pop();
	}
	public function createTextLines() {
		$GLOBALS['%s']->push("cocktail.core.renderer.TextRenderer::createTextLines");
		$製pos = $GLOBALS['%s']->length;
		if($this->_textTokensNeedParsing === true) {
			$processedText = $this->_text->get_nodeValue();
			$processedText = $this->applyWhiteSpace($processedText, $this->coreStyle->getKeyword($this->coreStyle->get_whiteSpace()));
			$processedText = $this->applyTextTransform($processedText, $this->coreStyle->getKeyword($this->coreStyle->get_textTransform()));
			$this->_textTokens = $this->doGetTextTokens($processedText);
		}
		$this->lineBoxes = new _hx_array(array());
		$fontMetrics = $this->coreStyle->get_fontMetricsData();
		$fontManager = cocktail_core_font_FontManager::getInstance();
		$length = $this->_textTokens->length;
		{
			$_g = 0;
			while($_g < $length) {
				$i = $_g++;
				$this->lineBoxes->push($this->createTextLineBoxFromTextToken($this->_textTokens[$i], $fontMetrics, $fontManager));
				unset($i);
			}
		}
		$GLOBALS['%s']->pop();
	}
	public function capitalizeText($text) {
		$GLOBALS['%s']->push("cocktail.core.renderer.TextRenderer::capitalizeText");
		$製pos = $GLOBALS['%s']->length;
		$capitalizedText = "";
		{
			$_g1 = 0; $_g = strlen($text);
			while($_g1 < $_g) {
				$i = $_g1++;
				if($i === 0) {
					$capitalizedText .= strtoupper(_hx_char_at($text, $i));
				} else {
					$capitalizedText .= _hx_char_at($text, $i);
				}
				unset($i);
			}
		}
		{
			$GLOBALS['%s']->pop();
			return $capitalizedText;
		}
		$GLOBALS['%s']->pop();
	}
	public function applyTextTransform($text, $textTransform) {
		$GLOBALS['%s']->push("cocktail.core.renderer.TextRenderer::applyTextTransform");
		$製pos = $GLOBALS['%s']->length;
		$裨 = ($textTransform);
		switch($裨->index) {
		case 16:
		{
			$text = strtoupper($text);
		}break;
		case 17:
		{
			$text = strtolower($text);
		}break;
		case 15:
		{
			$text = $this->capitalizeText($text);
		}break;
		case 18:
		{
		}break;
		default:{
		}break;
		}
		{
			$GLOBALS['%s']->pop();
			return $text;
		}
		$GLOBALS['%s']->pop();
	}
	public function applyWhiteSpace($text, $whiteSpace) {
		$GLOBALS['%s']->push("cocktail.core.renderer.TextRenderer::applyWhiteSpace");
		$製pos = $GLOBALS['%s']->length;
		$裨 = ($whiteSpace);
		switch($裨->index) {
		case 0:
		case 8:
		{
			$er1 = new EReg("[ \x09]+", "");
			$er2 = new EReg("\x0D+", "g");
			$er3 = new EReg("\x0A+", "g");
			$er4 = new EReg("\\s+", "g");
			$text = $er4->replace($er3->replace($er2->replace($er1->replace($text, " "), " "), " "), " ");
		}break;
		case 10:
		{
			$er1 = new EReg(" *\$^ *", "m");
			$er2 = new EReg("[ \x09]+", "");
			$text = $er2->replace($er1->replace($text, "\x0A"), " ");
		}break;
		default:{
		}break;
		}
		{
			$GLOBALS['%s']->pop();
			return $text;
		}
		$GLOBALS['%s']->pop();
	}
	public function doGetTextTokens($text) {
		$GLOBALS['%s']->push("cocktail.core.renderer.TextRenderer::doGetTextTokens");
		$製pos = $GLOBALS['%s']->length;
		$textTokens = new _hx_array(array());
		$textToken = null;
		$lastCharacterIsSpace = false;
		$i = 0;
		while($i < strlen($text)) {
			if(_hx_char_at($text, $i) === "\\") {
				if($i < strlen($text) - 1) {
					if(_hx_char_at($text, $i + 1) === "n") {
						if($textToken !== null) {
							$textTokens->push(cocktail_core_renderer_TextToken::word($textToken));
							$textToken = null;
						}
						$textTokens->push(cocktail_core_renderer_TextToken::$lineFeed);
						$i++;
					} else {
						if(_hx_char_at($text, $i + 1) === "t") {
							if($textToken !== null) {
								$textTokens->push(cocktail_core_renderer_TextToken::word($textToken));
								$textToken = null;
							}
							$textTokens->push(cocktail_core_renderer_TextToken::$tab);
							$i++;
						}
					}
				}
			} else {
				if(StringTools::isSpace($text, $i) === true) {
					if($textToken !== null) {
						$textTokens->push(cocktail_core_renderer_TextToken::word($textToken));
						$textToken = null;
					}
					$textTokens->push(cocktail_core_renderer_TextToken::$space);
					$lastCharacterIsSpace = true;
				} else {
					$lastCharacterIsSpace = false;
					if($textToken === null) {
						$textToken = "";
					}
					$textToken .= _hx_char_at($text, $i);
				}
			}
			$i++;
		}
		if($textToken !== null) {
			$textTokens->push(cocktail_core_renderer_TextToken::word($textToken));
		}
		{
			$GLOBALS['%s']->pop();
			return $textTokens;
		}
		$GLOBALS['%s']->pop();
	}
	public function invalidate($invalidationReason) {
		$GLOBALS['%s']->push("cocktail.core.renderer.TextRenderer::invalidate");
		$製pos = $GLOBALS['%s']->length;
		$this->_textNeedsRendering = true;
		$GLOBALS['%s']->pop();
	}
	public function layout($forceLayout) {
		$GLOBALS['%s']->push("cocktail.core.renderer.TextRenderer::layout");
		$製pos = $GLOBALS['%s']->length;
		if($this->_textNeedsRendering === true) {
			$this->createTextLines();
			$this->_textNeedsRendering = false;
		}
		$GLOBALS['%s']->pop();
	}
	public $_textTokensNeedParsing;
	public $_textNeedsRendering;
	public $_text;
	public $_textTokens;
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
	static $__properties__ = array("set_bounds" => "set_bounds","get_bounds" => "get_bounds","get_globalBounds" => "get_globalBounds","get_scrollableBounds" => "get_scrollableBounds","set_scrollLeft" => "set_scrollLeft","get_scrollLeft" => "get_scrollLeft","set_scrollTop" => "set_scrollTop","get_scrollTop" => "get_scrollTop","get_scrollWidth" => "get_scrollWidth","get_scrollHeight" => "get_scrollHeight","get_firstChild" => "get_firstChild","get_lastChild" => "get_lastChild","get_nextSibling" => "get_nextSibling","get_previousSibling" => "get_previousSibling","set_onclick" => "set_onClick","set_ondblclick" => "set_onDblClick","set_onmousedown" => "set_onMouseDown","set_onmouseup" => "set_onMouseUp","set_onmouseover" => "set_onMouseOver","set_onmouseout" => "set_onMouseOut","set_onmousemove" => "set_onMouseMove","set_onmousewheel" => "set_onMouseWheel","set_onkeydown" => "set_onKeyDown","set_onkeyup" => "set_onKeyUp","set_onfocus" => "set_onFocus","set_onblur" => "set_onBlur","set_onresize" => "set_onResize","set_onfullscreenchange" => "set_onFullScreenChange","set_onscroll" => "set_onScroll","set_onload" => "set_onLoad","set_onerror" => "set_onError","set_onloadstart" => "set_onLoadStart","set_onprogress" => "set_onProgress","set_onsuspend" => "set_onSuspend","set_onemptied" => "set_onEmptied","set_onstalled" => "set_onStalled","set_onloadedmetadata" => "set_onLoadedMetadata","set_onloadeddata" => "set_onLoadedData","set_oncanplay" => "set_onCanPlay","set_oncanplaythrough" => "set_onCanPlayThrough","set_onplaying" => "set_onPlaying","set_onwaiting" => "set_onWaiting","set_onseeking" => "set_onSeeking","set_onseeked" => "set_onSeeked","set_onended" => "set_onEnded","set_ondurationchange" => "set_onDurationChanged","set_ontimeupdate" => "set_onTimeUpdate","set_onplay" => "set_onPlay","set_onpause" => "set_onPause","set_onvolumechange" => "set_onVolumeChange","set_ontransitionend" => "set_onTransitionEnd");
	function __toString() { return 'cocktail.core.renderer.TextRenderer'; }
}
