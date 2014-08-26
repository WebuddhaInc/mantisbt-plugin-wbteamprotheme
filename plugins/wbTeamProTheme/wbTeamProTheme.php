<?php

/************************************************************************************************************************************
 *
 * wbTeamProTheme plugin for MantisBT
 * 2013 - David Hunt, Webuddha.com
 *
 ************************************************************************************************************************************/

require_once( config_get( 'class_path' ) . 'MantisPlugin.class.php' );

/******************************************************************************************
 *
 * Vote Tracker
 *
 ******************************************************************************************/
class wbTeamProThemePlugin extends MantisPlugin  {

  /***************************************************************************
   *
   *
   *
   ***************************************************************************/
  function register( ) {

    $this->name = lang_get( 'plugin_wbteamprotheme_title' );
    $this->description = lang_get( 'plugin_wbteamprotheme_description' );
    $this->page = 'config';

    $this->version = '1.0';
    $this->requires = array(
      'MantisCore' => '1.2.0',
    );

    $this->author   = 'David Hunt, Webuddha.com';
    $this->contact  = 'mantisbt-dev@webuddha.com';
    $this->url      = 'http://www.webuddha.com';

  }

  /***************************************************************************
   *
   *
   *
   ***************************************************************************/
  function hooks() {
    return array(
      // 'EVENT_MENU_ISSUE' => 'EVENT_MENU_ISSUE',
      // 'EVENT_LAYOUT_RIGHT_COLUMN' => 'EVENT_LAYOUT_RIGHT_COLUMN',
      // 'EVENT_MENU_MAIN_FRONT' => 'EVENT_MENU_MAIN_FRONT',
      'EVENT_LAYOUT_RESOURCES' => 'EVENT_LAYOUT_RESOURCES',
      'EVENT_LAYOUT_CONTENT_BEGIN' => 'EVENT_LAYOUT_CONTENT_BEGIN',
      'EVENT_LAYOUT_CONTENT_END' => 'EVENT_LAYOUT_CONTENT_END',
      'EVENT_LAYOUT_BODY_BEGIN' => 'EVENT_LAYOUT_BODY_BEGIN',
      'EVENT_LAYOUT_BODY_END' => 'EVENT_LAYOUT_BODY_END'
    );
  }

  /***************************************************************************
   *
   * Plugin CSS / JS includes
   *
   ***************************************************************************/
  function EVENT_LAYOUT_RESOURCES( $event ) {

    // Add stylesheet
    echo '<link rel="stylesheet" type="text/css" href="', plugin_file( 'default.css' ), '"/>';

  }

  /***************************************************************************
   *
   *
   *
   ***************************************************************************/
  function EVENT_LAYOUT_CONTENT_BEGIN(){
  }

  /***************************************************************************
   *
   *
   *
   ***************************************************************************/
  function EVENT_LAYOUT_CONTENT_END(){
  }

  /***************************************************************************
   *
   *
   *
   ***************************************************************************/
  function EVENT_LAYOUT_BODY_BEGIN(){

    // Open Wrapper
    echo '<div class="theme wbTeamProTheme" id="bodycol"><div id="bodycolpad">', "\n";

  }

  /***************************************************************************
   *
   *
   *
   ***************************************************************************/
  function EVENT_LAYOUT_BODY_END(){

    // Close Wrapper
    echo '</div></div>', "\n";

  }

}