<?php declare(strict_types=1);

namespace App\Kernel;

final class AppParameters
{
    private string $projectDir;

    protected array $parameters;

    public function __construct(string $projectDir, array $parameters)
    {
        $this->parameters = $parameters;
        $this->projectDir = $projectDir;
    }

    /**
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public function get(string $key, $default = null)
    {
        return \array_key_exists($key, $this->parameters) ? $this->parameters[$key] : $default;
    }

    /**
     * @return string
     */
    public function getProjectDir(): string
    {
        return $this->projectDir;
    }
}
