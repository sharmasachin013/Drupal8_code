<?php

namespace Drupal\sql_to_d10\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Provides a 'EmpData' migrate source.
 *
 * @MigrateSource(
 *  id = "emp_data",
 *  source_module = "sql_to_d10"
 * )
 */
class EmpData extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    return $this->select('people', 'emp')
      ->fields('emp', array(
        'playerID',
        'nameFirst',
        'nameLast',
        'nameGiven',
        'weight',
        'height',
      ));
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'playerID' => $this->t('playerID'),
      'nameFirst' => $this->t('nameFirst'),
      'nameLast' => $this->t('nameLast'),
      'nameGiven' => $this->t('nameGiven'),
      'weight' => $this->t('weight'),
      'height' => $this->t('height'),
    ];
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      // Key is the name of the field from the fields() method above that we
      // want to use as the unique ID for each row.
      'playerID' => [
        // Type is from the schema array definition.
        'type' => 'text',
        // This is an optional key currently only used by SqlBase.
        'alias' => 'emp',
      ],
    ];
  }

}
