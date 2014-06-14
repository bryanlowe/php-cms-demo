<?php

/* client-resources/clients_select.html */
class __TwigTemplate_db3b46b9a4194ed5af1a8dcedd7fbddc55b0b4d90230bd819d9c13d0d6015c92 extends Twig_Template
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
        echo "<label for=\"clients_select\">Selecting a client will automatically update the list</label><br>
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
        return "client-resources/clients_select.html";
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
