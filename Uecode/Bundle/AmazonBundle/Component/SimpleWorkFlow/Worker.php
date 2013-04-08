<?php

/**
 * Common class for decider and activity workers
 *
 * @package amazon-bundle
 * @copyright (c) 2013 Underground Elephant
 * @author John Pancoast
 */

namespace Uecode\Bundle\AmazonBundle\Component\SimpleWorkFlow;

// Amazon components
use \Uecode\Bundle\AmazonBundle\Component\AmazonComponent;

// Amazon Classes
use \AmazonSWF;
use \CFRuntime;

// Symfony and related
use Monolog\Logger;

class Worker extends AmazonComponent
{
	/**
	 * An id representing this execution
	 *
	 * This id is created locally and remains the same through the entire execution of this file.
	 *
	 * @access  protected
	 */
	protected $executionId;

	/**
	 * Amazon created run id.
	 *
	 * This id is created by amazon when a workflow is started and is passed in the
	 * response from PollForDecisionTask.
	 *
	 * @access  protected
	 */
	protected $amazonRunId;

	/**
	 * User created workflow id.
	 *
	 * This id is createde by the client that started the workflow and is passed in the
	 * response from PollForDecisionTask.
	 *
	 * @access protected
	 */
	protected $amazonWorkflowId;

	/**
	 * @var Logger Logger instance
	 *
	 * @access protected
	 */
	protected $logger;

	/**
	 * Constructor
	 *
	 * @param AmazonSWF $swf An instance of the main amazon class
	 * @access protected
	 */
	protected function __construct(AmazonSWF $swf)
	{
		$this->executionId = self::generateExecutionId();
		$this->setAmazonClass($swf);
		$this->setLogger($swf->getLogger());
	}

	/**
	 * Get the current execution id
	 *
	 * @access  public
	 * @return string
	 */
	public function getExecutionId()
	{
		return $this->executionId;
	}

	/**
	 * Get the amazon run id
	 *
	 * @access public
	 * @return string
	 */
	public function getAmazonRunId()
	{
		return $this->amazonRunId;
	}

	/**
	 * Get the amazon workflow id
	 *
	 * @access public
	 * @return string
	 */
	public function getAmazonWorkflowId()
	{
		return $this->amazonWorkflowId;
	}

	/**
	 * Set the logger
	 *
	 * @param Logger $logger
	 */
	public function setLogger(Logger $logger)
	{
		$this->logger = $logger;
	}

	/**
	 * Get the logger
	 *
	 * @return Logger
	 */
	public function getLogger()
	{
		return $this->logger;
	}

	/**
	 * Generate an execution id
	 *
	 * @static
	 * @access public
	 * @return string
	 */
	public static function generateExecutionId()
	{
		return uniqid(getmypid().'-', true);
	}
}