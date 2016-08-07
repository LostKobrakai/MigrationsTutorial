<?php

class Migration_2016_08_07_21_10_28 extends FieldMigration {

	public static $description = "Create title_stylized";

	protected function getFieldName(){ return 'title_stylized'; }

	protected function getFieldType(){ return 'FieldtypeTextarea'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Stylized Title';
		$f->description = 'Will be used as header above the project\'s information';
		
		// Fieldtype Settings
		$f->inputfieldClass = 'InputfieldCKEditor';
		$f->contentType = FieldtypeTextarea::contentTypeHTML;

		// Inputfield Settings
		$f->rows = 3;

		// CKEditor settings
		$f->toolbar = <<<SETTINGS
Styles, -, Bold, Italic, -, RemoveFormat
HorizontalRule, SpecialChar, Sourcedialog
SETTINGS;
		$f->inlineMode = 1;
		$f->toggles = [
			InputfieldCKEditor::toggleCleanDIV, 
			InputfieldCKEditor::toggleCleanP, 
			InputfieldCKEditor::toggleCleanNBSP
		];
		$f->extraAllowedContent = <<<SETTINGS
SETTINGS;
		$f->extraPlugins = ['sourcedialog'];
	}

}