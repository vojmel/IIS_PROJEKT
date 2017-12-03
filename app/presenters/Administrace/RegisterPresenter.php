<?php
/**
 * Created by PhpStorm.
 * User: Meluzin
 * Date: 03.12.2017
 * Time: 17:35
 */

namespace App\Presenters;


use App\Model\UzivatelManager;
use Nette\Application\UI\Form;

class RegisterPresenter extends DefaultAdminPresenter
{
    /** @var Users */
    private $users;

    public function __construct(UzivatelManager $uzivatelManager) {

        $this->users = $uzivatelManager;
    }


    public function renderRegister(){
    }


    protected function createComponentRegisterForm() {
        $form = new Form;
        $form->addText('username', 'Login');

        $form->addPassword('password', 'Heslo: *', 20)
            ->setOption('description', 'Alespoň 6 znaků')
            ->addRule(Form::FILLED, 'Vyplňte Vaše heslo')
            ->addRule(Form::MIN_LENGTH, 'Heslo musí mít alespoň %d znaků.', 6);

        $form->addPassword('password2', 'Heslo znovu: *', 20)
            ->addConditionOn($form['password'], Form::VALID)
            ->addRule(Form::FILLED, 'Heslo znovu')
            ->addRule(Form::EQUAL, 'Hesla se neshodují.', $form['password']);

        $form->addSubmit('send', 'Registrovat');
        $form->onSuccess[] = callback($this, 'registerFormSubmitted');
        return $form;

    }
    public function registerFormSubmitted(Form $form) {

        $values = $form->getValues();
        $new_user_id = $this->users->register($values);
        if($new_user_id){
            $this->flashMessage('Registrace se provedla uspesne.');
            $this->redirect('Sign:in');
        }
    }

}