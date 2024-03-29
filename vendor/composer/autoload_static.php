<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcc5a5eb46f4bf1e6e37af8078ed18f7c
{
    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'phpDocumentor\\Reflection\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'phpDocumentor\\Reflection\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpdocumentor/reflection-common/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcc5a5eb46f4bf1e6e37af8078ed18f7c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcc5a5eb46f4bf1e6e37af8078ed18f7c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcc5a5eb46f4bf1e6e37af8078ed18f7c::$classMap;

        }, null, ClassLoader::class);
    }
}
