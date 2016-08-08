<?php

class Migration_2016_08_08_22_51_05 extends FieldMigration {

	public static $description = "Create social field";

	protected function getFieldName(){ return 'social'; }

	protected function getFieldType(){ return 'FieldtypeTextarea'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Social';
		$f->notes = 'Each line is a social option: url|icon|label';
		$f->contentType = FieldtypeTextarea::contentTypeUnknown;

		// Inputfield Settings
		$f->rows = 5;
		$f->stripTags = true;

		$this->insertIntoTemplate('bio', $f);
	}

}