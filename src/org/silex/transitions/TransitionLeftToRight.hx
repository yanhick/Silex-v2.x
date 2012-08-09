package org.silex.transitions;

import js.Lib;
import js.Dom;

import org.silex.transitions.TransitionBase;
import org.silex.transitions.TransitionData;


/**
 * Does a transition between two states of an object
 */
class TransitionLeftToRight extends TransitionBase {
	/**
	 * Value of position in the style attribute of the DOM element
	 * This is stored because it is changed during the transition
	 */
	private var styleAttrPosition:String;
	/**
	 * constructor
	 * init the property so that it can be tweened with css transitions
	 */
	public function new(rootElement:HtmlDom, SLPId:String) {
		super(rootElement, SLPId);
		styleAttrPosition = rootElement.style.position;
		rootElement.style.left = "0px";
	}
	/**
	 * Start the transition
	 * This is a virtual method which has to be implemented
	 * You are expected to call applyTransitionParams with your transition params
	 */
	override public function start(transitionData:TransitionData){
		super.start(transitionData);
		// position absolute
		rootElement.style.position="absolute";

		// show or hide
		var left:Int;
		if (transitionData.type == show)
			left = 0;
		else
			left = Lib.window.innerWidth;

		if (transitionData.isReversed)
			left = -left;

trace("Start transition left2right "+transitionData+ " => "+left);
		// start transition
		applyTransitionParams(
			"left", 
			left+"px",
			transitionData.duration, 
			transitionData.timingFunction, 
			transitionData.delay);
	}
	/**
	 * reset style.position
	 */
	override private function onEnd(e:Event){
		super.onEnd(e);
		rootElement.style.position=styleAttrPosition;
	}
}