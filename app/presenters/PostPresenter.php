<?php
namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;


class PostPresenter extends Nette\Application\UI\Presenter
{
    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function renderShow($lekId)
    {
        $lek = $this->database->table('lek')->get($lekId);
        if (!$lek) {
            $this->error('Stránka nebyla nalezena');
        }

        $this->template->lek = $lek;
    }

    protected function createComponentCommentForm()
    {
        $form = new Form; // means Nette\Application\UI\Form

        $form->addText('nazev', 'Jméno:')
            ->setRequired();


        $form->addText('cena', 'Cena:')
            ->setRequired();

        $form->addText('carovyKod', 'carovy kod:')
            ->setRequired();


        $form->addText('datumExpirace', 'Datum expirace:')
            ->setRequired();



        $form->addSubmit('send', 'Pridat lek');


        $test = array($this, 'commentFormSucceeded');

        $form->onSuccess[] = $test;

        return $form;
    }

    public function commentFormSucceeded($form, $values)
    {
        $lekId = $this->getParameter('$lekId')+10;

        $this->database->table('lek')->insert(array(
            'nazev' => $values->nazev,
            'cena' => $values->cena,
            'carovyKod' => $values->carovyKod,
            'napredpis' => 0,
        ));

        // update
        /*$post = $this->database->table('posts')->get($postId);
        $post->update($values);
         *
         * */

        $this->flashMessage('Děkuji za komentář', 'success');
        $this->redirect('this');
    }
}