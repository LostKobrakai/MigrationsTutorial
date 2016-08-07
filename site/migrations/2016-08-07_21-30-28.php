<?php

class Migration_2016_08_07_21_30_28 extends Migration {

	public static $description = "Create process";

	public function update() {
		$field = $this->fields->get('project_description');
		$clone = $this->fields->clone($field);
		$clone->name = 'project_process';
		$clone->save();
	}

	public function downgrade() {
		$field = $this->getField('project_process');

		$fgs = $field->getFieldgroups();

		foreach($fgs as $fg){
			$fg->remove($field);
			$fg->save();
		}

		$this->fields->delete($field);
	}

}