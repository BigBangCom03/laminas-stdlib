<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Stdlib\Hydrator\NamingStrategy;

class ArrayMapNamingStrategy implements NamingStrategyInterface
{
    /**
     * @var array
     */
    protected $hydrationMap = array();

    /**
     * @var array
     */
    protected $extractionMap = array();

    /**
     * Constructor
     *
     * @param array $extractionMap
     * @param array $hydrationMap
     */
    public function __construct(array $extractionMap = array(), array $hydrationMap = array())
    {
        $this->setExtractionMap($extractionMap, false);
        $this->setHydrationMap($hydrationMap, false);
    }

    /**
     * Sets hydrationMap
     *
     * @param  array $hydrationMap
     * @param  bool  $bidirectional
     * @return self
     */
    public function setHydrationMap(array $hydrationMap, $bidirectional = true)
    {
        $this->hydrationMap = $hydrationMap;

        if ($bidirectional) {
            $this->setExtractionMap(array_flip($hydrationMap), false);
        }

        return $this;
    }

    /**
     * Gets hydrationMap
     *
     * @return array
     */
    public function getHydrationMap()
    {
        return $this->hydrationMap;
    }

    /**
     * Sets extractionMap
     *
     * @param  array $extractionMap
     * @param  bool  $bidirectional
     * @return self
     */
    public function setExtractionMap(array $extractionMap, $bidirectional = true)
    {
        $this->extractionMap = $extractionMap;

        if ($bidirectional) {
            $this->setHydrationMap(array_flip($extractionMap), false);
        }

        return $this;
    }

    /**
     * Gets extractionMap
     *
     * @return array
     */
    public function getExtractionMap()
    {
        return $this->extractionMap;
    }

    /**
     * {@inheritDoc}
     */
    public function hydrate($name)
    {
        if (isset($this->getHydrationMap()[$name])) {
            return $this->getHydrationMap()[$name];
        }

        return $name;
    }

    /**
     * {@inheritDoc}
     */
    public function extract($name)
    {
        if (isset($this->getExtractionMap()[$name])) {
            return $this->getExtractionMap()[$name];
        }

        return $name;
    }
}
