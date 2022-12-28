<?php

namespace Well\Known\Cache;

use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;
use Well\Known\Factory\WellKnownFactory;

class AdsTxtWarmer implements CacheWarmerInterface
{
    /**
     * @var string
     */
    protected string $shellVerbosity;

    /**
     * @var WellKnownFactory
     */
    protected $wellKnownFactory;

    public function __construct(WellKnownFactory $wellKnownFactory)
    {
        $this->shellVerbosity = getenv("SHELL_VERBOSITY");
        $this->wellKnownFactory   = $wellKnownFactory;
    }

    public function isOptional():bool { return true; }
    public function warmUp($cacheDir): array
    {
        $ads = $this->wellKnownFactory->ads();
        if(!$ads) return [];

        if($this->shellVerbosity > 0 && php_sapi_name() == "cli")
            echo " // Warming up cache... Well Known Bundle.. ads.txt".PHP_EOL.PHP_EOL;

        return [$ads];
    }
}