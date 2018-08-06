<?php
/*
Plugin Name: Sidebar Picker
Description: Adds the ability to choose a sidebar item or default to the inherited page's related content item.
Author: Jen Wachter
Version: 0.1
*/

// exit if accessed directly
if (!defined('ABSPATH')) {
  exit;
}

// check if class already exists
if (!class_exists('SidebarPickerField')):

class SidebarPickerField extends acf_field
{
  public $defaults;

  public function __construct()
  {
    $this->name = 'sidebar_picker';
    $this->label = __('Sidebar Picker');
    $this->category = __("Choice",'acf');
    $this->defaults = array(
      "multiple" =>  0
    );

    parent::__construct();
  }

  protected function getSidebarGroups()
  {
    $posts = get_posts(array(
      "post_type" => "sidebar",
      "posts_per_page" => -1
    ));

    $sidebar = array();

    foreach ($posts as $post) {
      $sidebar[$post->ID] = $post->post_title;
    }

    $sidebar["inherit"] = "Inherit Parent Sidebar";
    $sidebar[""] = "None";

    return $sidebar;
  }

  public function render_field($field)
  {
    $value = $field["value"] ? $field["value"] : "";

    echo "<div class='acf-input-wrap'>";
    echo '<select id="' . $field['id'] . '" class="' . $field['class'] . '" name="' . $field['name'] . '" >';

    $sidebars = $this->getSidebarGroups();

    foreach($sidebars as $k => $v) {

      $selected = $k == $value ? "selected='selected'" : "";
      echo "<option value='{$k}' {$selected}>{$v}</option>";
    }

    echo "</select>";
    echo "</div>";
  }

}

// initialize
new SidebarPickerField();

// class_exists check
endif;
