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

    $this->gracefulAnon();

  }

  /***************************************************************************
   *
   *
   *
   ***************************************************************************/
  function gracefulAnon() {

    require_once( 'authentication_api.php' );
    require_once( 'current_user_api.php' );

    $p_user_id = auth_get_current_user_id();
    if( user_is_protected($p_user_id) ){
      if( strpos($_SERVER['REQUEST_URI'], 'account_') !== false ){
        header('Location: login.php');
      }
    }

  }

  /***************************************************************************
   *
   *
   *
   ***************************************************************************/
  function hooks() {
    return array(
      // 'EVENT_MENU_ISSUE'          => 'EVENT_MENU_ISSUE',
      // 'EVENT_LAYOUT_RIGHT_COLUMN' => 'EVENT_LAYOUT_RIGHT_COLUMN',
      // 'EVENT_MENU_MAIN_FRONT'     => 'EVENT_MENU_MAIN_FRONT',
      'EVENT_LAYOUT_RESOURCES'       => 'EVENT_LAYOUT_RESOURCES',
      'EVENT_LAYOUT_CONTENT_BEGIN'   => 'EVENT_LAYOUT_CONTENT_BEGIN',
      'EVENT_LAYOUT_CONTENT_END'     => 'EVENT_LAYOUT_CONTENT_END',
      'EVENT_LAYOUT_PAGE_HEADER'     => 'EVENT_LAYOUT_PAGE_HEADER',
      'EVENT_LAYOUT_BODY_BEGIN'      => 'EVENT_LAYOUT_BODY_BEGIN',
      'EVENT_LAYOUT_BODY_END'        => 'EVENT_LAYOUT_BODY_END'
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
  function EVENT_LAYOUT_PAGE_HEADER(){

    if(
      strpos($_SERVER['REQUEST_URI'], 'login') !== false
      ||
      strpos($_SERVER['REQUEST_URI'], 'logout') !== false
      ){
      return;
    }

    $GLOBALS['g_show_project_menu_bar'] = OFF;
    $t_project_ids = current_user_get_accessible_projects();
    if( !empty($t_project_ids) ){
      $current_project_id = helper_get_current_project();
      echo '<table class="width100 projects" cellspacing="0">';
        echo '<tr>';
          echo '<td class="menu">';
            echo '<a href="' . helper_mantis_url( 'set_project.php?project_id=' . ALL_PROJECTS ) . '" class="p0'.( ALL_PROJECTS == $current_project_id ? ' active' : '').'">' . lang_get( 'all_projects' ) . '</a>';
            foreach( $t_project_ids as $t_id ) {
              echo ' | ';
              echo '<a href="' . helper_mantis_url( 'set_project.php?project_id=' . $t_id ) . '" class="p'.$t_id.( $t_id == $current_project_id ? ' active' : '').'">' . string_html_specialchars( project_get_field( $t_id, 'name' ) ) . '</a>';
              print_subproject_menu_bar( $t_id, $t_id . ';' );
            }
          echo '</td>';
        echo '</tr>';
      echo '</table>';
    }
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

    // Helper Requirements
      $canHelperWork = (ON == config_get('allow_anonymous_login') || (auth_is_user_authenticated() && !current_user_is_anonymous()));

    // Current Project
      $project_id = $canHelperWork ? helper_get_current_project() : 0;

    // Open Wrapper
      echo '<div class="theme wbTeamProTheme project'. $project_id .'" id="bodycol"><div id="bodycolpad">', "\n";

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