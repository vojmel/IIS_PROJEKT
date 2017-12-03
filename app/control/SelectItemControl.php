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

    public function __construct($name, $caption = NULL, $from = NULL, $selectOne = false)
    {
        parent::__construct($caption);

        $this->odKudSelectovat = $from;
        $this->selectOne = $selectOne;
        $this->popis = $caption;
        $this->nazevInputu = $name;
    }

    function getControl()
    {

        $ret = "";
        $genId = $this->odKudSelectovat.$this->nazevInputu.rand(5, 4000);

        $ret .= "".$this->popis;

        // pro vypsani vyselectovanych
        $ret .= "<div id=\"".$genId."_datagrid\"></div>";
        $ret .= "<input id=\"".$genId."_value\" type=\"hidden\" name=\"".$this->nazevInputu."\" value=\"\">";

        // pro select
        if ($this->selectOne) {
            $ret .= "<button type=\"button\" class=\"btn btn-default\" onclick=\"openWindowForSelectOne('".$this->odKudSelectovat."');setIdFroDataFromSelectDatagrid('".$genId."_datagrid');setIdFroDataFromSelect('".$genId."_value');\">Vybrat</button>";
        }
        else {
            $ret .= "<button type=\"button\" class=\"btn btn-default\" onclick=\"openWindowForSelect('".$this->odKudSelectovat."');setIdFroDataFromSelectDatagrid('".$genId."_datagrid');setIdFroDataFromSelect('".$genId."_value');\">Select vice</button>";
        }

        return $ret;
    }
}