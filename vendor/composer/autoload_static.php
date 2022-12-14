<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit98059e30d9dac8cbdb4ed40375a760a6
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twilio\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twilio\\' => 
        array (
            0 => __DIR__ . '/..' . '/twilio/sdk/src/Twilio',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit98059e30d9dac8cbdb4ed40375a760a6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit98059e30d9dac8cbdb4ed40375a760a6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit98059e30d9dac8cbdb4ed40375a760a6::$classMap;

        }, null, ClassLoader::class);
    }
}
