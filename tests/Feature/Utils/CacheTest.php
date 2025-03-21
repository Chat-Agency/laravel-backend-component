<?php

namespace Feature\Utils;

use cache;
use ChatAgency\BackendComponents\Contracts\Cache as ContractsCache;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

use function ChatAgency\BackendComponents\cache;

class CacheTest extends TestCase
{
    #[Test]
    public function a_cache_can_be_created_using_the_cache_helper()
    {
        $cache = cache();

        $this->assertInstanceOf(ContractsCache::class, $cache);
    }

    #[Test]
    public function a_value_can_be_added_to_the_cache()
    {
        $cache = cache();

        $key = 'cache-key';
        $value = 'cache-value';

        $cache->set($key, $value);

        $this->assertEquals($value, $cache->get($key));

    }

    #[Test]
    public function a_value_can_be_removed_from_the_cache()
    {
        $cache = cache();

        $key = 'cache-key';
        $value = 'cache-value';

        $cache->set($key, $value);

        $this->assertEquals($value, $cache->get($key));

        $cache->delete($key);

        $this->assertNull($cache->get($key));

    }
}
