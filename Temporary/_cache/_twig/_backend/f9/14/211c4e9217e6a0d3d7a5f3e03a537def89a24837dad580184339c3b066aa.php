<?php

/* invoices/clients_select.html */
class __TwigTemplate_f914211c4e9217e6a0d3d7a5f3e03a537def89a24837dad580184339c3b066aa extends Twig_Template
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
        echo "<label for=\"clients_select\">Select a client to attach to this invoice</label><br>
<select class=\"form-control\" name=\"clients_select\" id=\"clients_select\">
\t<option value=\"\">Please select a client</option>
\t";
        // line 4
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["SELECT_CLIENTS"]) ? $context["SELECT_CLIENTS"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["client"]) {
            // line 5
            echo "\t    <option value=\"";
            echo twig_template_get_attributes($this, (isset($context["client"]) ? $context["client"] : null), "_id");
            echo "\">";
            echo twig_template_get_attributes($this, (isset($context["client"]) ? $context["client"] : null), "client_name");
            echo " -- ";
            echo twig_template_get_attributes($this, (isset($context["client"]) ? $context["client"] : null), "company");
            echo "</option>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['client'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "</select>";
    }

    public function getTemplateName()
    {
        return "invoices/clients_select.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 18,  33 => 10,  21 => 2,  41 => 7,  24 => 4,  19 => 1,  78 => 34,  74 => 32,  72 => 31,  63 => 24,  61 => 23,  56 => 20,  54 => 19,  50 => 17,  48 => 16,  44 => 14,  42 => 13,  31 => 4,  28 => 5,);
    }
}
