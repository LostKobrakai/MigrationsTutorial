<?php

class Migration_2016_08_07_22_23_59 extends Migration {

	public static $description = "Correct project_process naming";

	public function update() {
		$field = $this->fields->get('project_process');
		$field->label = 'Process';
		$field->description = 'Will be the third element in the project detail page';
		$field->save();
	}

	public function downgrade() {
		// We're sure we won't need to rollback that change
	}

}