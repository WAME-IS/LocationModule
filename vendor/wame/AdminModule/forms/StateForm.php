<?php

namespace Wame\LocationModule\Vendor\Wame\AdminModule\Forms;

use Nette\Application\UI\Form;
use Nette\Utils\Strings;
use Nette\Security\User;
use Kdyby\Doctrine\EntityManager;
use Wame\Core\Forms\FormFactory;
use Wame\LocationModule\Entities\ContinentEntity;
use Wame\LocationModule\Repositories\ContinentRepository;
use Wame\LocationModule\Entities\StateEntity;
use Wame\LocationModule\Entities\StateLangEntity;
use Wame\LocationModule\Repositories\StateRepository;
use Wame\UserModule\Repositories\UserRepository;
use Wame\UserModule\Entities\UserEntity;


class StateForm extends FormFactory
{	
	/** @var EntityManager */
	private $entityManager;
	
	/** @var User */
	private $user;
	
	/** @var UserEntity */
	private $userEntity;
	
	/** @var UserRepository */
	private $userRepository;
	
	/** @var ContinentRepository */
	private $continentRepository;
	
	/** @var ContinentEntity */
	private $continentEntity;
	
	/** @var StateRepository */
	private $stateRepository;
	
	/** @var StateEntity */
	public $stateEntity;
	
	/** @var string */
	public $lang;
	
	
	public function __construct(
		User $user,
		EntityManager $entityManager, 
		ContinentRepository $continentRepository,
		StateRepository $stateRepository,
		UserRepository $userRepository
	) {
		parent::__construct();

		$this->user = $user;
		$this->entityManager = $entityManager;
		$this->continentRepository = $continentRepository;
		$this->stateRepository = $stateRepository;
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

		if ($this->id) {
			$this->stateEntity = $this->stateRepository->get(['id' => $this->id]);
			$this->setDefaultValues();
		}
		
		$form->onSuccess[] = [$this, 'formSucceeded'];

		return $form;
	}
	
	public function formSucceeded(Form $form, $values)
	{
		$presenter = $form->getPresenter();

		$this->userEntity = $this->userRepository->get(['id' => $this->user->id]);
		$this->continentEntity = $this->continentRepository->get(['id' => $values['continent']]);
		
		try {
			if ($this->id) {
				$stateEntity = $this->update($values);

				$this->stateRepository->onUpdate($form, $values, $stateEntity);

				$presenter->flashMessage(_('The state has been successfully updated.'), 'success');
				$presenter->redirect('this');
			} else {
				$stateEntity = $this->create($values);

				$this->stateRepository->onCreate($form, $values, $stateEntity);

				$presenter->flashMessage(_('The state has been successfully created.'), 'success');
				$presenter->redirect(':Admin:Settings:', ['id' => 'State']);
			}
		} catch (\Exception $e) {
			if ($e instanceof \Nette\Application\AbortException) {
				throw $e;
			}
			
			$form->addError($e->getMessage());
			$this->entityManager->clear();
		}
	}	
	
	
	/**
	 * Create state
	 * 
	 * @param array $values
	 * @return StateEntity
	 */
	private function create($values)
	{
		$stateEntity = new StateEntity();
		$stateEntity->setContinent($this->continentEntity);
		$stateEntity->setCode($values['code']);
		$stateEntity->setIso($values['iso']);
		$stateEntity->setIsoNumeric($values['isoNumeric']);
		$stateEntity->setPhonePrefix($values['phonePrefix']);
		$stateEntity->setTld($values['tld']);
		$stateEntity->setToken(md5(time()));
		$stateEntity->setEditDate(\Wame\Utils\Date::toDateTime('now'));
		$stateEntity->setEditUser($this->userEntity);
		$stateEntity->setStatus(StateRepository::STATUS_ENABLED);
		
		$stateLangEntity = new StateLangEntity();
		$stateLangEntity->setLang($this->lang);
		$stateLangEntity->setState($stateEntity);
		$stateLangEntity->setTitle($values['title']);
		$stateLangEntity->setSlug(Strings::webalize($values['title']));
		$stateLangEntity->setCapitalCity($values['capitalCity']);
		
		$stateEntity->addLang($this->lang, $stateLangEntity);
		
		return $this->stateRepository->create($stateEntity);
	}
	
	
	/**
	 * Update state
	 * 
	 * @param array $values
	 * @return StateEntity
	 */
	private function update($values)
	{
		$stateEntity = $this->stateEntity;
		$stateEntity->setContinent($this->continentEntity);
		$stateEntity->setCode($values['code']);
		$stateEntity->setIso($values['iso']);
		$stateEntity->setIsoNumeric($values['isoNumeric']);
		$stateEntity->setPhonePrefix($values['phonePrefix']);
		$stateEntity->setTld($values['tld']);
		$stateEntity->setEditDate(\Wame\Utils\Date::toDateTime('now'));
		$stateEntity->setEditUser($this->userEntity);
				
		$stateLangEntity = $this->stateEntity->langs[$this->lang];
		$stateLangEntity->setTitle($values['title']);
		$stateLangEntity->setSlug(Strings::webalize($values['title']));
		$stateLangEntity->setCapitalCity($values['capitalCity']);
		
		return $this->stateRepository->update($this->stateEntity);
	}

}