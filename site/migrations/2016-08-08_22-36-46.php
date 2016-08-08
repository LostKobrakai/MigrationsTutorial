<?php

class Migration_2016_08_08_22_36_46 extends TemplateMigration {

	public static $description = "Add bio template";

	protected function getTemplateName(){ return 'bio'; }

	protected function templateSetup(Template $t){
		$t->label = 'Biography';
		$t->fieldgroup->add('title_stylized');
		$t->fieldgroup->add('project_description');
		$t->fieldgroup->add('project_process');
		$t->fieldgroup->save();

		$this->editInTemplateContext($t, 'project_description', function(Field $f){
			$f->label = 'Bio';
			$f->description = '';
		});

		$this->editInTemplateContext($t, 'project_process', function(Field $f){
			$f->label = 'Experience';
			$f->description = '';
		});
	}

}