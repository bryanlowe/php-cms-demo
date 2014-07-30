<?php

/* projects/project-hours.html */
class __TwigTemplate_0575bb10a9a6397a2cc16925114be50841de8c7fa2ff362b81a7514d172131ef extends Twig_Template
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
        if ((isset($context["HOUR_LIST_EXISTS"]) ? $context["HOUR_LIST_EXISTS"] : null)) {
            // line 2
            echo "\t<h2>Hour Entries</h2>
\t";
            // line 3
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["HOUR_LIST"]) ? $context["HOUR_LIST"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["project"]) {
                // line 4
                echo "\t    <div class=\"list-group-item\">
\t    \t";
                // line 5
                if ((!twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "work_hours", array(), "any", false, true), "invoice_id", array(), "any", true, true))) {
                    // line 6
                    echo "\t    \t\t<button class=\"close\" type=\"button\" onclick=\"removeHourEntry('";
                    echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "work_hours"), "work_id");
                    echo "');\">×</button>
\t    \t";
                }
                // line 8
                echo "\t    \tDescription: ";
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "work_hours"), "description");
                echo "<br /> 
\t    \tDate: ";
                // line 9
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "work_hours"), "date");
                echo "<br />
\t    \tDuration: ";
                // line 10
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "work_hours"), "hours");
                echo " hours
\t    </div>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['project'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 14
            echo "\t<div id=\"hour-list\" class=\"list-group\">
\t\t<p align=\"center\">Please click a project title to display your hours.</p>
\t</div>
";
        }
    }

    public function getTemplateName()
    {
        return "projects/project-hours.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 14,  48 => 10,  44 => 9,  39 => 8,  33 => 6,  31 => 5,  28 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }
}
