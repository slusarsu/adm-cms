<?php

namespace App\Adm\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TranslationService
{
    public static function getTranslationFolders(): array
    {
        $folders = Storage::disk('lang')->allDirectories();

        $allFolders = [];

        foreach ($folders as $folder) {
            if(Str::contains($folder,'vendor')) {
                continue;
            }

            $allFolders[$folder] = $folder;
        }

        return $allFolders;
    }

    public static function getTranslationFilesFromFolder($folder): array
    {
        $files = Storage::disk('lang')->files($folder);

        return Arr::mapWithKeys($files, function (string $value, string $key) {
            return [$value => $value];
        });
    }

    public static function getTranslationFileContents(string $file): ?string
    {
        return file_get_contents(lang_path($file));
    }

    public static function getTranslationArray(string $file): array
    {
        $translateFile = include lang_path($file);
        ksort($translateFile);
        return Arr::dot($translateFile);
    }

    public static function setTranslationFileContents($data, string $file, ): false|int
    {
        return file_put_contents(lang_path($file), print_r($data, true));
    }

    public static function saveTranslationsArrayToFile($data, string $file): false|int
    {
        $text = self::getArrayTextForFile($data);
//        $text = self::getArrayDotedTextForFile($data);

        return file_put_contents(lang_path($file), print_r($text, true));
    }

    private static function getArrayTextForFile($data): string
    {
        $unDoted = Arr::undot($data);
        $row = var_export($unDoted, true).';';
        $row = Str::replace("array (", '[', $row);
        $row = Str::replace("),", '],', $row);
        $row = Str::replace(");", '];', $row);
        return "<?php \n\nreturn $row";
    }

    private static function getArrayDotedTextForFile($data): string
    {
        $row = '';
        foreach ($data as $key => $value) {
            if(is_array($value) && empty($value)) {
                $row .= "\t'$key' => [],\n";
                continue;
            }

            $row .= "\t'$key' => '$value',\n";

        }

        return "<?php \n\nreturn [\n $row \n];";
    }

    public static function createEmptyTranslationFile(string $folder, string $file): false|int
    {
        $text = "<?php \n\nreturn [\n\n];";
        $path = $folder.'/'.$file.'.php';

        return file_put_contents(lang_path($path), print_r($text, true));
    }

    public static function copyTranslationFile(array $data): false|int
    {
        $fileNameExploded = explode('/', $data['copy_from_file']);
        $filePath = $data['copy_to_folder'].'/'. $fileNameExploded[1];
        $isFileExist = Storage::disk('lang')->exists($filePath);

        if(!$isFileExist) {
            Storage::disk('lang')->copy($data['copy_from_file'], $filePath);
        }

        return true;
    }

    public static function mergeTranslationFile(array $data): false|int
    {
        $mergeFrom = self::getTranslationArray($data['merge_from_file']);
        $mergeTo = self::getTranslationArray($data['merge_to_file']);

        $merged = array_merge($mergeFrom, $mergeTo);
        return self::saveTranslationsArrayToFile($merged, $data['merge_to_file']);
    }
}
