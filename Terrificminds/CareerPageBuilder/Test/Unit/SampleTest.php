<?php
 
namespace Terrificminds\CareerPageBuilder\Test\Unit;

use Codeception\PHPUnit\Constraint\Page;
use Terrificminds\CareerPageBuilder\Api\JobRepositoryInterface;
 
class SampleTest extends \PHPUnit\Framework\TestCase
{
   
    protected $sampleClass;
 
    /**
     * @var string
     */
    protected $expectedMessage;
 
    public function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->sampleClass = $objectManager->getObject('Terrificminds\CareerPageBuilder\Model\Email');
        $this->expectedMessage = 'page';
    }
 
    public function testGetMessage()
    {
        $this->assertEquals($this->expectedMessage, $this->sampleClass->getMessage());
    }
 
}