<?php

/* projects/projects_select.html */
class __TwigTemplate_ca7bbce6d5e6a4ff71996849e41d7451cc0d72e2e66794b4460531084192a52e extends Twig_Template
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
        echo "<label for=\"projects_select\">Select a project to edit</label><br>
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
            echo "\">Company: ";
            echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "clients"), "company");
            echo " -- Project Tag: ";
            echo twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "project_tag");
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
        return "projects/projects_select.html";
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
