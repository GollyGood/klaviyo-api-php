<?php

namespace Klaviyo;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * The base manager class used handle models transmission to and from the API.
 */
interface ManagerInterface {

  /**
   * Instantiates a new instance of this class.
   *
   * This is a factory method that returns a new instance of this class. The
   * factory should pass any needed dependencies into the constructor of this
   * class, but not the container itself. Every call to this method must return
   * a new instance of this class; that is, it may not implement a singleton.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The service container this instance should use.
   */
  public static function create(ContainerInterface $container);

  /**
   * Retrieve the full resource path.
   *
   * @return string
   *   The full resource path incuding the resource prefix and resource path.
   *   Example: /api/v1/lists
   */
  public function getResourcePath($resource);

}
