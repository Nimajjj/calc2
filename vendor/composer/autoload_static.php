<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9aedda36835e7f9f3100491ed890bd5f
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'BenjaminEtLaurie\\Calc2\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'BenjaminEtLaurie\\Calc2\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9aedda36835e7f9f3100491ed890bd5f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9aedda36835e7f9f3100491ed890bd5f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9aedda36835e7f9f3100491ed890bd5f::$classMap;

        }, null, ClassLoader::class);
    }
}
