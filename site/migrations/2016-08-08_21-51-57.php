<?php

class Migration_2016_08_08_21_51_57 extends Migration {

	public static $description = "Fix unique name for styles";

	public function update() {
		foreach (['project_description', 'project_process'] as $name) {
			$f = $this->fields->get($name);
			$f->stylesSet = 'mystyles2:/site/modules/InputfieldCKEditor/mystyles.js';
			$f->save();
		}
	}

	public function downgrade() {
		foreach (['project_description', 'project_process'] as $name) {
			$f = $this->fields->get($name);
			$f->stylesSet = 'mystyles:/site/modules/InputfieldCKEditor/mystyles2.js';
			$f->save();
		}
	}

}