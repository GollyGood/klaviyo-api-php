<?php

namespace Klaviyo;

/**
 * The base manager class used handle models transmission to and from the API.
 */
interface ManagerInterface {

  /**
   * Retrieve the full resource path.
   *
   * @return string
   *   The full resource path incuding the resource prefix and resource path.
   *   Example: /api/v1/lists
   */
  public function getResourcePath($resource);

}
