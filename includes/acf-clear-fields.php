<?php

if ( ! defined( 'ABSPATH')) {
    exit;
}

/*Deleting content when an ACF field is deleted is easy, relatively. Please note that the use of this function cannot be undone and it will erase all traces of content for any ACF field that is deleted. 

Please be sure that this is something that you want to do before implementing this and I would strongly suggest that this is only enabled during development and not on a live site. Should a client go into ACF for some reason and delete a field, there is nothing that you’d be able to do to recover form it. */

// this action is run by ACF whenever a field is deleted
// and is called for every field in a field group when a field group is deleted
add_action('acf/delete_field', 'delete_acf_content_on_delete_field'); // Разкомментировать для использования

function delete_acf_content_on_delete_field($field) {
  // runs when acf deletes a field
  // find all occurences of the field key in all tables and delete them
  // and the custom field associated with them
  global $wpdb;
  // remove any tables from this array that you don't want to check
  $tables = array('options', 'postmeta', 'termmeta', 'usermeta', 'commentmeta');
  foreach ($tables as $table) {
    $key_field = 'meta_key';
    $value_field = 'meta_value';
    if ($table == 'options') {
      $key_field = 'option_name';
      $value_field = 'option_value';
    }
    $table = $wpdb->{$table};
    // this query gets all key fields matching the acf key reference field
    $query = 'SELECT DISTINCT('.$key_field.')
              FROM '.$table.'
              WHERE '.$value_field.' = "'.$field['key'].'"';
    $results = $wpdb->get_col($query);
    if (!count($results)) {
      // no content found in this table
      continue;
    }
    // loop through keys and construct list of meta_key/option_names to delete
    $keys = array();
    foreach ($results as $key) {
      $keys[] = $key; // delete acf field key reference
      $keys[] = substr($key, 1); // delete acf field value
    }
    // do escping of all values.... just in case
    $keys = $wpdb->_escape($keys);
    // delete all of the content
    $query = 'DELETE FROM '.$table.'
              WHERE '.$key_field.' IN ("'.implode('","', $keys).'")';
    $wpdb->query($query);
  } // end foreach table
}