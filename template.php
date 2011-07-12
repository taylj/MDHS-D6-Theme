<?php

/**
 * Implementation of hook_preprocess_page()
 */
function mdhs_preprocess_page(&$vars) {

  $scripts = drupal_add_js();
  $css = drupal_add_css();

  if ($scripts) {
    $path = drupal_get_path('theme', 'fusion_core');
    unset($scripts['theme'][$path . '/js/superfish.js']);
    $vars['scripts'] = drupal_get_js('header', $scripts);
  }

  if ($css) {
    $path = drupal_get_path('theme', 'fusion_core');
    unset($css['all']['theme'][$path . '/css/superfish.css']);
    unset($css['all']['theme'][$path . '/css/superfish-navbar.css']);
    unset($css['all']['theme'][$path . '/css/superfish-vertical.css']);
    $vars['styles'] = drupal_get_css($css);
  }
  
  if ($vars['node']->type == 'news' || $vars['node']->type == 'event') {
    $links = array();
    $links[] = l('Home', '<front>');
    if ($vars['node']->type == 'news') {
      $links[] = l('News', 'latest-news');
    }
    else if ($vars['node']->type == 'event') {
      $links[] = l('Events', 'events');
    }
    $links[] = l($vars['node']->title, $vars['node']->path);
    $vars['breadcrumb'] = theme('breadcrumb', $links);
  }
  
}

/**
* Override theme_breadcrumb().
*/
function mdhs_breadcrumb($breadcrumb) {
  $ntb = theme_get_setting('ntb');
  
  if (!$ntb || !is_array($ntb)) {
    return '<div class="breadcrumb">' . implode(' &raquo; ', $breadcrumb) . '</div>';
  }
  
  $enabled_ntb = array_filter(array_values($ntb));
  
  // Get URL arguments
  $arguments = explode('/', request_uri());
  
  // don't show node type breadcrumb if its not enabled
  if (!in_array($arguments[1], $enabled_ntb) && !empty($breadcrumb)) {
    return '<div class="breadcrumb">' . implode(' &raquo; ', $breadcrumb) . '</div>';
  }
  
  $links = array();
  $path = '';
  
  // Remove empty values
  foreach ($arguments as $key => $value) {
    if (empty($value)) {
      unset($arguments[$key]);
    }
  }
  $arguments = array_values($arguments);
  
  // Add 'Home' link
  $links[] = l(t('Home'), '<front>');
  // Add other links
  if (!empty($arguments)) {
    foreach ($arguments as $key => $value) {
      // Don't make last breadcrumb a link
      if ($key == (count($arguments) - 1)) {
        $links[] = drupal_get_title();
      } else {
        if (!empty($path)) {
          $path .= '/'. $value;
        } else {
          $path .= $value;
        }
        
        $value = drupal_ucfirst($value);
        
        // what a naive way. :)
        if ($value[strlen($value)-1] != 's') {
          $value .= 's';
        }
        if ($path[strlen($path)-1] != 's') {
          $path .= 's';
        }
        
        $links[] = l($value, $path);
      }
    }
  }
  
  // Set custom breadcrumbs
  drupal_set_breadcrumb($links);
  
  // Get custom breadcrumbs
  $breadcrumb = drupal_get_breadcrumb();
  
  // Hide breadcrumbs if only 'Home' exists
  if (count($breadcrumb) > 1) {
    return '<div class="breadcrumb">'. implode(' &raquo; ', $breadcrumb) .'</div>';
  }
}
