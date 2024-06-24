<?php return array(
    'root' => array(
        'name' => '__root__',
        'pretty_version' => '1.0.0+no-version-set',
        'version' => '1.0.0.0',
        'reference' => NULL,
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        '__root__' => array(
            'pretty_version' => '1.0.0+no-version-set',
            'version' => '1.0.0.0',
            'reference' => NULL,
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'phpoffice/math' => array(
            'pretty_version' => '0.1.0',
            'version' => '0.1.0.0',
            'reference' => 'f0f8cad98624459c540cdd61d2a174d834471773',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpoffice/math',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'phpoffice/phpword' => array(
            'pretty_version' => 'dev-master',
            'version' => 'dev-master',
            'reference' => '2daa50c6f34c9cb6c532f72350e4bd8d466d6c71',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpoffice/phpword',
            'aliases' => array(
                0 => '9999999-dev',
            ),
            'dev_requirement' => false,
        ),
    ),
);
