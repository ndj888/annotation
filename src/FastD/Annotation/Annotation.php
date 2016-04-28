<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/4/26
 * Time: 上午11:36
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Annotation;

/**
 * Class Annotation
 *
 * @package FastD\Annotation
 */
class Annotation extends Annotator
{
    /**
     * @var Annotation[]
     */
    protected $methods;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Annotation
     */
    protected $parent;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var string
     */
    protected $suffix;

    /**
     * Annotation constructor.
     * @param $class
     * @param null $prefix
     * @param null $suffix
     */
    public function __construct($class, $prefix = null, $suffix = null)
    {
        $this->setPrefix($prefix);

        $this->setSuffix($suffix);

        if (null !== $class) {
            $reflection = new \ReflectionClass($class);

            $params = $this->parse($reflection->getDocComment());

            $this->setParameters($params);
            $this->setName($reflection->getName());

            $methods = [];
            foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                if (null !== $this->getSuffix() && false === strpos($method->getName(), $this->getSuffix())) {
                    continue;
                }

                if (null !== $this->getPrefix() && false === strpos($method->getName(), $this->getPrefix())) {
                    continue;
                }

                $annotation = clone $this;
                $annotation->setName($method->getName());
                $annotation->setParent($this);
                $annotation->setParameters($this->parse($method->getDocComment()));
                $methods[] = $annotation;
            }
            $this->setMethods($methods);

            unset($reflection, $annotation);
        }
    }

    /**
     * @return Annotation[]
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @param Annotation[] $methods
     * @return $this
     */
    public function setMethods(array $methods)
    {
        $this->methods = $methods;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Annotation
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Annotation $parent
     * @return $this
     */
    public function setParent(Annotation $parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return string
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * @param string $suffix
     * @return $this
     */
    public function setSuffix($suffix)
    {
        $this->suffix = $suffix;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     * @return $this
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * @return $this
     */
    public function __clone()
    {
        $this->methods = null;
        $this->parameters = null;
        $this->name = null;
        $this->parent = null;
        return $this;
    }
}