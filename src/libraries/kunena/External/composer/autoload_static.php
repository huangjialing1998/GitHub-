<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6b7e8d3091d7c0760780d4fb1aa23391
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'ScssPhp\\ScssPhp\\' => 16,
        ),
        'K' => 
        array (
            'Kunena\\Tests\\' => 13,
            'Kunena\\Forum\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ScssPhp\\ScssPhp\\' => 
        array (
            0 => __DIR__ . '/..' . '/scssphp/scssphp/src',
        ),
        'Kunena\\Tests\\' => 
        array (
            0 => __DIR__ . '/../../../../..' . '/tests',
        ),
        'Kunena\\Forum\\' => 
        array (
            0 => __DIR__ . '/../../../../..' . '/src/libraries/kunena',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'ScssPhp\\ScssPhp\\Base\\Range' => __DIR__ . '/..' . '/scssphp/scssphp/src/Base/Range.php',
        'ScssPhp\\ScssPhp\\Block' => __DIR__ . '/..' . '/scssphp/scssphp/src/Block.php',
        'ScssPhp\\ScssPhp\\Cache' => __DIR__ . '/..' . '/scssphp/scssphp/src/Cache.php',
        'ScssPhp\\ScssPhp\\Colors' => __DIR__ . '/..' . '/scssphp/scssphp/src/Colors.php',
        'ScssPhp\\ScssPhp\\CompilationResult' => __DIR__ . '/..' . '/scssphp/scssphp/src/CompilationResult.php',
        'ScssPhp\\ScssPhp\\Compiler' => __DIR__ . '/..' . '/scssphp/scssphp/src/Compiler.php',
        'ScssPhp\\ScssPhp\\Compiler\\CachedResult' => __DIR__ . '/..' . '/scssphp/scssphp/src/Compiler/CachedResult.php',
        'ScssPhp\\ScssPhp\\Compiler\\Environment' => __DIR__ . '/..' . '/scssphp/scssphp/src/Compiler/Environment.php',
        'ScssPhp\\ScssPhp\\Exception\\CompilerException' => __DIR__ . '/..' . '/scssphp/scssphp/src/Exception/CompilerException.php',
        'ScssPhp\\ScssPhp\\Exception\\ParserException' => __DIR__ . '/..' . '/scssphp/scssphp/src/Exception/ParserException.php',
        'ScssPhp\\ScssPhp\\Exception\\RangeException' => __DIR__ . '/..' . '/scssphp/scssphp/src/Exception/RangeException.php',
        'ScssPhp\\ScssPhp\\Exception\\SassException' => __DIR__ . '/..' . '/scssphp/scssphp/src/Exception/SassException.php',
        'ScssPhp\\ScssPhp\\Exception\\SassScriptException' => __DIR__ . '/..' . '/scssphp/scssphp/src/Exception/SassScriptException.php',
        'ScssPhp\\ScssPhp\\Exception\\ServerException' => __DIR__ . '/..' . '/scssphp/scssphp/src/Exception/ServerException.php',
        'ScssPhp\\ScssPhp\\Formatter' => __DIR__ . '/..' . '/scssphp/scssphp/src/Formatter.php',
        'ScssPhp\\ScssPhp\\Formatter\\Compact' => __DIR__ . '/..' . '/scssphp/scssphp/src/Formatter/Compact.php',
        'ScssPhp\\ScssPhp\\Formatter\\Compressed' => __DIR__ . '/..' . '/scssphp/scssphp/src/Formatter/Compressed.php',
        'ScssPhp\\ScssPhp\\Formatter\\Crunched' => __DIR__ . '/..' . '/scssphp/scssphp/src/Formatter/Crunched.php',
        'ScssPhp\\ScssPhp\\Formatter\\Debug' => __DIR__ . '/..' . '/scssphp/scssphp/src/Formatter/Debug.php',
        'ScssPhp\\ScssPhp\\Formatter\\Expanded' => __DIR__ . '/..' . '/scssphp/scssphp/src/Formatter/Expanded.php',
        'ScssPhp\\ScssPhp\\Formatter\\Nested' => __DIR__ . '/..' . '/scssphp/scssphp/src/Formatter/Nested.php',
        'ScssPhp\\ScssPhp\\Formatter\\OutputBlock' => __DIR__ . '/..' . '/scssphp/scssphp/src/Formatter/OutputBlock.php',
        'ScssPhp\\ScssPhp\\Logger\\LoggerInterface' => __DIR__ . '/..' . '/scssphp/scssphp/src/Logger/LoggerInterface.php',
        'ScssPhp\\ScssPhp\\Logger\\QuietLogger' => __DIR__ . '/..' . '/scssphp/scssphp/src/Logger/QuietLogger.php',
        'ScssPhp\\ScssPhp\\Logger\\StreamLogger' => __DIR__ . '/..' . '/scssphp/scssphp/src/Logger/StreamLogger.php',
        'ScssPhp\\ScssPhp\\Node' => __DIR__ . '/..' . '/scssphp/scssphp/src/Node.php',
        'ScssPhp\\ScssPhp\\Node\\Number' => __DIR__ . '/..' . '/scssphp/scssphp/src/Node/Number.php',
        'ScssPhp\\ScssPhp\\OutputStyle' => __DIR__ . '/..' . '/scssphp/scssphp/src/OutputStyle.php',
        'ScssPhp\\ScssPhp\\Parser' => __DIR__ . '/..' . '/scssphp/scssphp/src/Parser.php',
        'ScssPhp\\ScssPhp\\SourceMap\\Base64' => __DIR__ . '/..' . '/scssphp/scssphp/src/SourceMap/Base64.php',
        'ScssPhp\\ScssPhp\\SourceMap\\Base64VLQ' => __DIR__ . '/..' . '/scssphp/scssphp/src/SourceMap/Base64VLQ.php',
        'ScssPhp\\ScssPhp\\SourceMap\\SourceMapGenerator' => __DIR__ . '/..' . '/scssphp/scssphp/src/SourceMap/SourceMapGenerator.php',
        'ScssPhp\\ScssPhp\\Type' => __DIR__ . '/..' . '/scssphp/scssphp/src/Type.php',
        'ScssPhp\\ScssPhp\\Util' => __DIR__ . '/..' . '/scssphp/scssphp/src/Util.php',
        'ScssPhp\\ScssPhp\\Util\\Path' => __DIR__ . '/..' . '/scssphp/scssphp/src/Util/Path.php',
        'ScssPhp\\ScssPhp\\ValueConverter' => __DIR__ . '/..' . '/scssphp/scssphp/src/ValueConverter.php',
        'ScssPhp\\ScssPhp\\Version' => __DIR__ . '/..' . '/scssphp/scssphp/src/Version.php',
        'ScssPhp\\ScssPhp\\Warn' => __DIR__ . '/..' . '/scssphp/scssphp/src/Warn.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6b7e8d3091d7c0760780d4fb1aa23391::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6b7e8d3091d7c0760780d4fb1aa23391::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6b7e8d3091d7c0760780d4fb1aa23391::$classMap;

        }, null, ClassLoader::class);
    }
}