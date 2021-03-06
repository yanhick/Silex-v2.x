package silex.ui.script; 

import js.Lib;
import js.Dom;

import silex.interpreter.Interpreter;

import brix.util.DomTools;
import brix.core.Application;
import brix.component.IBrixComponent;
using brix.component.IBrixComponent.BrixComponent;

/**
 * Handles the script tags with type="text/hscript"
 * Runs the script at startup
 * this class is a "static" component, not linked with a dom node in the html page
 */
class HScriptTag implements IBrixComponent {
	/**
	 * executed once, used to prevent to execute the head script twice when the builder loads a publication in the builder publicaiton
	 */
	private static var executed:Bool = false;
	/**
	 * constructor
	 */
	public function new(rootElement:HtmlDom, brixId:String){
	}
	/**
	 * todo: this is temporary, it is a workaround since the composition with brix BrixComponent does not work
	 */
	function initBrixComponent(brixInstanceId) {
		this.brixInstanceId = brixInstanceId;
		DomTools.doLater(init);
	} 
	/**
	 * init the component
	 */
	public function init() : Void {
		if (executed == false){
			executed = true;
			var htmlTag = Lib.document.getElementsByTagName("head")[0];
			Interpreter.getInstance().execScriptTags(htmlTag);
		}
	}
	/**
	 * the Brix Application instance id.
	 */
	public var brixInstanceId : String;
	
	/**
	 * Returns the associated running Application instance.
	 * 
	 * @return	an Application object.
	 */
	public function getBrixApplication() : Application
	{
		return BrixComponent.getBrixApplication(this);
	}
}