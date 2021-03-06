<?php

use Sami\Sami;
use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Version\GitVersionCollection;

$directory = __DIR__ . '/src';

$versions = GitVersionCollection::create($directory)
  ->add('0.3.0', '0.3.0')
  ->add('0.2.0', '0.2.0')
  ->add('0.1.0', '0.1.0')
  ->add('master', 'master branch')
  ->add('develop', 'develop branch');

$sami = new Sami($directory, [
  'theme'                => 'default',
  'versions'             => $versions,
  'title'                => 'Klaviyo PHP API Library',
  'build_dir'            => '/tmp/sami/build/klaviyo-api-php/%version%',
  'cache_dir'            => '/tmp/sami/cache/klaviyo-api-php/%version%',
  'remote_repository'    => new GitHubRemoteRepository('GollyGood/klaviyo-api-php', dirname($directory)),
  'default_opened_level' => 1,
]);

return $sami;
