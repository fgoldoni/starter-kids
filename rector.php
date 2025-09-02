<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use RectorLaravel\Set\LaravelSetProvider;

return RectorConfig::configure()
    // Dossiers à analyser
    ->withPaths([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
        __DIR__ . '/Modules',
        __DIR__ . '/core',
    ])

    ->withSkip([
        __DIR__ . '/bootstrap/*',
        __DIR__ . '/storage/*',
        __DIR__ . '/vendor/*',
        __DIR__ . '/node_modules/*',
        __DIR__ . '/public/*',
        __DIR__ . '/database/migrations/*',
    ])

    ->withParallel()

    ->withImportNames(removeUnusedImports: true)

    ->withPhpSets()

    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        naming: true,
        privatization: true,
        typeDeclarations: true,
        rectorPreset: true,
    )

    ->withSetProviders(LaravelSetProvider::class)
    ->withComposerBased(laravel: true);
