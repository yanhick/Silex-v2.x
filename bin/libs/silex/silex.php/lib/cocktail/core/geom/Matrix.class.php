<?php

class cocktail_core_geom_Matrix {
	public function __construct($data = null) {
		if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("cocktail.core.geom.Matrix::new");
		$製pos = $GLOBALS['%s']->length;
		$this->set_data($data);
		$GLOBALS['%s']->pop();
	}}
	public function skew($skewX, $skewY) {
		$GLOBALS['%s']->push("cocktail.core.geom.Matrix::skew");
		$製pos = $GLOBALS['%s']->length;
		$skewedMatrix = new cocktail_core_geom_Matrix(null);
		$skewingMatrixData = _hx_anonymous(array("a" => 1.0, "b" => Math::tan($skewY), "c" => Math::tan($skewX), "d" => 1.0, "e" => 0.0, "f" => 0.0));
		$skewingMatrix = new cocktail_core_geom_Matrix($skewingMatrixData);
		$skewedMatrix->concatenate($skewingMatrix);
		$this->concatenate($skewedMatrix);
		$GLOBALS['%s']->pop();
	}
	public function scale($scaleX, $scaleY) {
		$GLOBALS['%s']->push("cocktail.core.geom.Matrix::scale");
		$製pos = $GLOBALS['%s']->length;
		$scaledMatrixData = _hx_anonymous(array("a" => $scaleX, "b" => 0.0, "c" => 0.0, "d" => $scaleY, "e" => 0.0, "f" => 0.0));
		$scaledMatrix = new cocktail_core_geom_Matrix($scaledMatrixData);
		$this->concatenate($scaledMatrix);
		$GLOBALS['%s']->pop();
	}
	public function rotate($angle) {
		$GLOBALS['%s']->push("cocktail.core.geom.Matrix::rotate");
		$製pos = $GLOBALS['%s']->length;
		$a = 0.0;
		$b = 0.0;
		$c = 0.0;
		$d = 0.0;
		if($angle === Math::$PI / 2) {
			$a = $d = 0.0;
			$c = $b = 1.0;
		} else {
			if($angle === Math::$PI) {
				$a = $d = -1.0;
				$c = $b = 0.0;
			} else {
				if($angle === Math::$PI * 3 / 2) {
					$a = $d = 0.0;
					$c = $b = -1.0;
				} else {
					$a = $d = Math::cos($angle);
					$c = $b = Math::sin($angle);
				}
			}
		}
		$rotationMatrixData = _hx_anonymous(array("a" => $a, "b" => $b, "c" => $c * -1.0, "d" => $d, "e" => 0.0, "f" => 0.0));
		$rotatedMatrix = new cocktail_core_geom_Matrix($rotationMatrixData);
		$this->concatenate($rotatedMatrix);
		$GLOBALS['%s']->pop();
	}
	public function translate($x, $y) {
		$GLOBALS['%s']->push("cocktail.core.geom.Matrix::translate");
		$製pos = $GLOBALS['%s']->length;
		$translationMatrixData = _hx_anonymous(array("a" => 1.0, "b" => 0.0, "c" => 0.0, "d" => 1.0, "e" => $x, "f" => $y));
		$translationMatrix = new cocktail_core_geom_Matrix($translationMatrixData);
		$this->concatenate($translationMatrix);
		$GLOBALS['%s']->pop();
	}
	public function concatenate($matrix) {
		$GLOBALS['%s']->push("cocktail.core.geom.Matrix::concatenate");
		$製pos = $GLOBALS['%s']->length;
		$currentMatrixData = $this->data;
		$targetMatrixData = $matrix->data;
		$a = $currentMatrixData->a * $targetMatrixData->a + $currentMatrixData->c * $targetMatrixData->b;
		$b = $currentMatrixData->b * $targetMatrixData->a + $currentMatrixData->d * $targetMatrixData->b;
		$c = $currentMatrixData->a * $targetMatrixData->c + $currentMatrixData->c * $targetMatrixData->d;
		$d = $currentMatrixData->b * $targetMatrixData->c + $currentMatrixData->d * $targetMatrixData->d;
		$e = $currentMatrixData->a * $targetMatrixData->e + $currentMatrixData->c * $targetMatrixData->f + $currentMatrixData->e;
		$f = $currentMatrixData->b * $targetMatrixData->e + $currentMatrixData->d * $targetMatrixData->f + $currentMatrixData->f;
		$concatenatedMatrixData = _hx_anonymous(array("a" => $a, "b" => $b, "c" => $c, "d" => $d, "e" => $e, "f" => $f));
		$this->set_data($concatenatedMatrixData);
		$GLOBALS['%s']->pop();
	}
	public function set_data($data) {
		$GLOBALS['%s']->push("cocktail.core.geom.Matrix::set_data");
		$製pos = $GLOBALS['%s']->length;
		$this->data = $data;
		if($data === null) {
			$this->identity();
		}
		{
			$GLOBALS['%s']->pop();
			return $data;
		}
		$GLOBALS['%s']->pop();
	}
	public function identity() {
		$GLOBALS['%s']->push("cocktail.core.geom.Matrix::identity");
		$製pos = $GLOBALS['%s']->length;
		$this->set_data(_hx_anonymous(array("a" => 1.0, "b" => 0.0, "c" => 0.0, "d" => 1.0, "e" => 0.0, "f" => 0.0)));
		$GLOBALS['%s']->pop();
	}
	public $data;
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
	static $__properties__ = array("set_data" => "set_data");
	function __toString() { return 'cocktail.core.geom.Matrix'; }
}
