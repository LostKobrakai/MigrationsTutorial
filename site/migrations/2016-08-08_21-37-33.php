<?php

class Migration_2016_08_08_21_37_33 extends Migration {

	public static $description = "Add custom CKEditor styles";

	public function update() {
		foreach (['project_description', 'project_process'] as $name) {
			$f = $this->fields->get($name);
			$f->stylesSet = 'mystyles:/site/modules/InputfieldCKEditor/mystyles2.js';
			$f->contentsInlineCss = '/site/modules/InputfieldCKEditor/contents-inline.css';
			$f->save();
		}
	}

	public function downgrade() {
		foreach (['project_description', 'project_process'] as $name) {
			$f = $this->fields->get($name);
			$f->stylesSet = '';
			$f->contentsInlineCss = '';
			$f->save();
		}
	}

}