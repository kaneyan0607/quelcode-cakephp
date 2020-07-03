<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BiditemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BiditemsTable Test Case
 */
class BiditemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BiditemsTable
     */
    public $Biditems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Biditems',
        'app.Users',
        'app.Bidinfo',
        'app.Bidrequests',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Biditems') ? [] : ['className' => BiditemsTable::class];
        $this->Biditems = TableRegistry::getTableLocator()->get('Biditems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Biditems);

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
