<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace Tests;

use FastD\Annotation\Reader;
use PHPUnit_Framework_TestCase;
use Tests\AnnotationsClasses\ChildController;

class ReaderTest extends PHPUnit_Framework_TestCase
{
    public function testAnnotationReader()
    {
        $reader = new Reader();

        $annotation = $reader->getAnnotations(ChildController::class);

        $this->assertEquals('child', $annotation->get('name'));

        $this->assertEquals('base', $annotation->parent()->get('name'));

        $this->assertEquals('method', $annotation->getMethod('indexAction')->get('name'));
    }

    public function testDirectives()
    {
        $reader = new Reader([
            'route' => function ($previous, $index, $value) {
                return $previous . $value;
            }
        ]);

        $annotation = $reader->getAnnotations(ChildController::class);
    }
}

