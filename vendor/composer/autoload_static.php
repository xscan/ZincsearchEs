<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit70db170bb38aa9d75d2c930363b6e6e7
{
    public static $files = array (
        'ad155f8f1cf0d418fe49e248db8c661b' => __DIR__ . '/..' . '/react/promise/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'Z' => 
        array (
            'ZincsearchEs\\' => 13,
        ),
        'R' => 
        array (
            'React\\Promise\\' => 14,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Stream\\' => 18,
            'GuzzleHttp\\Ring\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ZincsearchEs\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/ZincsearchEs',
        ),
        'React\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/promise/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'GuzzleHttp\\Stream\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/streams/src',
        ),
        'GuzzleHttp\\Ring\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/ringphp/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit70db170bb38aa9d75d2c930363b6e6e7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit70db170bb38aa9d75d2c930363b6e6e7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit70db170bb38aa9d75d2c930363b6e6e7::$classMap;

        }, null, ClassLoader::class);
    }
}