<?php

/*
 * This file is part of CacheServiceProvider.
 *
 * (c) Quentin Aupetit <qaupetit@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Silex\Cache;

class MemcacheCache extends AbstractCache
{
    /**
     * @var Memcache
     */
    private $_memcache;

    /**
     * {@inheritdoc}
     */
    public function __construct(array $options = array())
    {
        if (!isset($options['memcache']) || !$options['memcache'] instanceof \Memcache) {
            $options['memcache'] = new \Memcache;
        }

        $this->setMemcache($options['memcache']);
    }

    /**
     * Sets the Memcache instance to use.
     *
     * @param Memcache $memcache
     */
    public function setMemcache(\Memcache $memcache)
    {
        $this->_memcache = $memcache;
    }

    /**
     * Gets the Memcache instance used by the cache.
     *
     * @return Memcache
     */
    public function getMemcache()
    {
        return $this->_memcache;
    }

    /**
     * {@inheritdoc}
     */
    static function isSupported()
    {
        return class_exists('\Memcache');
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        return $memcache->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function delete($key)
    {
        return $memcache->delete($key);
    }

    /**
     * {@inheritdoc}
     */
    public function exists($key)
    {
        return !!$memcache->get($key);
    }

    /**
     * {@inheritdoc}
     */
    public function fetch($key)
    {
        return $memcache->get($key);
    }

    /**
     * {@inheritdoc}
     */
    public function store($key, $var = null, $ttl = 0)
    {
        return $memcache->set($key, $var, 0, $ttl);
    }
}