<?php


namespace Drupal\mflayout;


class MfLayoutSlotValues {

  /**
   * @var object
   */
  private $entity;

  /**
   * @var string
   */
  private $entityType;

  /**
   * @var string[]
   */
  private $slotFieldNames;

  /**
   * @var array[]
   */
  private $slotFieldItems = array();

  /**
   * @param object $entity
   * @param string $entity_type
   * @param string[] $slot_field_names
   */
  function __construct($entity, $entity_type, array $slot_field_names) {
    $this->entity = $entity;
    $this->entityType = $entity_type;
    $this->slotFieldNames = $slot_field_names;
    foreach ($slot_field_names as $slot_name => $field_name) {
      $this->slotFieldItems[$slot_name] = field_get_items($entity_type, $entity, $field_name);
    }
  }

  /**
   * @param string $slot_key
   *
   * @return array|null
   */
  function slotGetItem($slot_key) {
    return is_array($this->slotFieldItems[$slot_key])
      ? reset($this->slotFieldItems[$slot_key])
      : NULL;
  }

  /**
   * @param string $slot_key
   * @param string $key
   *
   * @return mixed|null
   */
  function slotGetValue($slot_key, $key = 'value') {
    $item = $this->slotGetItem($slot_key);
    return (isset($item) && isset($item[$key]))
      ? $item[$key]
      : NULL;
  }

  /**
   * @param string $slot_key
   *
   * @return array[]
   */
  function slotGetItems($slot_key) {
    return $this->slotFieldItems[$slot_key];
  }

  /**
   * @param string $slot_key
   * @param int $delta
   * @param array $settings
   *
   * @return array|null
   */
  function slotViewValue($slot_key, $delta = 0, $settings = array()) {
    $item = $this->slotFieldItems[$slot_key][$delta];
    if (!empty($item)) {
      return field_view_value(
        $this->entityType,
        $this->entity,
        $this->slotFieldNames[$slot_key],
        $item,
        $settings);
    }
    return NULL;
  }

  /**
   * @param string $slot_key
   * @param int $delta
   * @param array $settings
   *
   * @return null|string
   */
  function slotRenderValue($slot_key, $delta = 0, $settings = array()) {
    $out = $this->slotViewValue($slot_key, $delta, $settings);
    if (!empty($out)) {
      return drupal_render($out);
    }
    return NULL;
  }

  /**
   * @return \stdClass
   */
  function getEntity() {
    return $this->entity;
  }

  /**
   * @return string
   */
  function getEntityType() {
    return $this->entityType;
  }

} 
