<?php

class cocktail_core_layout_computer_boxComputers_PositionedBoxStylesComputer extends cocktail_core_layout_computer_boxComputers_BoxStylesComputer {
	public function __construct() { if(!php_Boot::$skip_constructor) {
		$GLOBALS['%s']->push("cocktail.core.layout.computer.boxComputers.PositionedBoxStylesComputer::new");
		$製pos = $GLOBALS['%s']->length;
		parent::__construct();
		$GLOBALS['%s']->pop();
	}}
	public function getComputedStaticTop($style, $containingBlockData) {
		$GLOBALS['%s']->push("cocktail.core.layout.computer.boxComputers.PositionedBoxStylesComputer::getComputedStaticTop");
		$製pos = $GLOBALS['%s']->length;
		{
			$裨mp = $style->usedValues->marginTop;
			$GLOBALS['%s']->pop();
			return $裨mp;
		}
		$GLOBALS['%s']->pop();
	}
	public function getComputedStaticLeft($style, $containingBlockData) {
		$GLOBALS['%s']->push("cocktail.core.layout.computer.boxComputers.PositionedBoxStylesComputer::getComputedStaticLeft");
		$製pos = $GLOBALS['%s']->length;
		{
			$裨mp = $style->usedValues->marginLeft;
			$GLOBALS['%s']->pop();
			return $裨mp;
		}
		$GLOBALS['%s']->pop();
	}
	public function measureHeight($style, $containingBlockData) {
		$GLOBALS['%s']->push("cocktail.core.layout.computer.boxComputers.PositionedBoxStylesComputer::measureHeight");
		$製pos = $GLOBALS['%s']->length;
		$usedValues = $style->usedValues;
		$usedHeight = $this->getComputedHeight($style, $containingBlockData);
		if($style->isAuto($style->get_top()) === false && $style->isAuto($style->get_bottom()) === false) {
			$usedValues->top = $this->getComputedPositionOffset($style->get_top(), $containingBlockData->height);
			$usedValues->bottom = $this->getComputedPositionOffset($style->get_bottom(), $containingBlockData->height);
			if($style->isAuto($style->get_marginTop()) === true && $style->isAuto($style->get_marginTop()) === true) {
				$usedMargin = ($containingBlockData->height - $usedValues->height - $usedValues->paddingTop - $usedValues->paddingBottom - $usedValues->top - $usedValues->bottom) / 2;
				if($usedMargin >= 0) {
					$usedValues->marginTop = $usedMargin;
					$usedValues->marginBottom = $usedMargin;
				} else {
					$usedValues->marginBottom = 0;
					$usedValues->marginTop = $containingBlockData->height - $usedValues->height - $usedValues->paddingTop - $usedValues->paddingBottom - $usedValues->bottom - $usedValues->top;
				}
			} else {
				if($style->isAuto($style->get_marginTop()) === true) {
					$usedValues->marginBottom = $this->getComputedMarginBottom($style, $usedHeight, $containingBlockData);
					$usedValues->marginTop = $containingBlockData->height - $usedValues->height - $usedValues->paddingTop - $usedValues->paddingBottom - $usedValues->top - $usedValues->bottom - $usedValues->marginBottom;
				} else {
					if($style->isAuto($style->get_marginTop()) === true) {
						$usedValues->marginTop = $this->getComputedMarginTop($style, $usedHeight, $containingBlockData);
						$usedValues->marginBottom = $containingBlockData->height - $usedValues->height - $usedValues->paddingTop - $usedValues->paddingBottom - $usedValues->top - $usedValues->bottom - $usedValues->marginTop;
					} else {
						$usedValues->marginTop = $this->getComputedMarginTop($style, $usedHeight, $containingBlockData);
						$usedValues->marginBottom = $this->getComputedMarginBottom($style, $usedHeight, $containingBlockData);
					}
				}
			}
		} else {
			if($style->isAuto($style->get_marginTop()) === true) {
				$usedValues->marginTop = 0;
			} else {
				$usedValues->marginTop = $this->getComputedMarginTop($style, $usedHeight, $containingBlockData);
			}
			if($style->isAuto($style->get_marginTop()) === true) {
				$usedValues->marginBottom = 0;
			} else {
				$usedValues->marginBottom = $this->getComputedMarginBottom($style, $usedHeight, $containingBlockData);
			}
			if($style->isAuto($style->get_top()) === true && $style->isAuto($style->get_bottom()) === true) {
				$usedValues->top = $this->getComputedStaticTop($style, $containingBlockData);
				$usedValues->bottom = $containingBlockData->height - $usedValues->marginTop - $usedValues->marginBottom - $usedValues->height - $usedValues->paddingTop - $usedValues->paddingBottom - $usedValues->top;
			} else {
				if($style->isAuto($style->get_bottom()) === true) {
					$usedValues->top = $this->getComputedPositionOffset($style->get_top(), $containingBlockData->height);
					$usedValues->bottom = $containingBlockData->height - $usedValues->marginTop - $usedValues->marginBottom - $usedValues->height - $usedValues->paddingTop - $usedValues->paddingBottom - $usedValues->top;
				} else {
					if($style->isAuto($style->get_top()) === true) {
						$usedValues->bottom = $this->getComputedPositionOffset($style->get_bottom(), $containingBlockData->height);
						$usedValues->top = $containingBlockData->height - $usedValues->marginTop - $usedValues->marginBottom - $usedValues->height - $usedValues->paddingTop - $usedValues->paddingBottom - $usedValues->bottom;
					}
				}
			}
		}
		{
			$GLOBALS['%s']->pop();
			return $usedHeight;
		}
		$GLOBALS['%s']->pop();
	}
	public function measureAutoHeight($style, $containingBlockData) {
		$GLOBALS['%s']->push("cocktail.core.layout.computer.boxComputers.PositionedBoxStylesComputer::measureAutoHeight");
		$製pos = $GLOBALS['%s']->length;
		$usedValues = $style->usedValues;
		$usedHeight = 0.0;
		if($style->isAuto($style->get_marginTop()) === true) {
			$usedValues->marginTop = 0;
		} else {
			$usedValues->marginTop = $this->getComputedMarginTop($style, $usedHeight, $containingBlockData);
		}
		if($style->isAuto($style->get_marginTop()) === true) {
			$usedValues->marginBottom = 0;
		} else {
			$usedValues->marginBottom = $this->getComputedMarginBottom($style, $usedHeight, $containingBlockData);
		}
		if($style->isAuto($style->get_top()) === false && $style->isAuto($style->get_bottom()) === false) {
			$usedValues->top = $this->getComputedPositionOffset($style->get_top(), $containingBlockData->height);
			$usedValues->bottom = $this->getComputedPositionOffset($style->get_bottom(), $containingBlockData->height);
			$usedHeight = $containingBlockData->height - $usedValues->marginTop - $usedValues->top - $usedValues->bottom - $usedValues->marginBottom - $usedValues->paddingTop - $usedValues->paddingBottom;
		} else {
			if($style->isAuto($style->get_bottom()) === true) {
				$usedValues->top = $this->getComputedPositionOffset($style->get_top(), $containingBlockData->height);
				$usedValues->bottom = $containingBlockData->height - $usedValues->marginTop - $usedValues->marginBottom - $usedValues->height - $usedValues->paddingTop - $usedValues->paddingBottom - $usedValues->top;
			} else {
				if($style->isAuto($style->get_top()) === true) {
					$usedValues->bottom = $this->getComputedPositionOffset($style->get_bottom(), $containingBlockData->height);
					$usedValues->top = $containingBlockData->height - $usedValues->marginTop - $usedValues->marginBottom - $usedValues->height - $usedValues->paddingTop - $usedValues->paddingBottom - $usedValues->bottom;
				}
			}
		}
		{
			$GLOBALS['%s']->pop();
			return $usedHeight;
		}
		$GLOBALS['%s']->pop();
	}
	public function measureWidth($style, $containingBlockData) {
		$GLOBALS['%s']->push("cocktail.core.layout.computer.boxComputers.PositionedBoxStylesComputer::measureWidth");
		$製pos = $GLOBALS['%s']->length;
		$usedValues = $style->usedValues;
		$usedWidth = $this->getComputedWidth($style, $containingBlockData);
		if($style->isAuto($style->get_left()) === false && $style->isAuto($style->get_right()) === false) {
			$usedValues->left = $this->getComputedPositionOffset($style->get_left(), $containingBlockData->width);
			$usedValues->right = $this->getComputedPositionOffset($style->get_right(), $containingBlockData->width);
			if($style->isAuto($style->get_marginLeft()) === true && $style->isAuto($style->get_marginRight()) === true) {
				$usedMargin = ($containingBlockData->width - $usedValues->width - $usedValues->paddingLeft - $usedValues->paddingRight - $usedValues->left - $usedValues->right) / 2;
				if($usedMargin >= 0) {
					$usedValues->marginLeft = $usedMargin;
					$usedValues->marginRight = $usedMargin;
				} else {
					$usedValues->marginLeft = 0;
					$usedValues->marginRight = $containingBlockData->width - $usedValues->width - $usedValues->paddingLeft - $usedValues->paddingRight - $usedValues->left - $usedValues->right;
				}
			} else {
				if($style->isAuto($style->get_marginLeft()) === true) {
					$usedValues->marginRight = $this->getComputedMarginRight($style, $usedWidth, $containingBlockData);
					$usedValues->marginLeft = $containingBlockData->width - $usedValues->width - $usedValues->paddingLeft - $usedValues->paddingRight - $usedValues->left - $usedValues->right - $usedValues->marginRight;
				} else {
					if($style->isAuto($style->get_marginRight()) === true) {
						$usedValues->marginLeft = $this->getComputedMarginLeft($style, $usedWidth, $containingBlockData);
						$usedValues->marginRight = $containingBlockData->width - $usedValues->width - $usedValues->paddingLeft - $usedValues->paddingRight - $usedValues->left - $usedValues->right - $usedValues->marginLeft;
					} else {
						$usedValues->marginLeft = $this->getComputedMarginLeft($style, $usedWidth, $containingBlockData);
						$usedValues->marginRight = $this->getComputedMarginRight($style, $usedWidth, $containingBlockData);
					}
				}
			}
		} else {
			if($style->isAuto($style->get_marginLeft()) === true) {
				$usedValues->marginLeft = 0;
			} else {
				$usedValues->marginLeft = $this->getComputedMarginLeft($style, $usedWidth, $containingBlockData);
			}
			if($style->isAuto($style->get_marginRight()) === true) {
				$usedValues->marginRight = 0;
			} else {
				$usedValues->marginRight = $this->getComputedMarginRight($style, $usedWidth, $containingBlockData);
			}
			if($style->isAuto($style->get_left()) === true && $style->isAuto($style->get_right()) === true) {
				$usedValues->left = $this->getComputedStaticLeft($style, $containingBlockData);
				$usedValues->right = $containingBlockData->width - $usedValues->marginLeft - $usedValues->marginRight - $usedValues->width - $usedValues->paddingLeft - $usedValues->paddingRight - $usedValues->left;
			} else {
				if($style->isAuto($style->get_left()) === true) {
					$usedValues->right = $this->getComputedPositionOffset($style->get_right(), $containingBlockData->width);
					$usedValues->left = $containingBlockData->width - $usedValues->marginLeft - $usedValues->marginRight - $usedValues->width - $usedValues->paddingLeft - $usedValues->paddingRight - $usedValues->right;
				} else {
					if($style->isAuto($style->get_right()) === true) {
						$usedValues->left = $this->getComputedPositionOffset($style->get_left(), $containingBlockData->width);
						$usedValues->right = $containingBlockData->width - $usedValues->marginLeft - $usedValues->marginRight - $usedValues->width - $usedValues->paddingLeft - $usedValues->paddingRight - $usedValues->left;
					}
				}
			}
		}
		{
			$GLOBALS['%s']->pop();
			return $usedWidth;
		}
		$GLOBALS['%s']->pop();
	}
	public function measureAutoWidth($style, $containingBlockData) {
		$GLOBALS['%s']->push("cocktail.core.layout.computer.boxComputers.PositionedBoxStylesComputer::measureAutoWidth");
		$製pos = $GLOBALS['%s']->length;
		$usedValues = $style->usedValues;
		$usedWidth = 0.0;
		if($style->isAuto($style->get_marginLeft()) === true) {
			$usedValues->marginLeft = 0;
		} else {
			$usedValues->marginLeft = $this->getComputedMarginLeft($style, $usedWidth, $containingBlockData);
		}
		if($style->isAuto($style->get_marginRight()) === true) {
			$usedValues->marginRight = 0;
		} else {
			$usedValues->marginRight = $this->getComputedMarginRight($style, $usedWidth, $containingBlockData);
		}
		if($style->isAuto($style->get_left()) === false && $style->isAuto($style->get_right()) === false) {
			$usedValues->left = $this->getComputedPositionOffset($style->get_left(), $containingBlockData->width);
			$usedValues->right = $this->getComputedPositionOffset($style->get_right(), $containingBlockData->width);
			$usedWidth = $containingBlockData->width - $usedValues->marginLeft - $usedValues->left - $usedValues->right - $usedValues->marginRight - $usedValues->paddingLeft - $usedValues->paddingRight;
		} else {
			if($style->isAuto($style->get_left()) === true) {
				$usedValues->right = $this->getComputedPositionOffset($style->get_right(), $containingBlockData->width);
			} else {
				if($style->isAuto($style->get_right()) === true) {
					$usedValues->left = $this->getComputedPositionOffset($style->get_left(), $containingBlockData->width);
				}
			}
			$usedWidth = $containingBlockData->width;
		}
		{
			$GLOBALS['%s']->pop();
			return $usedWidth;
		}
		$GLOBALS['%s']->pop();
	}
	public function measurePositionOffsets($style, $containingBlockData) {
		$GLOBALS['%s']->push("cocktail.core.layout.computer.boxComputers.PositionedBoxStylesComputer::measurePositionOffsets");
		$製pos = $GLOBALS['%s']->length;
		$GLOBALS['%s']->pop();
	}
	function __toString() { return 'cocktail.core.layout.computer.boxComputers.PositionedBoxStylesComputer'; }
}
