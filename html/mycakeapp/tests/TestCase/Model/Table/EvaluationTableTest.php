<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EvaluationTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EvaluationTable Test Case
 */
class EvaluationTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EvaluationTable
     */
    public $Evaluation;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Evaluation',
        'app.ReceiveEvaluationUsers',
        'app.EvaluationUsers',
        'app.Bidinfos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Evaluation') ? [] : ['className' => EvaluationTable::class];
        $this->Evaluation = TableRegistry::getTableLocator()->get('Evaluation', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Evaluation);

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
