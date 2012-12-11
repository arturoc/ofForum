<?php if (!defined('APPLICATION')) exit();

// Define the plugin:
$PluginInfo['G_SyntaxHighlighter'] = array(
	'Name' => 'SyntaxHighlighter',
	'Description' => 'This plugin is using javascript SyntaxHighlighter from http://alexgorbatchev.com/SyntaxHighlighter/',
	'Version' => '0.3.1',
	'Author' => 'saturngod',
	'AuthorEmail' => 'saturngod@gmail.com',
	'AuthorUrl' => 'http://en.saturngod.net',
);

class G_SyntaxHighlighter implements Gdn_IPlugin
{

	public function DiscussionController_Render_Before(&$Sender)
	{
		$Sender->AddCSSFile('/plugins/G_SyntaxHighlighter/styles/shCore.css');
		//$Sender->AddCSSFile('/plugins/G_SyntaxHighlighter/styles/shCoreDefault.css');
		$Sender->AddCSSFile('/plugins/G_SyntaxHighlighter/styles/shThemeDefault.css');
		$Sender->AddJsFile('/plugins/G_SyntaxHighlighter/scripts/shCore.js');
		//$Sender->AddJsFile('/plugins/G_SyntaxHighlighter/scripts/shAutoloader.js');
		$Sender->AddJsFile('/plugins/G_SyntaxHighlighter/scripts/shBrushCpp.js');
	}
	
	public function DiscussionController_Render_After(&$Sender)
	{
		
		echo '
			<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery("pre").each(function(){
					/*if(jQuery(this).attr("lang")!="")
					{
						var codeText=jQuery(this).html();
						//codeText = codeText.replace(/<br>/g, "\n");
						jQuery(this).html(codeText);
						jQuery(this).attr("class","brush:"+$(this).attr("lang"));
					}else{*/
						var codeText=jQuery(this).html();
						
						var div = document.createElement("div");
						div.innerHTML = codeText;
						var decoded = div.firstChild.nodeValue;
						
						var regex = /<br\s*[\/]?>/gi;
						codeText = decoded.replace(regex, "\n");
						jQuery(this).html(codeText);
						jQuery(this).attr("class","brush:cpp");
					//}
				});
				/*SyntaxHighlighter.autoloader.apply(null, path(
				  "applescript            @shBrushAppleScript.js",
				  "actionscript3 as3      @shBrushAS3.js",
				  "bash shell             @shBrushBash.js",
				  "coldfusion cf          @shBrushColdFusion.js",
				  "cpp c                  @shBrushCpp.js",
				  "c# c-sharp csharp      @shBrushCSharp.js",
				  "css                    @shBrushCss.js",
				  "delphi pascal          @shBrushDelphi.js",
				  "diff patch pas         @shBrushDiff.js",
				  "erl erlang             @shBrushErlang.js",
				  "groovy                 @shBrushGroovy.js",
				  "java                   @shBrushJava.js",
				  "jfx javafx             @shBrushJavaFX.js",
				  "js jscript javascript  @shBrushJScript.js",
				  "perl pl                @shBrushPerl.js",
				  "php                    @shBrushPhp.js",
				  "text plain             @shBrushPlain.js",
				  "py python              @shBrushPython.js",
				  "ruby rails ror rb      @shBrushRuby.js",
				  "sass scss              @shBrushSass.js",
				  "scala                  @shBrushScala.js",
				  "sql                    @shBrushSql.js",
				  "vb vbnet               @shBrushVb.js",
				  "xml xhtml xslt html    @shBrushXml.js"
				));*/	
				//SyntaxHighlighter.config["stripBrs"]=true;
				SyntaxHighlighter.defaults["toolbar"]=false;
				//SyntaxHighlighter.defaults["gutter"]=false;
				SyntaxHighlighter.all();
			});

			function path()
			{
			  var args = arguments,
			      result = []
			      ;

			  for(var i = 0; i < args.length; i++)
			      result.push(args[i].replace("@", "/plugins/G_SyntaxHighlighter/scripts/"));

			  return result
			};
			</script>
		';
		
	}

	public function Setup()
	{
		// We don't have to setup this plugin
	}
}
