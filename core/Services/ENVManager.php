<?php

namespace Core\Services;

use Exception;

/**
 * ENV MANAGER
 */
class ENVManager
{
    /** @var string $envFilePath */
    private $envFilePath = __DIR__ . '/../../.env';

    /**
     * GET ENV
     *
     * @param string $key
     * @return void
     */
    public function get(string $key)
    {
        if (!file_exists($this->envFilePath)) {
            throw new Exception('.env not found.');
        }

        $envContents = file_get_contents($this->envFilePath);

        if (empty($envContents)) {
            throw new Exception('.env is null.');
        }

        $lines = explode("\n", $envContents);

        foreach ($lines as $line) {
            $line = trim($line);

            if (empty($line) || strpos($line, '#') === 0) {
                continue;
            }

            list($envKey, $envValue) = explode('=', $line, 2);
            $envKey = trim($envKey);
            $envValue = trim($envValue);

            if ($envKey === $key) {
                return $envValue;
            }
        }

        throw new Exception("'$key' key not found.");
    }
}
