<?php

/* writers/writers_select.html */
class __TwigTemplate_415e7667cb409e398fd595830d95f93b80d4513d62d6b57550e5af0ab36187bd extends Twig_Template
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
        echo "<label for=\"writers_select\">Select a writer to edit</label><br>
<select class=\"form-control\" name=\"writers_select\" id=\"writers_select\">
\t<option value=\"\">Please select a writer</option>
\t";
        // line 4
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["SELECT_WRITERS"]) ? $context["SELECT_WRITERS"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["writer"]) {
            // line 5
            echo "\t    <option value=\"";
            echo twig_template_get_attributes($this, (isset($context["writer"]) ? $context["writer"] : null), "_id");
            echo "\">";
            echo twig_template_get_attributes($this, (isset($context["writer"]) ? $context["writer"] : null), "writer_name");
            echo "</option>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['writer'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "</select>";
    }

    public function getTemplateName()
    {
        return "writers/writers_select.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 7,  24 => 4,  19 => 1,  48 => 16,  44 => 14,  42 => 13,  31 => 4,  28 => 5,);
    }
}
