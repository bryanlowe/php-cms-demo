<?php

/* invoices/invoices_select.html */
class __TwigTemplate_7d4776b96eed1f58ccdedd6a6002865823aa07b265a153f643241655cb8c63d3 extends Twig_Template
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
        echo "<label for=\"invoices_select\">Select a invoice to edit</label><br>
<select class=\"form-control\" name=\"invoices_select\" id=\"invoices_select\">
\t<option value=\"\">Please select an invoice</option>
\t";
        // line 4
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["SELECT_INVOICES"]) ? $context["SELECT_INVOICES"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
            // line 5
            echo "\t    <option value=\"";
            echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "_id");
            echo "\">Company: ";
            echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "clients"), "company");
            echo " -- Invoice Number: ";
            echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "invoice_number");
            echo "</option>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['invoice'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "</select>";
    }

    public function getTemplateName()
    {
        return "invoices/invoices_select.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 7,  28 => 5,  24 => 4,  19 => 1,);
    }
}
