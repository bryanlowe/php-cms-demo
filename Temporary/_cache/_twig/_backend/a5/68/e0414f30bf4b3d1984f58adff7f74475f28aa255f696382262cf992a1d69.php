<?php

/* opt-in/opt_select.html */
class __TwigTemplate_a568e0414f30bf4b3d1984f58adff7f74475f28aa255f696382262cf992a1d69 extends Twig_Template
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
        echo "<label for=\"opt_select\">Select a opt-in to edit</label><br>
<select class=\"form-control\" name=\"opt_select\" id=\"opt_select\">
\t<option value=\"\">Please select an opt-in</option>
\t";
        // line 4
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["SELECT_OPT"]) ? $context["SELECT_OPT"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["opt"]) {
            // line 5
            echo "\t    <option value=\"";
            echo twig_template_get_attributes($this, (isset($context["opt"]) ? $context["opt"] : null), "_id");
            echo "\">";
            echo twig_template_get_attributes($this, (isset($context["opt"]) ? $context["opt"] : null), "title");
            echo "</option>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['opt'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "</select>";
    }

    public function getTemplateName()
    {
        return "opt-in/opt_select.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 7,  28 => 5,  24 => 4,  19 => 1,);
    }
}
