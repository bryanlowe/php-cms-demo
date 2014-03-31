<?php

/* invoices/file_upload.html */
class __TwigTemplate_5933d773b92b46010a17e51afb15c485dd3b2aa93070c5db0f91f464664234e0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<p><label>Current Invoice File:</label> <a id=\"invoice_file_link\" href=\"#\">Not Available</a></p>
<div class=\"file_upload_container\">
\t<input type=\"file\" multiple=\"\" name=\"file_upload\" id=\"file_upload\">
</div>
<div class=\"clear\"></div>
<div class=\"button_panel\">
\t<input type=\"button\" class=\"btn btn-danger\" value=\"DELETE INVOICE FILE\" id=\"deleteFileBtn\" name=\"deleteFileBtn\">
</div>
";
    }

    public function getTemplateName()
    {
        return "invoices/file_upload.html";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
