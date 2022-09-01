<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit04c4ac89f8c1d97b4797bedff4522b7f
{
    public static $files = array (
        '5f2aad0f1beee097fba38a252c1ebd00' => __DIR__ . '/..' . '/a7/autoload/package.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WPackio\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WPackio\\' => 
        array (
            0 => __DIR__ . '/..' . '/wpackio/enqueue/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit04c4ac89f8c1d97b4797bedff4522b7f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit04c4ac89f8c1d97b4797bedff4522b7f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit04c4ac89f8c1d97b4797bedff4522b7f::$classMap;

        }, null, ClassLoader::class);
    }
}
