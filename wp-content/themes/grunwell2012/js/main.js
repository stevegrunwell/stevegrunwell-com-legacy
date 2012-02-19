/**
 * Site scripting
 * @package WordPress
 * @subpackage grunwell2012
 * @author Steve Grunwell <steve@stevegrunwell.com>
 */

/**
 * Set the height of #content equal to the tallest between .primary and .secondary
 * @return bool
 */
function setContentHeight(){
  var primaryHeight = jQuery('#content').find('.primary').height();
  var secondaryHeight = jQuery('#content').find('.secondary').height();
  var maxHeight = ( primaryHeight > secondaryHeight ? primaryHeight : secondaryHeight );
  if( jQuery('#content').height() < maxHeight ){
    jQuery('#content').height(maxHeight);
    return true;
  } else {
    return false;
  }
}

/** Replace the @ sign in the SyntaxHighlighter autoloader arguments with the path to the theme's js directory */
function syntaxHighlighterAutoloaderPath(){
  var args = arguments,
  result = [],
  i;

  for( i = 0; i < args.length; i++ ){
    result.push(args[i].replace('@', themeSettings.templatePath + '/js/syntax-highlighter/'));
  }
  return result;
}

jQuery(function($){

  /** If .secondary is taller than .primary while 770px < window size < 1060px .secondary runs out of #content */
  setContentHeight();
  $(window).resize(setContentHeight);

  /** Syntax Highlighter */
  if( typeof(SyntaxHighlighter) !== 'undefined' ){
    SyntaxHighlighter.autoloader.apply(null, syntaxHighlighterAutoloaderPath(
      'applescript @shBrushAppleScript.js',
      'bash shell @shBrushBash.js',
      'css @shBrushCss.js',
      'diff patch @shBrushDiff.js',
      'js jscript javascript  @shBrushJScript.js',
      'php @shBrushPhp.js',
      'text plain @shBrushPlain.js',
      'ruby rails ror rb @shBrushRuby.js',
      'sql @shBrushSql.js',
      'xml xhtml html @shBrushXml.js'
    ));
    SyntaxHighlighter.defaults['toolbar'] = false;
    SyntaxHighlighter.all();
  }

  /** Add placeholder support for older browsers */
  if( $.fn.placeholder ){
    jQuery('#content').find('input').placeholder();
  }

});