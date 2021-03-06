<?php
/**
 *
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Annotation\Exceptions;

/**
 * Class InvalidFunctionException
 *
 * @package FastD\Annotation\Exceptions
 */
class UndefinedAnnotationFunctionException extends AnnotationException
{
    /**
     * InvalidFunctionException constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct(sprintf('Annotation function "%s" is undefined.', $name));
    }
}