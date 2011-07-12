<?php
// $Id: theme-settings.php

/**
 * Function to load all node types.
 */
function mdhs_get_node_types() {
  $query = db_query("SELECT type, name FROM {node_type}");
  if (db_affected_rows() > 0) {
    $types = array();
    while ($row = db_fetch_object($query)) {
      $types[$row->type] = $row->name;
    }
    return $types;
  }
  else {
    return FALSE;
  }
}

/**
 * Function to load all node types
 * that can be shown on breadcrumbs.
 */
function mdhs_get_enabled_ntb($settings) {
  $enabled = array();
  if (!isset($settings['ntb'])) {
    return $enabled;
  }
  $enabled = array_filter(array_values($settings['ntb']));
  return $enabled;
}

function mdhs_settings($settings) {
  $types = mdhs_get_node_types();
  if (count($types) > 0) {
    $form['nodes_type_breadcrumb'] = array(
      '#type' => 'fieldset',
      '#title' => t('MDHS Settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
    );
    $enabled = mdhs_get_enabled_ntb($settings);
    $form['nodes_type_breadcrumb']['ntb'] = array(
      '#type' => 'checkboxes',
      '#title' => t('Nodes that has types shown on breadcrumbs'),
      '#default_value' => variable_get('ntb', $enabled),
      '#options' => $types,
      '#description' => t("Please note that the node type will be plural just by prepending 's', i.e events for event."),
    );
    return $form;
  }
}
