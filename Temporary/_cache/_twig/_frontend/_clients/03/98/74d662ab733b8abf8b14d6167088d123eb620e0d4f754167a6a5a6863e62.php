<?php

/* feedback/projects_select.html */
class __TwigTemplate_039874d662ab733b8abf8b14d6167088d123eb620e0d4f754167a6a5a6863e62 extends Twig_Template
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
        echo "<label for=\"projects_select\">Is this about a project?</label><br>
<select class=\"form-control\" name=\"projects_select\" id=\"projects_select\">
\t<option value=\"\">Please select a project</option>
\t";
        // line 4
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["PROJECTS"]) ? $context["PROJECTS"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["project"]) {
            // line 5
            echo "\t    <option value=\"";
            echo twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "_id");
            echo "\">";
            echo twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "project_title");
            echo "</option>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['project'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "</select>";
    }

    public function getTemplateName()
    {
        return "feedback/projects_select.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 7,  24 => 4,  19 => 1,  56 => 24,  44 => 14,  42 => 13,  31 => 4,  28 => 5,);
    }
}
