<?php

/* projects/writers_select.html */
class __TwigTemplate_59c29af32deae69ca2f9fa130120ee0e08d14d6eef134539e25bf3ff086e422c extends Twig_Template
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
        echo "<label for=\"writers_select\">Select a writer to assign</label><br>
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
        return "projects/writers_select.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 7,  24 => 4,  40 => 9,  34 => 6,  30 => 5,  26 => 3,  21 => 2,  19 => 1,  200 => 149,  198 => 148,  105 => 57,  99 => 53,  97 => 52,  88 => 45,  86 => 44,  80 => 40,  78 => 39,  73 => 36,  69 => 34,  65 => 32,  63 => 31,  52 => 22,  50 => 13,  31 => 4,  28 => 5,);
    }
}
