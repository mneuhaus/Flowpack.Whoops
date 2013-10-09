<?php
namespace Flowpack\Whoops;

/*                                                                        *
 * This script belongs to the TYPO3 Flow framework.                       *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

/**
 * A basic but solid exception handler which catches everything which
 * falls through the other exception handlers and provides useful debugging
 * information.
 *
 * @Flow\Scope("singleton")
 */
class WhoopsErrorHandler extends \TYPO3\Flow\Error\AbstractExceptionHandler {
	/**
	 * Constructs this exception handler - registers itself as the default exception handler.
	 *
	 */
	public function __construct() {
		$run     = new Run;
		$handler = new PrettyPageHandler;

		// Add a custom table to the layout:
		$handler->addDataTable('Ice-cream I like', array(
			'Chocolate' => 'yes',
			'Coffee & chocolate' => 'a lot',
			'Strawberry & chocolate' => 'it\'s alright',
			'Vanilla' => 'ew'
		));

		$run->pushHandler($handler);

		// // Example: tag all frames inside a function with their function name
		// $run->pushHandler(function($exception, $inspector, $run) {
		// 	$inspector->getFrames()->map(function($frame) {
		// 		if($function = $frame->getFunction()) {
		// 			$frame->addComment("This frame is within function '$function'", 'cpt-obvious');
		// 		}
		// 		return $frame;
		// 	});
		// });

		$handler->setEditor('sublime');

		$run->register();
	}

	/**
	 * Formats and echoes the exception as XHTML.
	 *
	 * @param \Exception $exception The exception object
	 * @return void
	 */
	protected function echoExceptionWeb(\Exception $exception) {}

	/**
	 * Formats and echoes the exception for the command line
	 *
	 * @param \Exception $exception The exception object
	 * @return void
	 */
	protected function echoExceptionCli(\Exception $exception) {}
}

?>