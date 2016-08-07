<?php 

/**
 * ProcessWire Templates
 *
 * Manages and provides access to all the Template instances
 * 
 * ProcessWire 2.8.x (development), Copyright 2016 by Ryan Cramer
 * https://processwire.com
 * 
 * #pw-summary Manages and provides access to all the Templates.
 *
 * @method TemplatesArray find($selector) Return the templates matching the the given selector query. #pw-internal
 * @method bool save(Template $template) Save the given Template.
 * @method bool delete() delete(Template $template) Delete the given Template. Note that this will throw a fatal error if the template is in use by any pages.
 *
 */
class Templates extends WireSaveableItems {

	/**
	 * Reference to all the Fieldgroups
	 *
	 */
	protected $fieldgroups = null; 

	/**
	 * WireArray of all Template instances
	 *
	 */
	protected $templatesArray; 

	/**
	 * Path where Template files are stored
	 *
	 */
	protected $path; 

	/**
	 * Construct the Templates
	 *
	 * @param Fieldgroups $fieldgroups Reference to the Fieldgroups
	 * @param string $path Path to where template files are stored
	 *
	 */
	public function __construct(Fieldgroups $fieldgroups, $path) {
		$fieldgroups->wire($this);
		$this->fieldgroups = $fieldgroups; 
		$this->templatesArray = $this->wire(new TemplatesArray());
		$this->path = $path;
	}

	/**
	 * Initialize the TemplatesArray and populate
	 * 
	 * #pw-internal
	 *
	 */
	public function init() {
		$this->wire($this->templatesArray);
		$this->load($this->templatesArray); 
	}

	/**
	 * Return the WireArray that this DAO stores it's items in
	 * 
	 * #pw-internal
	 *
	 */
	public function getAll() {
		return $this->templatesArray;
	}

	/**
	 * Return a new blank item 
	 * 
	 * #pw-internal
	 *
	 */
	public function makeBlankItem() {
		return $this->wire(new Template()); 
	}

	/**
	 * Return the name of the table that this DAO stores item records in
	 * 
	 * #pw-internal
	 *
	 */
	public function getTable() {
		return 'templates';
	}

	/**
	 * Return the field name that fields should initially be sorted by
	 * 
	 * #pw-internal
	 *
	 */
	public function getSort() {
		return $this->getTable() . ".name";
	}

	/**
	 * Get a template by name or ID
	 * 
	 * Given a template ID or name, return the matching template or NULL if not found.
	 * 
	 * @param string|int $key Template name or ID
	 * @return Template|null
	 *
	 */
	public function get($key) {
		if($key == 'path') return $this->path;
		$value = $this->templatesArray->get($key); 
		if(is_null($value)) $value = parent::get($key);
		return $value; 
	}

	/**
	 * Save a Template
	 * 
	 * ~~~~~
	 * $templates->save($template); 
	 * ~~~~~
	 *
	 * @param Saveable|Template $item Template to save
	 * @return bool True on success, false on failure
	 * @throws WireException
	 *
	 */
	public function ___save(Saveable $item) {
		
		// If the template's fieldgroup has changed, then we delete data that's no longer applicable to the new fieldgroup. 

		$isNew = $item->id < 1; 

		if(!$item->fieldgroup) throw new WireException("Template '$item' cannot be saved because it has no fieldgroup assigned"); 
		if(!$item->fieldgroup->id) throw new WireException("You must save Fieldgroup '{$item->fieldgroup->name}' before adding to Template '{$item}'"); 

		$rolesChanged = $item->isChanged('useRoles');

		if($this->wire('pages')->get("/")->template->id == $item->id) {
			if(!$item->useRoles) throw new WireException("Template '{$item}' is used by the homepage and thus must manage access"); 
			if(!$item->hasRole("guest")) throw new WireException("Template '{$item}' is used by the homepage and thus must have the 'guest' role assigned."); 
		}
		
		if(!$item->isChanged('modified')) $item->modified = time();

		$result = parent::___save($item); 

		if($result && !$isNew && $item->fieldgroupPrevious && $item->fieldgroupPrevious->id != $item->fieldgroup->id) {
			// the fieldgroup has been changed
			// remove data from all fields that are not part of the new fieldgroup
			$removeFields = $this->wire(new FieldsArray());
			foreach($item->fieldgroupPrevious as $field) {
				if(!$item->fieldgroup->has($field)) {
					$removeFields->add($field); 
				}
			}
			if(count($removeFields)) { 
				foreach($removeFields as $field) {
					$field->type->deleteTemplateField($item, $field); 
				}
				/*
				$pages = $this->fuel('pages')->find("templates_id={$item->id}, check_access=0, status<" . Page::statusMax); 
				foreach($pages as $page) {
					foreach($removeFields as $field) {
						$field->type->deletePageField($page, $field); 
						if($this->fuel('config')->debug) $this->message("Removed field '$field' on page '{$page->url}'"); 
					}
				}
				*/
			}
		}

		if($rolesChanged) { 
			$access = $this->wire(new PagesAccess());
			$access->updateTemplate($item); 
		}
		
		$this->wire('cache')->maintenance($item);

		return $result; 
	}

