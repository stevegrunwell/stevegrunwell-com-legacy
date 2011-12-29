<?php
/** Tests for functions.php */
 
require_once 'simpletest/autorun.php';
require_once '../functions.php';

/** Replace some of the WordPress core functions we'll need for testing */
function get_bloginfo($prop){
  switch( $prop ):
  
    case 'name':
      return 'BlogName';
      break;
      
    case 'description':
      return 'foo bar baz';
      break;
      
    case 'gmt_offset':
      return '-5';
      break;
      
  endswitch;
}

function is_front_page(){
  global $is_front_page;
  return $is_front_page;
}

function wp_title($sep){
  return sprintf('Hello World %s ', $sep);
}

function add_filter(){
  return;
}

function apply_filters($a='', $b=''){
  return $b;
}

class TestOfFunctions extends UnitTestCase {
  
  function testGrunwellPageTitle(){
    global $is_front_page;
    $is_front_page = true;
    $this->assertIsA(grunwell_page_title(), 'string');
    $this->assertEqual(grunwell_page_title(), 'BlogName | foo bar baz');
    $this->assertEqual(grunwell_page_title('>'), 'BlogName > foo bar baz');
    
    $is_front_page = false;
    $this->assertIsA(grunwell_page_title(), 'string');
    $this->assertEqual(grunwell_page_title(), 'Hello World | BlogName');
    $this->assertEqual(grunwell_page_title('>'), 'Hello World > BlogName');
  }
  
  function testGrunwellSitelogo(){
    global $is_front_page;
    $is_front_page = true;
    $this->assertIsA(grunwell_sitelogo(''), 'string');
    $this->assertIsA(grunwell_sitelogo(false), 'string');
    $this->assertIsA(grunwell_sitelogo('Hello world'), 'string');
    $this->assertEqual(grunwell_sitelogo(''), 'h1');
    $this->assertEqual(grunwell_sitelogo(false), 'h1');
    $this->assertEqual(grunwell_sitelogo('Hello world'), '<h1 id="site-logo">Hello<span class="last">world</span></h1>');
    
    $is_front_page = false;
    $this->assertEqual(grunwell_sitelogo(''), 'div');
    $this->assertEqual(grunwell_sitelogo(false), 'div');
    $this->assertEqual(grunwell_sitelogo('Hello world'), '<div id="site-logo">Hello<span class="last">world</span></div>');
    $this->assertEqual(grunwell_sitelogo('Hello'), '<div id="site-logo">Hello</div>');
    $this->assertEqual(grunwell_sitelogo('Hello there, world'), '<div id="site-logo">Hello there,<span class="last">world</span></div>');
    $this->assertEqual(grunwell_sitelogo('Hello  world'), '<div id="site-logo">Hello<span class="last">world</span></div>');
  }
  
  function testGrunwellGetTheDate(){
    global $post;
    $date = time();
    $date_gmt = $date + (60*60*get_bloginfo('gmt_offset'));
    $year = 60*60*24*365;
    
    $post = new stdClass;
    $post->post_date = date('Y-m-d H:i:s', $date);
    $post->post_date_gmt = date('Y-m-d H:i:s', $date_gmt);
    
    $this->assertIsA(grunwell_get_the_date(), 'string');
    $this->assertIsA(grunwell_get_the_date(date('Y-m-d H:i:s', $date-$year)), 'string');
    $this->assertIsA(grunwell_get_the_date(date('Y-m-d H:i:s', $date), true), 'string');
    $this->assertIsA(grunwell_get_the_date(date('Y-m-d H:i:s', $date), false), 'string');
    $this->assertIsA(grunwell_get_the_date(date('Y-m-d H:i:s', $date), true, 'my-datetime'), 'string');
    
    // Default params
    $expected = sprintf('<time datetime="%s">%s</time>', date('c', $date_gmt), date("F jS, Y \a\\t g:ia", $date));
    $this->assertEqual(grunwell_get_the_date(), $expected);
    
    // Pass a specific time
    $expected = sprintf('<time datetime="%s">%s</time>', date('c', $date_gmt-$year), date("F jS, Y \a\\t g:ia", $date-$year));
    $this->assertEqual(grunwell_get_the_date(date('Y-m-d H:i:s', $date-$year)), $expected);
    
    // Pass a date, include time (should be the same as previous test)
    $this->assertEqual(grunwell_get_the_date(date('Y-m-d H:i:s', $date-$year), true), $expected);
    
    // Pass a date, exclude the time
    $expected = sprintf('<time datetime="%s">%s</time>', date('c', $date_gmt), date("F jS, Y", $date));
    $this->assertEqual(grunwell_get_the_date(date('Y-m-d H:i:s', $date), false), $expected);
    
    // Pass a date, include time, add class
    $expected = sprintf('<time datetime="%s" class="my-datetime">%s</time>', date('c', $date_gmt), date("F jS, Y \a\\t g:ia", $date));
    $this->assertEqual(grunwell_get_the_date(date('Y-m-d H:i:s', $date), true, 'my-datetime'), $expected);
    
    // Pass a date, exclude time, add class
    $expected = sprintf('<time datetime="%s" class="my-datetime">%s</time>', date('c', $date_gmt), date("F jS, Y", $date));
    $this->assertEqual(grunwell_get_the_date(date('Y-m-d H:i:s', $date), false, 'my-datetime'), $expected);
  }
  
  function testGrunwellSuperscriptDates(){
    $this->assertIsA(grunwell_superscript_dates('January 1st, 2012'), 'string');
    $this->assertEqual(grunwell_superscript_dates('January 1st, 2012'), 'January 1<sup>st</sup>, 2012');
    $this->assertEqual(grunwell_superscript_dates('January 2nd, 2012'), 'January 2<sup>nd</sup>, 2012');
    $this->assertEqual(grunwell_superscript_dates('January 3rd, 2012'), 'January 3<sup>rd</sup>, 2012');
    $this->assertEqual(grunwell_superscript_dates('January 4th, 2012'), 'January 4<sup>th</sup>, 2012');
    $this->assertEqual(grunwell_superscript_dates('August 1st, 2012'), 'August 1<sup>st</sup>, 2012');
    $this->assertEqual(grunwell_superscript_dates('August 2nd, 2012'), 'August 2<sup>nd</sup>, 2012');
    $this->assertEqual(grunwell_superscript_dates('August 3rd, 2012'), 'August 3<sup>rd</sup>, 2012');
    $this->assertEqual(grunwell_superscript_dates('August 4th, 2012'), 'August 4<sup>th</sup>, 2012');
    $this->assertEqual(grunwell_superscript_dates('August first, 2012'), 'August first, 2012');
    $this->assertEqual(grunwell_superscript_dates('August second, 2012'), 'August second, 2012');
    $this->assertEqual(grunwell_superscript_dates('August third, 2012'), 'August third, 2012');
    $this->assertEqual(grunwell_superscript_dates('August fourth, 2012'), 'August fourth, 2012');
  }
  
  function testGrunwellGetCustomField(){

  }
}

?>