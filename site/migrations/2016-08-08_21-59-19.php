<?php

class Migration_2016_08_08_21_59_19 extends FieldMigration {

	public static $description = "Create image field";

	protected function getFieldName(){ return 'project_images'; }

	protected function getFieldType(){ return 'FieldtypeImage'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Projectimages';
		$f->description = 'Only first image of each tag will be used';
		$f->notes = 'Tags: screenshot_desktop, screenshot_mobile, preview_macbook';

		$f->useTags = true;
		$f->unzip = true;

		$this->insertIntoTemplate('project', $f, 'project_description');
	}

}