	/**
	 * Delete a Template
	 * 
	 * @param Template|Saveable $item Template to delete
	 * @return bool True on success, false on failure
	 * @throws WireException Thrown when you attempt to delete a template in use, or a system template. 
	 *
	 */
	public function ___delete(Saveable $item) {
		if($item->flags & Template::flagSystem) throw new WireException("Can't delete template '{$item->name}' because it is a system template."); 
		$cnt = $item->getNumPages();
		if($cnt > 0) throw new WireException("Can't delete template '{$item->name}' because it is used by $cnt pages.");  

		$return = parent::___delete($item);
		$this->wire('cache')->maintenance($item); 
		return $return;
	}

	/**
	 * Clone the given Template
	 *
	 * Note that this also clones the Fieldgroup if the template being cloned has its own named fieldgroup.
	 * 
	 * @todo: clone the fieldgroup context settings too. 
	 *
	 * @param Template|Saveable $item Template to clone
	 * @param string $name Name of new template that will be created, or omit to auto-assign. 
	 * @return bool|Saveable|Template $item Returns the new Template on success, or false on failure
	 *
	 */
	public function ___clone(Saveable $item, $name = '') {

		$original = $item;
		$item = clone $item; 

		if($item->flags & Template::flagSystem) {
			// we want to avoid creating clones that have system flags
			$item->flags = $item->flags | Template::flagSystemOverride; 
			$item->flags = $item->flags & ~Template::flagSystem;
			$item->flags = $item->flags & ~Template::flagSystemOverride;
		}

		$item->id = 0; // note this must be after removing system flags

		$fieldgroup = $item->fieldgroup; 

		if($fieldgroup->name == $item->name) {
			// if the fieldgroup and the item have the same name, we'll also clone the fieldgroup
			$fieldgroup = $this->wire('fieldgroups')->clone($fieldgroup, $name); 	
			$item->fieldgroup = $fieldgroup;
		}

		$item = parent::___clone($item, $name);

		if($item && $item->id && !$item->altFilename) { 
			// now that we have a clone, lets also clone the template file, if it exists
			$path = $this->wire('config')->paths->templates; 
			$file = $path . $item->name . '.' . $this->wire('config')->templateExtension; 
			if($original->filenameExists() && is_writable($path) && !file_exists($file)) { 
				if(copy($original->filename, $file)) $item->filename = $file;
			}
		}

		return $item;
	}


	/**
	 * Return the number of pages using the provided Template
	 * 
	 * @param Template $tpl Template you want to get count for 
	 * @return int Total number of pages in use by given Template
	 *
	 */
	public function getNumPages(Template $tpl) {
		$database = $this->wire('database');
		$query = $database->prepare("SELECT COUNT(*) AS total FROM pages WHERE templates_id=:template_id"); // QA
		$query->bindValue(":template_id", $tpl->id, \PDO::PARAM_INT);
		$query->execute();
		return (int) $query->fetchColumn();	
	}

	/**
	 * Overridden from WireSaveableItems to retain specific keys
	 *
	 */
	protected function encodeData(array $value) {
		return wireEncodeJSON($value, array('slashUrls', 'compile')); 	
	}

