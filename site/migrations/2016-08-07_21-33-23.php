<?php

class Migration_2016_08_07_21_33_23 extends FieldMigration {

	public static $description = "Create roles";

	protected function getFieldName(){ return 'project_roles'; }

	protected function getFieldType(){ return 'FieldtypeText'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Roles';
		$f->description = 'Comma-separated list of roles covered in that project';
		$f->required = true;
		$f->requiredAttr = true;

		$f->stripTags = true;
	}

}