<?php

/* feedback/projects_select.html */
class __TwigTemplate_b47023e1062fd2fb0d29cbd9270052a97f3e16b8c12808108e1e74a251c6d7d5 extends Twig_Template
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
        echo "<label for=\"projects_select\">Which project are you reviewing?</label><br>
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
        return array (  39 => 7,  24 => 4,  19 => 1,  141 => 92,  127 => 80,  125 => 79,  105 => 61,  91 => 49,  89 => 48,  59 => 21,  55 => 19,  53 => 18,  48 => 15,  46 => 14,  36 => 6,  34 => 5,  31 => 4,  28 => 5,);
    }
}
