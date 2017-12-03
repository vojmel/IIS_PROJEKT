<?php

namespace App\Presenters;

use App\Model\LekManager;
use Nette;
use Mesour\DataGrid\NetteDbDataSource,
    Mesour\DataGrid\Grid,
    Mesour\DataGrid\Components\Link;
use Mesour\DataGrid\Components\Button;
use Nette\Application\UI\Form;

class SignPresenter  extends DefaultPresenter
{
    /** @var Nette\Database\Context */
    private $database;
    private $user;

    public function __construct(Nette\Database\Context $database, \App\Model\UzivatelManager $user)
    {
        $this->database = $database;
        $this->user = $user;
    }

    public function renderDefault()
    {
    }

    /**
     * Sign-in form factory.
     * @return Nette\Application\UI\Form
     */
    protected function createComponentSignInForm()
    {
        $form = new Form;
        $form->addText('username', 'Username:')
            ->setRequired('Please enter your username.');

        $form->addPassword('password', 'Password:')
            ->setRequired('Please enter your password.');

        $form->addCheckbox('remember', 'Keep me signed in');

        $form->addSubmit('send', 'Sign in');

        // call method signInFormSubmitted() on success
        $form->onSuccess[] = $this->signInFormSubmitted;
        return $form;
    }

    public function signInFormSubmitted($form)
    {
        $values = $form->getValues();

        if ($values->remember) {
            $this->getUser()->setExpiration('+ 2 hours', FALSE);
        } else {
            $this->getUser()->setExpiration('+ 20 minutes', TRUE);
        }
        try {
            $this->getUser()->login($values->username, $values->password);
        } catch (Nette\Security\AuthenticationException $e) {
            $form->addError($e->getMessage());
            return;
        }

        $this->flashMessage('Vítejte!', 'success');
        $this->redirect('Homepage:');
    }

    public function actionIn(){

    }

    public function actionOut()
    {
        $this->getUser()->logout();
        $this->flashMessage('You have been signed out.');
        $this->redirect('in');
    }
}
