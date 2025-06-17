<?php

declare(strict_types=1);

namespace ChatAgency\BackendComponents\Utils;

final class ThemeList
{
    private $path = __DIR__.'/../../resources/views/_themes/tailwind';

    public function __construct(?string $path = null)
    {
        if ($path) {
            $this->path = $path;
        }

    }

    public static function make()
    {
        return new self;
    }

    public function scanFiles(): array
    {
        $path = $this->path;
        $realpath = realpath($path);

        if (! $realpath) {
            throw new \Exception("The path path ({$path}) is incorrect", 500);
        }

        $files = scandir($realpath);

        $themes = $this->getThemes($files);

        /**
         * Consider caching if not
         * using static files
         */

        return $themes;
    }

    public function getThemes(array $files, $subFile = null): array
    {
        $themes = [];

        foreach ($files as $file) {

            if ($file === '.' || $file === '..') {
                continue;
            }

            if (is_dir($file)) {
                /**
                 * @todo recursively get themes from subdirectories
                 */
                continue;
            }

            $path = $this->path;

            // Get the theme name from the file name
            $themeName = str_replace('.blade', '', pathinfo($file, PATHINFO_FILENAME));

            $realPath = realpath($path.'/'.$subFile.'/'.$file);

            if (! $realPath) {
                throw new \Exception('The theme file '.$file.' does not exist', 500);
            }

            $themeArray = require $realPath;

            $themes[$themeName] = [
                'themes' => $themeArray,
                'file' => $file,
                'path' => $realPath,
            ];
        }

        return $themes;
    }
}