	/**
	 * Export Template data for external use
	 * 
	 * #pw-advanced
	 * 
	 * @param Template $template Template you want to export
	 * @return array Associative array of export data
	 *
	 */
	public function ___getExportData(Template $template) {

		$template->set('_exportMode', true); 
		$data = $template->getTableData();

		// flatten
		foreach($data['data'] as $key => $value) {
			$data[$key] = $value;
		}

		// remove unnecessary
		unset($data['data'], $data['modified']);

		// convert fieldgroup to guid
		$fieldgroup = $this->wire('fieldgroups')->get((int) $data['fieldgroups_id']);
		if($fieldgroup) $data['fieldgroups_id'] = $fieldgroup->name;

		// convert family settings to guids
		foreach(array('parentTemplates', 'childTemplates') as $key) {
			if(!isset($data[$key])) continue;
			$values = array();
			foreach($data[$key] as $id) {
				if(ctype_digit("$id")) $id = (int) $id;
				$t = $this->wire('templates')->get($id);
				if($t) $values[] = $t->name;
			}
			$data[$key] = $values;
		}

		// convert roles to guids
		if($template->useRoles) {
			foreach(array('roles', 'editRoles', 'addRoles', 'createRoles') as $key) {
				if(!isset($data[$key])) continue;
				$values = array();
				foreach($data[$key] as $id) {
					$role = $id instanceof Role ? $id : $this->wire('roles')->get((int) $id);
					$values[] = $role->name;
				}
				$data[$key] = $values;
			}
		}

		// convert pages to guids
		if(((int) $template->cache_time) != 0) {
			if(!empty($data['cacheExpirePages'])) {
				$values = array();
				foreach($data['cacheExpirePages'] as $id) {
					$page = $this->wire('pages')->get((int) $id);
					if(!$page->id) continue;
					$values[] = $page->path;
				}
			}
		}

		$fieldgroupData = array('fields' => array(), 'contexts' => array());
		if($template->fieldgroup) $fieldgroupData = $template->fieldgroup->getExportData();
		$data['fieldgroupFields'] = $fieldgroupData['fields'];
		$data['fieldgroupContexts'] = $fieldgroupData['contexts'];

		$template->set('_exportMode', false); 
		return $data;
	}

	/**
	 * Given an array of Template export data, import it to the given Template
	 * 
	 * ~~~~~~
	 * // Example of return value
	 * $returnValue = array(
	 *   'property_name' => array(
	 *     'old' => 'old value', // old value (in string comparison format)
	 *     'new' => 'new value', // new value (in string comparison format)
	 *     'error' => 'error message or blank if no error' // error message (string) or messages (array)
	 *   ), 
	 *   'another_property_name' => array(
	 *     // ...
	 *   ) 
	 * );
	 * ~~~~~~
	 *
	 * #pw-advanced
	 * 
	 * @param Template $template Template you want to import to
	 * @param array $data Import data array (must have been exported from getExportData() method).
	 * @return bool True if successful, false if not
	 * @return array Returns array with list of changes (see example in method description)
	 *
	 */
	public function ___setImportData(Template $template, array $data) {

		$template->set('_importMode', true); 
		$fieldgroupData = array();
		$changes = array();
		$_data = $this->getExportData($template);

		if(isset($data['fieldgroupFields'])) $fieldgroupData['fields'] = $data['fieldgroupFields'];
		if(isset($data['fieldgroupContexts'])) $fieldgroupData['contexts'] = $data['fieldgroupContexts'];
		unset($data['fieldgroupFields'], $data['fieldgroupContexts'], $data['id']);

		foreach($data as $key => $value) {
			if($key == 'fieldgroups_id' && !ctype_digit("$value")) {
				$fieldgroup = $this->wire('fieldgroups')->get($value);
				if(!$fieldgroup) {
					$fieldgroup = $this->wire(new Fieldgroup());
					$fieldgroup->name = $value;
				}
				$oldValue = $template->fieldgroup ? $template->fieldgroup->name : '';
				$newValue = $fieldgroup->name;
				$error = '';
				try {
					$template->setFieldgroup($fieldgroup);
				} catch(\Exception $e) {
					$this->trackException($e, false);
					$error = $e->getMessage();
				}
				if($oldValue != $fieldgroup->name) {
					if(!$fieldgroup->id) $newValue = "+$newValue";
					$changes['fieldgroups_id'] = array(
						'old' => $template->fieldgroup->name,
						'new' => $newValue,
						'error' => $error
					);
				}
			}

			$template->errors("clear");
			$oldValue = isset($_data[$key]) ? $_data[$key] : '';
			$newValue = $value;
			if(is_array($oldValue)) $oldValue = wireEncodeJSON($oldValue, true, false);
			else if(is_object($oldValue)) $oldValue = (string) $oldValue;
			if(is_array($newValue)) $newValue = wireEncodeJSON($newValue, true, false);
			else if(is_object($newValue)) $newValue = (string) $newValue;

			// everything else
			if($oldValue == $newValue || (empty($oldValue) && empty($newValue))) {
				// no change needed
			} else {
				// changed
				try {
					$template->set($key, $value);
					if($key == 'roles') $template->getRoles(); // forces reload of roles (and resulting error messages)
					$error = $template->errors("clear");
				} catch(\Exception $e) {
					$this->trackException($e, false);
					$error = array($e->getMessage());
				}
				$changes[$key] = array(
					'old' => $oldValue,
					'new' => $newValue,
					'error' => (count($error) ? $error : array())
				);
			}
		}

		if(count($fieldgroupData)) {
			$_changes = $template->fieldgroup->setImportData($fieldgroupData);
			if($_changes['fields']['new'] != $_changes['fields']['old']) {
				$changes['fieldgroupFields'] = $_changes['fields'];
			}
			if($_changes['contexts']['new'] != $_changes['contexts']['old']) {
				$changes['fieldgroupContexts'] = $_changes['contexts'];
			}
		}

		$template->errors('clear');
		$template->set('_importMode', false); 

		return $changes;
	}

