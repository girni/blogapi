<?php

namespace BlogApi\Blog\File;

use BlogApi\Core\Exceptions\AppException;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Http\UploadedFile;

final class FileManager
{
    /**
     * @var Factory
     */
    private Factory $storage;

    /**
     * FileManager constructor.
     * @param Factory $storage
     */
    public function __construct(Factory $storage)
    {
        $this->storage = $storage;
    }


    /**
     * @param UploadedFile $file
     * @return string
     */
    public function store(UploadedFile $file): string
    {
        $filename = $this->createFilename($file);

        $this->storage->disk('public')->put($filename, file_get_contents($file));

        return $filename;
    }


    public function replaceFiles(string $previousFilename, UploadedFile $file): string
    {
        $deleted = $this->delete($previousFilename);

        if(false === $deleted) {
            throw new AppException(
                sprintf(
                    'Unable to remove file with name %s',
                    $previousFilename
                )
            );
        }

        return $this->store($file);
    }

    public function delete(string $filename): bool
    {
        return $this->storage->disk('public')->delete($filename);
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    private function createFilename(UploadedFile $file): string
    {
        return sprintf('%s.%s', time(), $file->getClientOriginalExtension());
    }
}