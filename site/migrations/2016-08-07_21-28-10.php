<?php

class Migration_2016_08_07_21_28_10 extends FieldMigration {

	public static $description = "Create description";

	protected function getFieldName(){ return 'project_description'; }

	protected function getFieldType(){ return 'FieldtypeTextarea'; }

	protected function fieldSetup(Field $f){
		$f->label = 'Description';
		$f->description = 'Will be the first element in the project detail page';
		$f->required = true;
		$f->requiredAttr = true;
		
		// Fieldtype Settings
		$f->inputfieldClass = 'InputfieldCKEditor';
		$f->contentType = FieldtypeTextarea::contentTypeHTML;

		// Inputfield Settings
		$f->rows = 10;

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