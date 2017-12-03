<?php
/**
 * Created by PhpStorm.
 * User: Meluzin
 * Date: 03.12.2017
 * Time: 1:05
 */

class SelectItemControl extends Nette\Forms\Controls\BaseControl
{

    protected $odKudSelectovat;
    protected $selectOne;
    protected $popis;
    protected $nazevInputu;
    protected $buttonLabel;

    public function __construct($name, $caption = NULL, $from = NULL, $selectOne = false)
    {
        parent::__construct($caption);

        $this->odKudSelectovat = $from;
        $this->selectOne = $selectOne;
        $this->popis = $caption;
        $this->nazevInputu = $name;

        $this->buttonLabel = "Vybrat";

        return $this;
    }

    function getControl()
    {
        // Predelani na hidden input a nagenerovani
        $this->control->type = 'hidden';

        $el = parent::getControl();
        $el->addAttributes(array(
            'value' => $this->value,
        ));

        $ret = $el."";

        // Vytvoreni vlastni komponenty
        $genId = $this->odKudSelectovat.$this->nazevInputu.rand(5, 4000);

        // pro vypsani vyselectovanych
        $ret .= "<div id=\"".$genId."_datagrid\"></div>";

        // pro select
        if ($this->selectOne) {
            $ret .= "<button type=\"button\" class=\"btn btn-default\" onclick=\"openWindowForSelectOne('".$this->odKudSelectovat."');setIdFroDataFromSelectDatagrid('".$genId."_datagrid');setIdFroDataFromSelect('".$this->getHtmlId()."');\">".$this->buttonLabel."</button>";
        }
        else {
            $ret .= "<button type=\"button\" class=\"btn btn-default\" onclick=\"openWindowForSelect('".$this->odKudSelectovat."');setIdFroDataFromSelectDatagrid('".$genId."_datagrid');setIdFroDataFromSelect('".$this->getHtmlId()."');\">".$this->buttonLabel."</button>";
        }

        // zobrazeni pokud jiz z db prisly hodnoty
        $showPocet = ($this->selectOne)? 'false':'true';

        $ret .= "<script type='text/javascript'>

        $(document).ready(function(){
getSelectedItemsFor('".$this->getHtmlId()."', '".$this->odKudSelectovat."', ".$showPocet.", '".$genId."_datagrid');
});
</script>";

        /*
        $(document).ready(function(){
            getSelectedItemsFor('".$this->getHtmlId()."', '".$this->odKudSelectovat."', ".$showPocet.", '".$genId."_datagrid');
        });
*/
        return $ret;
    }

    public function setSearchOne($state = true) {
        $this->selectOne = $state;
        return $this;
    }

    public function getValue()
    {
        $ret = parent::getValue();

        // pokud select jednoho, tak vratime jen to id
        if ($this->selectOne) {
            $id = explode(":", $ret);
            if (count($id) > 0) {
                return $id[0];
            }
        }
        return $ret;
    }

    public function setButtonLabel($string = "Vybrat") {
        $this->buttonLabel = $string;

        return $this;
    }

}