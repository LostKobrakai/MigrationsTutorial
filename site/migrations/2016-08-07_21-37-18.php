<?php

class Migration_2016_08_07_21_37_18 extends FieldMigration {

	public static $description = "Create url";

	protected function getFieldName(){ return 'project_url'; }

	protected function getFieldType(){ return 'FieldtypeURL'; }

	protected function fieldSetup(Field $f){
		$f->label = 'URL to the project';
		$f->textformatters = ['TextformatterEntities'];
		$f->allowIDN = true;
	}

}