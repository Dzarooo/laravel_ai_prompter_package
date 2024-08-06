<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5f84b1177b67fade37b18ae68cb61d35
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Dzaro\\ImageGenerator\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Dzaro\\ImageGenerator\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit5f84b1177b67fade37b18ae68cb61d35::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5f84b1177b67fade37b18ae68cb61d35::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5f84b1177b67fade37b18ae68cb61d35::$classMap;

        }, null, ClassLoader::class);
    }
}
