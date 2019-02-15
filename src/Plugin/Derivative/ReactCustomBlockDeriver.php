<?php

namespace Drupal\react_custom_libraries\Plugin\Derivative;

use Drupal\pdb\Plugin\Derivative\PdbBlockDeriver;

/**
 * Derives block plugin definitions for React components.
 */
class ReactCustomBlockDeriver extends PdbBlockDeriver {

  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    $definitions = parent::getDerivativeDefinitions($base_plugin_definition);

    return array_filter($definitions, function (array $definition) {
      return $definition['info']['presentation'] == 'react_custom';
    });
  }

}
