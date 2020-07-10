<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BidrequestsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BidrequestsTable Test Case
 */
class BidrequestsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BidrequestsTable
     */
    public $Bidrequests;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Bidrequests',
        'app.Biditems',
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
        $config = TableRegistry::getTableLocator()->exists('Bidrequests') ? [] : ['className' => BidrequestsTable::class];
        $this->Bidrequests = TableRegistry::getTableLocator()->get('Bidrequests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bidrequests);

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
