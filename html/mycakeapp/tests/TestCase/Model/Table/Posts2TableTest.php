<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\Posts2Table;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\Posts2Table Test Case
 */
class Posts2TableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\Posts2Table
     */
    public $Posts2;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Posts2',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Posts2') ? [] : ['className' => Posts2Table::class];
        $this->Posts2 = TableRegistry::getTableLocator()->get('Posts2', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Posts2);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
