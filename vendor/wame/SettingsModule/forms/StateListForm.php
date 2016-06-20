<?php

namespace Wame\LocationModule\Vendor\Wame\SettingsModule\Forms;

use Nette\Application\UI\Form;
use Nette\Security\User;
use Kdyby\Doctrine\EntityManager;
use Wame\Utils\Form\Helpers;
use Wame\Core\Forms\FormFactory;
use Wame\LocationModule\Repositories\StateRepository;
use Wame\UserModule\Repositories\UserRepository;


class StateListForm extends FormFactory
{	
	/** @var EntityManager */
	private $entityManager;
	
	/** @var User */
	private $user;
	
	/** @var UserRepository */
	private $userRepository;
	
	/** @var StateRepository */
	private $stateRepository;
	
	/** @var array */
	private $states = [];
	
	
	public function __construct(
		User $user,
		EntityManager $entityManager, 
		StateRepository $stateRepository,
		UserRepository $userRepository
	) {
		parent::__construct();

		$this->user = $user;
		$this->entityManager = $entityManager;
		$this->stateRepository = $stateRepository;
		$this->userRepository = $userRepository;
	}

	
	protected function attached($object) {
		parent::attached($object);
	}
	
	
	public function build()
	{
		$form = $this->createForm();
		
		$states = $this->stateRepository->find(['status !=' => StateRepository::STATUS_REMOVE]);
		
		foreach ($states as $state) {
			$form->addCheckbox('status_' . $state->id, $state->code);
			
			if ($state->status == '1') {
				$form['status_' . $state->id]->setDefaultValue(true);
			}
			
			$this->states[$state->id] = $state;
		}

		$form->addSubmit('submit', _('Save'));
		
		$form->onSuccess[] = [$this, 'formSucceeded'];

		return $form;
	}
	
	public function formSucceeded(Form $form, $values)
	{
		$presenter = $form->getPresenter();

		try {
			$this->update($form, $values);

			$presenter->flashMessage(_('The states has been successfully updated.'), 'success');
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
	 * Update states
	 * 
	 * @param Form $form
	 * @param array $values
	 */
	private function update($form, $values)
	{
		$editDate = $this->formatDate('now');
		$editUser = $this->userRepository->get(['id' => $this->user->id]);
		
		foreach ($this->states as $stateId => $state) {
			if (Helpers::getCheckboxData($form, 'status_' . $stateId) == 1) {
				$status = 1;
			} else {
				$status = 2;
			}
			
			if ($status != $state->getStatus()) {
				$stateEntity = $this->states[$stateId];
				$stateEntity->setStatus($status);
				$stateEntity->setEditDate($editDate);
				$stateEntity->setEditUser($editUser);
		
				$this->stateRepository->update($stateEntity);
			}
		}
	}

}
