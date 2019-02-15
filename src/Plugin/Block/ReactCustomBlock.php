<?php

namespace Drupal\react_custom_libraries\Plugin\Block;

use Drupal\pdb\Plugin\Block\PdbBlock;

/**
 * Exposes a React component as a block.
 *
 * @Block(
 *   id = "react_custom_component",
 *   admin_label = @Translation("React custom component"),
 *   deriver = "\Drupal\react_custom_libraries\Plugin\Derivative\ReactCustomBlockDeriver"
 * )
 */
class ReactCustomBlock extends PdbBlock {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $info = $this->getComponentInfo();
    $machine_name = $info['machine_name'];

    $build = parent::build();
    $build['#allowed_tags'] = array($machine_name);
    $build['#markup'] = '<' . $machine_name . ' id="' . $machine_name . '"></' . $machine_name . '>';

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function attachSettings(array $component) {
    $machine_name = $component['machine_name'];

    $attached = array();
    if (array_key_exists('path', $component)) {
      $attached['drupalSettings']['react-custom-apps'][$machine_name]['uri'] = '/' . $component['path'];
    }

    return $attached;
  }

  /**
   * {@inheritdoc}
   */
  public function attachLibraries(array $component) {
    $parent_libraries = parent::attachLibraries($component);

    $framework_libraries = array(
      'react_custom_libraries/react-custom'
    );

    $libraries = array(
      'library' => array_merge($parent_libraries, $framework_libraries),
    );

    return $libraries;
  }

}
