package org.silex.components;

import js.Lib;
import js.Dom;

import org.slplayer.component.ui.DisplayObject;
import org.slplayer.core.Application;
import org.silex.core.DomTools;
import org.silex.transitions.TransitionData;
import org.silex.core.Silex;

/**
 * This component is linked to a DOM element, which is a link to the page,
 * with the page name/deeplink in the name attribute and the page "displayed name"/description as a child of the node.
 * When the page is to be opened/closed, then all the layers which have the page deeplink as a class name are shown/hidden
 */
@tagNameFilter("a")
class Page extends DisplayObject{
	/**
	 * constant, name of this class
	 */
	public static inline var CLASS_NAME:String = "Page";
	/**
	 * constant, name of attribute
	 */
	public static inline var CONFIG_NAME_ATTR:String = "name";
	/**
	 * Display name of the page.
	 * This is a name to be displayed, not used as the deeplink/anchor name
	 */
	private var displayName:String;
	/**
	 * Name of the page.
	 * This is the anchor name to be used as a link/deeplink
	 */
	private var name:String;
	/**
	 * constructor
	 * Init the attributes
	 * Close the page
	 */
	public function new(rootElement:HtmlDom, SLPId:String) {
		super(rootElement, SLPId);
		name = rootElement.getAttribute(CONFIG_NAME_ATTR);
		if (name == null || name == ""){
			throw("Pages have to have a 'name' attribute");
		}
	}
	override public function init(){
		haxe.Timer.delay(doAfterDomInit, 10);
	}
	private function doAfterDomInit(){
		// close if it is not the default page
		if (Silex.config.get(Silex.CONFIG_INITIAL_PAGE_NAME) == name){
			trace ("Open home page '"+name+"'");
			var transitionData = new TransitionData(show, "0.01s"); 
			open(transitionData);
		}
	}
	/**
	 * Open this page, i.e. show all layers which have the page name in their css class attribute
	 * Also close the other pages if doCloseOthers is true
	 */
	public function open(transitionData:TransitionData, doCloseOthers:Bool=true) {
		if (doCloseOthers)
			closeOthers(transitionData);

		doOpen(transitionData);
	}
	/**
	 * Close all other pages
	 */
	public function closeOthers(transitionData:TransitionData){
		// find all the pages in this application and close them
		var nodes = Lib.document.getElementsByClassName(CLASS_NAME);
		for (idxPageNode in 0...nodes.length){
			var pageNode = nodes[idxPageNode];
			var pageInstances:List<Page> = Application.get(SLPlayerInstanceId).getAssociatedComponents(pageNode, Page);
			for (pageInstance in pageInstances){
				if (pageInstance != this)
					pageInstance.close(transitionData, [name]);
			}
		}
	}
	/**
	 * Open this page, i.e. show all layers which have the page name in their css class attribute
	 */
	public function doOpen(transitionData:TransitionData){
		// update transition type
		transitionData.type = TransitionType.show;

		// find all the layers which have the page name in their css class attribute
		var nodes = Lib.document.getElementsByClassName(name);

		// show the layers
		for (idxLayerNode in 0...nodes.length){
			var layerNode = nodes[idxLayerNode];
			var layerInstances:List<Layer> = Application.get(SLPlayerInstanceId).getAssociatedComponents(layerNode, Layer);
			for (layerInstance in layerInstances){
					layerInstance.show(transitionData);
			}
		}

	}
	/**
	 * Close this page, i.e. hide its content
	 * Remove the children from the DOM
	 */
	public function close(transitionData:TransitionData, preventCloseByClassName:Null<Array<String>>=null) {
		// update transition type
		transitionData.type = TransitionType.hide;

		// default value
		if (preventCloseByClassName==null)
			preventCloseByClassName = new Array();

		// find all the layers which have the page name in their css class attribute
		var nodes = Lib.document.getElementsByClassName(name);

		// browse the layers
		for (idxLayerNode in 0...nodes.length){
			var layerNode = nodes[idxLayerNode];
			// do not hide if it has a forbidden class
			var hasForbiddenClass = false;
			for (className in preventCloseByClassName){
				if (DomTools.hasClass(layerNode, className)){
					hasForbiddenClass = true;
					break;
				}
			}
			if (!hasForbiddenClass){
				var layerInstances:List<Layer> = Application.get(SLPlayerInstanceId).getAssociatedComponents(layerNode, Layer);
				for (layerInstance in layerInstances){
					cast(layerInstance, Layer).hide(transitionData);
				}
			}
		}
	}
}
