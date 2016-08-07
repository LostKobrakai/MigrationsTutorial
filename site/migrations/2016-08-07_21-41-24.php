<?php

class Migration_2016_08_07_21_41_24 extends FieldMigration {

	public static $description = "Create related_projects";

	protected function getFieldName(){ return 'related_projects'; }

	protected function getFieldType(){ return 'FieldtypePage'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Related projects';
		$f->description = 'Up to 3 used; If less are supplied the other ones are randomly choosen';
		
		$f->derefAsPage = FieldtypePage::derefAsPageArray;
		$f->inputfield = 'InputfieldAsmSelect';
		$f->findPagesCode = <<<'PHP'
return $pages->find("template=$page->template");
PHP;
	}

}