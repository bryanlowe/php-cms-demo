<?php

/* invoices/projects_select.html */
class __TwigTemplate_fffbea7a4f5f3604af04dd89e49df5fb04796beb71281c6e2c5a24b7c23662ff extends Twig_Template
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
        echo "<label for=\"projects_select\">Select a project to attach to this invoice</label><br>
<select class=\"form-control\" name=\"projects_select\" id=\"projects_select\">
\t<option value=\"\">Please select a project</option>
\t";
        // line 4
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["SELECT_PROJECTS"]) ? $context["SELECT_PROJECTS"] : null));
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
        return "invoices/projects_select.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 7,  43 => 18,  33 => 10,  21 => 2,  41 => 7,  24 => 4,  19 => 1,  78 => 34,  74 => 32,  72 => 31,  63 => 24,  61 => 23,  56 => 20,  54 => 19,  50 => 17,  48 => 16,  44 => 14,  42 => 13,  31 => 4,  28 => 5,);
    }
}
