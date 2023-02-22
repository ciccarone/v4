<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc14aa0a9e712921b283b06df7d241f68
{
    public static $files = array (
        'be01b9b16925dcb22165c40b46681ac6' => __DIR__ . '/..' . '/wp-cli/php-cli-tools/lib/cli/cli.php',
        '3937806105cc8e221b8fa8db5b70d2f2' => __DIR__ . '/..' . '/wp-cli/mustangostang-spyc/includes/functions.php',
        'ffb465a494c3101218c4417180c2c9a2' => __DIR__ . '/..' . '/wp-cli/i18n-command/i18n-command.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WP_CLI\\I18n\\' => 12,
        ),
        'S' => 
        array (
            'Symfony\\Component\\Finder\\' => 25,
        ),
        'P' => 
        array (
            'Peast\\test\\' => 11,
            'Peast\\' => 6,
        ),
        'M' => 
        array (
            'Mustangostang\\' => 14,
        ),
        'G' => 
        array (
            'Gettext\\Languages\\' => 18,
            'Gettext\\' => 8,
        ),
        'D' => 
        array (
            'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 55,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WP_CLI\\I18n\\' => 
        array (
            0 => __DIR__ . '/..' . '/wp-cli/i18n-command/src',
        ),
        'Symfony\\Component\\Finder\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/finder',
        ),
        'Peast\\test\\' => 
        array (
            0 => __DIR__ . '/..' . '/mck89/peast/test/Peast',
        ),
        'Peast\\' => 
        array (
            0 => __DIR__ . '/..' . '/mck89/peast/lib/Peast',
        ),
        'Mustangostang\\' => 
        array (
            0 => __DIR__ . '/..' . '/wp-cli/mustangostang-spyc/src',
        ),
        'Gettext\\Languages\\' => 
        array (
            0 => __DIR__ . '/..' . '/gettext/languages/src',
        ),
        'Gettext\\' => 
        array (
            0 => __DIR__ . '/..' . '/gettext/gettext/src',
        ),
        'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 
        array (
            0 => __DIR__ . '/..' . '/dealerdirect/phpcodesniffer-composer-installer/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'c' => 
        array (
            'cli' => 
            array (
                0 => __DIR__ . '/..' . '/wp-cli/php-cli-tools/lib',
            ),
        ),
        'W' => 
        array (
            'WP_CLI\\' => 
            array (
                0 => __DIR__ . '/..' . '/wp-cli/wp-cli/php',
            ),
        ),
        'R' => 
        array (
            'Requests' => 
            array (
                0 => __DIR__ . '/..' . '/rmccue/requests/library',
            ),
        ),
        'M' => 
        array (
            'Mustache' => 
            array (
                0 => __DIR__ . '/..' . '/mustache/mustache/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'JakubOnderka\\PhpParallelLint\\Application' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Application.php',
        'JakubOnderka\\PhpParallelLint\\ArrayIterator' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Settings.php',
        'JakubOnderka\\PhpParallelLint\\Blame' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Error.php',
        'JakubOnderka\\PhpParallelLint\\CheckstyleOutput' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Output.php',
        'JakubOnderka\\PhpParallelLint\\ConsoleWriter' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Output.php',
        'JakubOnderka\\PhpParallelLint\\Contracts\\SyntaxErrorCallback' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Contracts/SyntaxErrorCallback.php',
        'JakubOnderka\\PhpParallelLint\\Error' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Error.php',
        'JakubOnderka\\PhpParallelLint\\ErrorFormatter' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/ErrorFormatter.php',
        'JakubOnderka\\PhpParallelLint\\Exception' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/exceptions.php',
        'JakubOnderka\\PhpParallelLint\\FileWriter' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Output.php',
        'JakubOnderka\\PhpParallelLint\\IWriter' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Output.php',
        'JakubOnderka\\PhpParallelLint\\InvalidArgumentException' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/exceptions.php',
        'JakubOnderka\\PhpParallelLint\\JsonOutput' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Output.php',
        'JakubOnderka\\PhpParallelLint\\Manager' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Manager.php',
        'JakubOnderka\\PhpParallelLint\\MultipleWriter' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Output.php',
        'JakubOnderka\\PhpParallelLint\\NotExistsClassException' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/exceptions.php',
        'JakubOnderka\\PhpParallelLint\\NotExistsPathException' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/exceptions.php',
        'JakubOnderka\\PhpParallelLint\\NotImplementCallbackException' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/exceptions.php',
        'JakubOnderka\\PhpParallelLint\\NullWriter' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Output.php',
        'JakubOnderka\\PhpParallelLint\\Output' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Output.php',
        'JakubOnderka\\PhpParallelLint\\ParallelLint' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/ParallelLint.php',
        'JakubOnderka\\PhpParallelLint\\Process\\GitBlameProcess' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Process/GitBlameProcess.php',
        'JakubOnderka\\PhpParallelLint\\Process\\LintProcess' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Process/LintProcess.php',
        'JakubOnderka\\PhpParallelLint\\Process\\PhpExecutable' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Process/PhpExecutable.php',
        'JakubOnderka\\PhpParallelLint\\Process\\PhpProcess' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Process/PhpProcess.php',
        'JakubOnderka\\PhpParallelLint\\Process\\Process' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Process/Process.php',
        'JakubOnderka\\PhpParallelLint\\Process\\SkipLintProcess' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Process/SkipLintProcess.php',
        'JakubOnderka\\PhpParallelLint\\RecursiveDirectoryFilterIterator' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Manager.php',
        'JakubOnderka\\PhpParallelLint\\Result' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Result.php',
        'JakubOnderka\\PhpParallelLint\\RunTimeException' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/exceptions.php',
        'JakubOnderka\\PhpParallelLint\\Settings' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Settings.php',
        'JakubOnderka\\PhpParallelLint\\SyntaxError' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Error.php',
        'JakubOnderka\\PhpParallelLint\\TextOutput' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Output.php',
        'JakubOnderka\\PhpParallelLint\\TextOutputColored' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/Output.php',
        'JsonSerializable' => __DIR__ . '/..' . '/php-parallel-lint/php-parallel-lint/src/polyfill.php',
        'WP_CLI' => __DIR__ . '/..' . '/wp-cli/wp-cli/php/class-wp-cli.php',
        'WP_CLI_Command' => __DIR__ . '/..' . '/wp-cli/wp-cli/php/class-wp-cli-command.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc14aa0a9e712921b283b06df7d241f68::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc14aa0a9e712921b283b06df7d241f68::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitc14aa0a9e712921b283b06df7d241f68::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitc14aa0a9e712921b283b06df7d241f68::$classMap;

        }, null, ClassLoader::class);
    }
}
