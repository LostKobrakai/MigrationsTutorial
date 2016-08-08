<?php

class Migration_2016_08_08_22_45_36 extends FieldMigration {

	public static $description = "Create bio image";

	protected function getFieldName(){ return 'image'; }

	protected function getFieldType(){ return 'FieldtypeImage'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Image';
		$f->maxFiles = 1;

		$this->insertIntoTemplate('bio', $f, 'project_description');
	}

}