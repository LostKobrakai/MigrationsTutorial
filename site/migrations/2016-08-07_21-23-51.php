<?php

class Migration_2016_08_07_21_23_51 extends FieldMigration {

	public static $description = "Create summary";

	protected function getFieldName(){ return 'summary'; }

	protected function getFieldType(){ return 'FieldtypeTextarea'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Summary';
		$f->description = 'Will be shown on the homepage; Single paragraph';
		$f->required = true;
		$f->requiredAttr = true;
		
		// Fieldtype Settings
		$f->inputfieldClass = 'InputfieldTextarea';
		$f->contentType = FieldtypeTextarea::contentTypeUnknown;

		// Inputfield Settings
		$f->rows = 5;
		$f->stripTags = true;
	}

}