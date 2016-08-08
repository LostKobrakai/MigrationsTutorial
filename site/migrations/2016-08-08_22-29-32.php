<?php

class Migration_2016_08_08_22_29_32 extends FieldMigration {

	public static $description = "Create testimony field";

	protected function getFieldName(){ return 'testimony'; }

	protected function getFieldType(){ return 'FieldtypeTextarea'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Testimony';
		$f->notes = 'Devide testimony and author by a line of just three dashes: ---.';
		$f->contentType = FieldtypeTextarea::contentTypeUnknown;

		// Inputfield Settings
		$f->rows = 5;
		$f->stripTags = true;

		$this->insertIntoTemplate('project', $f, 'project_roles', false);
	}

}