<?php

class Migration_2016_08_07_21_46_23 extends TemplateMigration {

	public static $description = "Create project template";

	protected function getTemplateName(){ return 'project'; }

	protected function templateSetup(Template $t){
		$t->label = 'Project';
		$t->fieldgroup->add('summary');
		$t->fieldgroup->add('title_stylized');
		$t->fieldgroup->add('project_description');
		$t->fieldgroup->add('project_process');
		$t->fieldgroup->add('project_roles');
		$t->fieldgroup->add('project_url');
		$t->fieldgroup->add('related_projects');
		$t->fieldgroup->save();
	}

}