<?php

/* projects/project-entry.html */
class __TwigTemplate_a11dee6c595e08caec141916e58b99a579de0e3fd0c73556e09f3c8fc99c1b92 extends Twig_Template
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
        if ((isset($context["PROJECT_ENTRIES"]) ? $context["PROJECT_ENTRIES"] : null)) {
            // line 2
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["PROJECT_ENTRIES"]) ? $context["PROJECT_ENTRIES"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["project"]) {
                // line 3
                echo "\t\t<tr>
\t\t\t<td>
\t\t\t\t<a id=\"project_";
                // line 5
                echo twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "_id");
                echo "\" class=\"project_link\">
\t\t\t\t\t";
                // line 6
                echo twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "project_title");
                echo "
\t\t\t\t</a>
\t\t\t\t";
                // line 8
                if ((twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "solve_link", array(), "any", true, true) && (twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "solve_link") != ""))) {
                    // line 9
                    echo "\t\t\t\t\t<br /><a href=\"";
                    echo twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "solve_link");
                    echo "\" target=\"_blank\">Solve Link</a>
\t\t\t\t";
                }
                // line 11
                echo "\t\t\t</td>
\t\t\t<td>";
                // line 12
                echo twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "project_date");
                echo "</td>
\t\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['project'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 16
            echo "<tr><td colspan=\"2\"><p align=\"center\">There are no active projects to show.</p></td></tr>
";
        }
    }

    public function getTemplateName()
    {
        return "projects/project-entry.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 16,  50 => 12,  47 => 11,  41 => 9,  39 => 8,  34 => 6,  30 => 5,  26 => 3,  21 => 2,  19 => 1,);
    }
}
