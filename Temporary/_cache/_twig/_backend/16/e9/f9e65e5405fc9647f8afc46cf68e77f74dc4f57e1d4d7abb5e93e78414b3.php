<?php

/* edit-invoice/invoices_select.html */
class __TwigTemplate_16e9f9e65e5405fc9647f8afc46cf68e77f74dc4f57e1d4d7abb5e93e78414b3 extends Twig_Template
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
        echo "<label for=\"invoices_select\">Select an invoice to edit</label><br>
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
            echo "\">";
            echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "writers"), "writer_name");
            echo " -- ";
            echo twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "date");
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
        return "edit-invoice/invoices_select.html";
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
