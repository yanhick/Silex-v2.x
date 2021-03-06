package silex;

import js.Lib;
import js.Dom;


//////////////////////////////////////////////////
// Imports
//////////////////////////////////////////////////

import brix.core.Application;
import brix.util.DomTools;

import brix.component.navigation.Page;

import silex.publication.PublicationData;
import silex.publication.PublicationService;

#if silexServerSide
import php.Web;
import sys.io.File;
import haxe.remoting.HttpConnection;

import silex.publication.PublicationConfig;
import silex.server.ServerConfig;
import silex.ServiceBase;
#end

//////////////////////////////////////////////////
// Main Silex class
// TODO: should not be a static class, and should be sandboxed
//////////////////////////////////////////////////
/**
 * Entry point for Silex applications
 * TODO: should not be a static class, and should be sandboxed
 */
class Silex {
	/**
	 * constant, name of attribute
	 */
	//public static inline var CONFIG_PUBLICATION_NAME:String = "publicationName";
	/**
	 * constant, name of attribute
	 */
	public static inline var CONFIG_PUBLICATION_BODY:String = "publicationBody";
	/**
	 * constant, name of attribute
	 */
	public static inline var CONFIG_USE_DEEPLINK:String = "useDeeplink";
	/**
	 * constant, path and file names
	 */
	public static inline var LOADER_SCRIPT_PATH:String = "../../libs/silex/loader.js";
	/**
	 * Publication name
	 * It is provided in the URL as http://my.domain.com/?publication_name
	 */
	//static public var publicationName:String;


#if silexClientSide
	/**
	 * Entry point for Silex applications
	 * Load Silex config
	 * Load HTML and site config
	 * Init plugins
	 * Init SLPayer
	 * Init Silex pages
	 * Open the default page or the page designated by the deeplink
	 */
	static public function main() {
		if (Lib.document.body == null){
			// the script has been loaded at start
			Lib.window.onload = init;
		}
		else{
			// the script has been loaded after the html page
			init();
		}
	}
	/**
	 * Init Silex app
	 */
	static public function init(unused:Dynamic=null){
		trace("Hello Silex!");
		// create a Brix app
		var application = Application.createApplication();
		application.initDom();

	#if flash
		// retrieve config data from flashvars, add all flashvars to the meta
		var params:Dynamic<String> = flash.Lib.current.loaderInfo.parameters;
		for (paramName in Reflect.fields(params)){
			var value = Reflect.field(params, paramName);
			// trace("Flashvar "+paramName+"="+value);
			DomTools.setMeta(paramName, StringTools.urlDecode(value));
		}
	#elseif js
		// retrieve initialPageName
		if (Lib.window.location.hash != "" && DomTools.getMeta(CONFIG_USE_DEEPLINK)!="false"){
			// hash is the page name after the # in the URL
			var initialPageName = Lib.window.location.hash.substr(1);
			// set initial page 
			DomTools.setMeta(Page.CONFIG_INITIAL_PAGE_NAME, initialPageName);
		}
	#end

		// retrieve publicationName
		//publicationName = DomTools.getMeta(CONFIG_PUBLICATION_NAME);

		// set the body of the publication if it is provided in the meta
		var publicationBody = DomTools.getMeta(CONFIG_PUBLICATION_BODY);
		if (publicationBody != null){
			/*
			var node = Lib.document.createElement("DIV");
			node.innerHTML = StringTools.htmlUnescape(DomTools.getMeta(CONFIG_PUBLICATION_BODY));
			Lib.document.body.appendChild(node);
			/**/
			var value = DomTools.getMeta(CONFIG_PUBLICATION_BODY);
			// var value = StringTools.htmlUnescape(DomTools.getMeta(CONFIG_PUBLICATION_BODY));
			Lib.document.body.innerHTML = value;
			// set base tag so the ./ is the publicaiton folder
			//DomTools.setBaseTag(PublicationConstants.PUBLICATION_FOLDER+publicationName+"/");
		}
		
		// init Brix components
		application.initComponents();

		// make the publication visible
		Lib.document.body.style.visibility = "visible";
	}
#end
#if silexServerSide
	/**
	 * Entry point for Silex applications
	 * Retrieve the publication name from the URL
	 * Load Silex config
	 * Load HTML and site config
	 * Init plugins
	 * Init SLPayer
	 * Output the code to load Silex client in Javascript or in Flash version  
	 */
	static public function main() {
		// load server config
		var serverConfig = new ServerConfig();

		// create the services (which are then exposed)
		var publicationService = new PublicationService();

	    // handle remoting, this entry point can be a gateway 
		if( HttpConnection.handleRequest(ServiceBase.context) )
		  return;

		//php.Lib.print("this is a haxe remoting gateway");

		// redirect to the builder
		Web.setHeader("Location", PublicationConstants.PUBLICATION_FOLDER + PublicationConstants.BUILDER_PUBLICATION_NAME);
/*
		// Retrieve the publication name from the URL
		var urlParamsString:String = Web.getParamsString();
		var params:Array<String> = (urlParamsString.split("&")[0]).split("/");

		// get the publication name from the URL
		// page name is either "" or the 1st element
		publicationName = params[0];
		// default value
		if (publicationName == ""){
			publicationName = serverConfig.defaultPublication;
		}
		// Load HTML data
		var publicationData = publicationService.getPublicationData(publicationName);

		// Load config data
		var publicationConfig = publicationService.getPublicationConfig(publicationName);
	
		var initialPageName = "";
		// get the initial page name from the URL
		// case of 		http://my.domain.com/
		// case of 		http://my.domain.com/?/my.page
		if (params.length == 1){
			// default value
			initialPageName = "";
		}
		// case of 		http://my.domain.com/?my.site/my.page
		else {
			// page name is either "" or the 1st element
			initialPageName = params[1];
		}
		// build the DOM
		try{
			Lib.document.innerHTML = publicationData.html;
		}catch(e:Dynamic){
			var filePath = PublicationConstants.PUBLICATION_FOLDER + publicationName + "/" + PublicationConfig.PUBLICATION_HTML_FILE;
			throw("<br /><br />There is an error in the HTML file <a href='"+filePath+"'>"+filePath+"</a>.<br /><br />The error is: <quote>\""+StringTools.htmlEscape(e)+"\"</quote>");
		}

		// include the script
		DomTools.addCssRules(publicationData.css);

		// Add meta tags in the head section for CONFIG_INITIAL_PAGE_NAME and CONFIG_PUBLICATION_NAME
		DomTools.setMeta(CONFIG_PUBLICATION_NAME, publicationName);

		// add meta with the page content
		DomTools.setMeta(CONFIG_PUBLICATION_BODY, StringTools.htmlEscape(Lib.document.body.innerHTML));

		// add meta with the scripts
		// todo: add the scripts from the html page
		var scripts = StringTools.htmlEscape(serverConfig.debugModeAction + publicationConfig.debugModeAction);
		DomTools.setMeta(Interpreter.CONFIG_TAG_DEBUG_MODE_ACTION, scripts);

		// set base tag so the ./ is the publicaiton folder
		DomTools.setBaseTag(PublicationConstants.PUBLICATION_FOLDER+publicationName+"/");
		
		// set initial page 
		if (initialPageName != "" && DomTools.getMeta(CONFIG_USE_DEEPLINK)!="false")
				DomTools.setMeta(Page.CONFIG_INITIAL_PAGE_NAME, initialPageName);

		// add loader script
		DomTools.embedScript(LOADER_SCRIPT_PATH);

		// create a Brix app
		var application = Application.createApplication();

		// init SLPayer
		application.init(Lib.document.body);

		// Output the code to load Silex client in Javascript or in Flash version 
		php.Lib.print(Lib.document.innerHTML);
*/
	}
#end
}