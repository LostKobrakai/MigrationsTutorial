<?php

class Migration_2016_08_07_23_04_19 extends Migration {

	public static $description = "Put Roles and URL field side by side";

	public function update() {
		$this->editInTemplateContext('project', 'project_roles', function($f){
			$f->columnWidth = 50;
		});

		$this->editInTemplateContext('project', 'project_url', function($f){
			$f->columnWidth = 50;
		});
	}

	public function downgrade() {
		$this->editInTemplateContext('project', 'project_roles', function($f){
			$f->columnWidth = 100;
		});

		$this->editInTemplateContext('project', 'project_url', function($f){
			$f->columnWidth = 100;
		});
	}

}