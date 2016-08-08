<?php

class Migration_2016_08_08_21_36_33 extends Migration {

	public static $description = "Add custom CKEditor styles";

	public function update() {
		$f = $this->fields->get('title_stylized');
		$f->stylesSet = 'mystyles:/site/modules/InputfieldCKEditor/mystyles.js';
		$f->save();
	}

	public function downgrade() {
		$f = $this->fields->get('title_stylized');
		$f->stylesSet = '';
		$f->save();
	}

}