	/**
	 * Return the parent page that this template assumes new pages are added to
	 *
	 * - This is based on family settings, when applicable.
	 * - It also takes into account user access, if requested (see arg 1).
	 * - If there is no shortcut parent, NULL is returned.
	 * - If there are multiple possible shortcut parents, a NullPage is returned.
	 * 
	 * @param Template $template
	 * @param bool $checkAccess Whether or not to check for user access to do this (default=false).
	 * @param bool $getAll Specify true to return all possible parents (makes method always return a PageArray)
	 * @return Page|NullPage|null|PageArray
	 *
	 */
	public function getParentPage(Template $template, $checkAccess = false, $getAll = false) {
		
		$foundParent = null;
		$foundParents = $getAll ? $this->wire('pages')->newPageArray() : null;

		if($template->noShortcut || !count($template->parentTemplates)) return $foundParents;
		if($template->noParents == -1) {
			// only 1 page of this type allowed 
			if($this->getNumPages($template) > 0) return $foundParents;
		} else if($template->noParents == 1) {
			return $foundParents; 
		}

		foreach($template->parentTemplates as $parentTemplateID) {

			$parentTemplate = $this->wire('templates')->get((int) $parentTemplateID);
			if(!$parentTemplate) continue;

			// if the parent template doesn't have this as an allowed child template, exclude it 
			if($parentTemplate->noChildren) continue;
			if(!in_array($template->id, $parentTemplate->childTemplates)) continue;

			// sort=status ensures that a non-hidden page is given preference to a hidden page
			$include = $checkAccess ? "unpublished" : "all";
			$selector = "templates_id=$parentTemplate->id, include=$include, sort=status";
			if(!$getAll) $selector .= ", limit=2";
			$parentPages = $this->wire('pages')->find($selector);
			$numParentPages = count($parentPages);

			// undetermined parent
			if(!$numParentPages) continue;

			if($getAll) {
				if($numParentPages) $foundParents->add($parentPages);
				continue;
			} else if($numParentPages > 1) {
				// multiple possible parents
				$parentPage = $this->wire('pages')->newNullPage();
			} else {
				// one possible parent
				$parentPage = $parentPages->first();
			}

			if($checkAccess) {
				if($parentPage->id) {
					// single defined parent
					$p = $this->wire('pages')->newPage(array('template' => $template));
					if(!$parentPage->addable($p)) continue;
				} else {
					// multiple possible parents
					if(!$this->wire('user')->hasPermission('page-create', $template)) continue;
				}
			}

			$foundParent = $parentPage;
			break;
		}
		
		if($checkAccess && $foundParents && $foundParents->count()) {
			$p = $this->wire('pages')->newPage(array('template' => $template));
			foreach($foundParents as $parentPage) {
				if(!$parentPage->addable($p)) $foundParents->remove($parentPage);
			}
		}
		
		if($getAll) return $foundParents;
		return $foundParent;
	}

	/**
	 * Return all possible parent pages for the given template, if predefined
	 * 
	 * @param Template $template
	 * @param bool $checkAccess Specify true to exclude parent pages that user doesn't have access to add pages to (default=false)
	 * @return PageArray
	 * 
	 */
	public function getParentPages(Template $template, $checkAccess = false) {
		return $this->getParentPage($template, $checkAccess, true);
	}


}

