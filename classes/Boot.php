<?php

namespace irclasses;

class Boot {

	private array $bootClasses;


	public function __construct() {

		$this->boot_classes();

	}


	protected function boot_classes() {

		foreach ( glob( get_template_directory() . '/classes/Boot/*') as $file ){

			$classname = 'irclasses\Boot\\' . pathinfo($file, PATHINFO_FILENAME);
			new $classname;

		}


	}


}