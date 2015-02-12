<?php
class ClaseSimple {
    private $to;
    private $cc ;
    private $from ;
    private $asunto ;
    private boolean $btexto;
    private $texto;
    private boolean $bhtml;
    private $htmlbody;
    
    public function __construct($to, $cc, $from, $asunto,$e,$f,$g,$h) {
        $this->to = $to;
        $this->cc = $cc;
        $this->from = $from;
        $this->asunto = $asunto;
        $this->btexto=$e;
        $this->texto=$f;
        $this->bhtml=$g;
        $this->htmlbody=$h;
    }
}
?>