<?php

namespace SidebarPicker;

class Field extends \acf_field
{
  public $defaults;

  public function __construct($logger)
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
