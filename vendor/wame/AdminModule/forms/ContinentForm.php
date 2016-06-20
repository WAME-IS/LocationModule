<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms;

use Nette\Application\UI\Form;
use Nette\Utils\Strings;
use Nette\Security\User;
use Kdyby\Doctrine\EntityManager;
use Wame\Core\Forms\FormFactory;
use Wame\LocationModule\Entities\ContinentEntity;
use Wame\LocationModule\Repositories\ContinentRepository;
use Wame\UserModule\Repositories\UserRepository;


class ContinentForm extends FormFactory
{	
	/** @var EntityManager */
	private $entityManager;
	
	/** @var User */
	private $user;
	
	/** @var UserRepository */
	private $userRepository;
	
	/** @var ContinentRepository */
	private $continentRepository;
	
	/** @var ContinentEntity */
	public $continentEntity;
	
	/** @var string */
	public $lang;
	
	
	public function __construct(
		User $user,
		EntityManager $entityManager, 
		ContinentRepository $continentRepository,
		UserRepository $userRepository
	) {
		parent::__construct();

		$this->user = $user;
		$this->entityManager = $entityManager;
		$this->continentRepository = $continentRepository;
		$this->userRepository = $userRepository;
		
		$this->lang = $userRepository->lang;
	}

	
	protected function attached($object) {
		parent::attached($object);
	}
	
	
	public function build()
	{
		$form = $this->createForm();

		$form->addSubmit('submit', _('Save'));

		$this->continentEntity = $this->continentRepository->get(['id' => $this->id]);
		$this->setDefaultValues();
		
		$form->onSuccess[] = [$this, 'formSucceeded'];

		return $form;
	}
	
	public function formSucceeded(Form $form, $values)
	{
		$presenter = $form->getPresenter();

		try {
			$continentEntity = $this->update($values);

			$this->continentRepository->onUpdate($form, $values, $continentEntity);

			$presenter->flashMessage(_('The continent has been successfully updated.'), 'success');
			$presenter->redirect('this');
		} catch (\Exception $e) {
			if ($e instanceof \Nette\Application\AbortException) {
				throw $e;
			}
			
			$form->addError($e->getMessage());
			$this->entityManager->clear();
		}
	}	

	
	/**
	 * Update continent
	 * 
	 * @param array $values
	 * @return ContinentEntity
	 */
	private function update($values)
	{
		$userEntity = $this->userRepository->get(['id' => $this->user->id]);
				
		$continentLangEntity = $this->continentEntity->langs[$this->lang];
		$continentLangEntity->setTitle($values['title']);
		$continentLangEntity->setSlug(Strings::webalize($values['title']));
		$continentLangEntity->setEditDate($this->formatDate('now'));
		$continentLangEntity->setEditUser($userEntity);
		
		return $this->continentRepository->update($this->continentEntity);
	}

}
