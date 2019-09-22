<?php

namespace App\Core;

/**
 * Storage
 * 
 * A class to control files, directories and perimissions.
 */
class Storage
{
    /**
     * Delete method
     * 
     * to delete a file or directory.
     *
     * @param string $file
     * @return void
     */
    public static function delete(string $file)
    {
        if (is_file($file) && file_exists($file)) {
            unlink($file);
        }
        elseif (is_dir($file)) {
            rmdir($file);
        }
        else {
            return false;
        }
    }

    /**
     * read
     *
     * @param string $file
     * @return array
     */
    public static function read(string $file): array
    {
        if (is_file($file) && file_exists($file)) {
            $fs = fopen($file, 'r');
            $result = [];
            while (!feof($fs)) {
                $result[] = fgets($fs);
            }
            fclose($fs);
            return $result;
        }
        return [-1];
    }

    /**
     * write
     *
     * @param string $file
     * @param array $lines
     * @param string|null $delimiter
     * @return void
     */
    public static function write(string $file, array $lines, ?string $delimiter = "\n"): void
    {
        $fs = fopen($file, 'w');
        foreach ($lines as $item) {
            fwrite($fs, $item . $delimiter);
        }
        fclose($fs);
    }
}
