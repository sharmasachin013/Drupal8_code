<?php

namespace Drupal\mymodule\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "custom_block",
 *   admin_label = @Translation("Custom Block"),
 *   category = @Translation("Custom Block"),
 * )
 */
class CustomBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
 
    $database = \Drupal::database();
    $query = $database->select('node_field_data', 'n');
     
    // Add extra detail to this query object: a condition, fields and a range.
    $query->fields('n');
    $query->range(0, 5);
    $result = $query->execute();
    $record = $result->fetchAll();
    $titles = [];
 
    foreach($record as $value){
        $titles[] = $value->title;
    }

    return [
      '#theme' => 'my_custom_block',
      '#titles' => $titles,
    ];
  }

}