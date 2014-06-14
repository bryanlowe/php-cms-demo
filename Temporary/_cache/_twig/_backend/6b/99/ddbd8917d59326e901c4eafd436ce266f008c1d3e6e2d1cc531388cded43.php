<?php

/* invoices/invoice_status.html */
class __TwigTemplate_6b99ddbd8917d59326e901c4eafd436ce266f008c1d3e6e2d1cc531388cded43 extends Twig_Template
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
        if ((isset($context["INVOICE_STATUS"]) ? $context["INVOICE_STATUS"] : null)) {
            // line 2
            echo "\t";
            if (((isset($context["INVOICE_STATUS"]) ? $context["INVOICE_STATUS"] : null) == "PAID")) {
                // line 3
                echo "\t\t<div class=\"btn_container\">
\t\t\t<input type=\"button\" class=\"btn btn-success btn-glow-success\" value=\"PAID\" name=\"paidBtn\" id=\"paidBtn\" />
\t\t</div>
\t\t<div class=\"btn_container\">
\t\t\t<input type=\"button\" class=\"btn btn-danger\" value=\"OPEN\" name=\"unpaidBtn\" id=\"unpaidBtn\" disabled />
\t\t</div>
\t";
            } else {
                // line 10
                echo "\t\t<div class=\"btn_container\">
\t\t\t<input type=\"button\" class=\"btn btn-success\" value=\"PAID\" name=\"paidBtn\" id=\"paidBtn\" disabled />
\t\t</div>
\t\t<div class=\"btn_container\">
\t\t\t<input type=\"button\" class=\"btn btn-danger btn-glow-danger\" value=\"OPEN\" name=\"unpaidBtn\" id=\"unpaidBtn\" />
\t\t</div>
\t";
            }
        } else {
            // line 18
            echo "\t<div class=\"btn_container\">
\t\t<input type=\"button\" class=\"btn btn-success\" value=\"PAID\" name=\"paidBtn\" id=\"paidBtn\" disabled />
\t</div>
\t<div class=\"btn_container\">
\t\t<input type=\"button\" class=\"btn btn-danger\" value=\"OPEN\" name=\"unpaidBtn\" id=\"unpaidBtn\" disabled />
\t</div>
";
        }
    }

    public function getTemplateName()
    {
        return "invoices/invoice_status.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 18,  33 => 10,  21 => 2,  41 => 7,  24 => 3,  19 => 1,  78 => 34,  74 => 32,  72 => 31,  63 => 24,  61 => 23,  56 => 20,  54 => 19,  50 => 17,  48 => 16,  44 => 14,  42 => 13,  31 => 4,  28 => 5,);
    }
}
