<?php
/*
Plugin Name: Sidebar Picker
Description: Adds the ability to choose a sidebar item or default to the inherited page's related content item.
Author: Jen Wachter
Version: 0.1
*/

class SidebarPicker
{
  public function __construct($logger)
  {
    $this->logger = $logger;

    add_action('acf/include_field_types', function () {
      new \SidebarPicker\Field($this->logger);
    });
  }
}

new SidebarPicker($dependencies["logger_wp"]);
