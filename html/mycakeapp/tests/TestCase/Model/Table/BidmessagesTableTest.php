<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BidmessagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BidmessagesTable Test Case
 */
class BidmessagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BidmessagesTable
     */
    public $Bidmessages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Bidmessages',
        'app.Bidinfos',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Bidmessages') ? [] : ['className' => BidmessagesTable::class];
        $this->Bidmessages = TableRegistry::getTableLocator()->get('Bidmessages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bidmessages);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
