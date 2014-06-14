<?php

/* projects/project-entry.html */
class __TwigTemplate_a37f53dda2c0cc8ef8aa206f4a55040eaad8c43ab03c04607a80ae666e59b5b8 extends Twig_Template
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
                echo "\" class=\"toggleDesc\">
\t\t\t\t\t";
                // line 6
                echo twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "project_title");
                echo "
\t\t\t\t</a>
\t\t\t\t<div id=\"project_";
                // line 8
                echo twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "_id");
                echo "_desc\" class=\"hide\">
\t\t\t\t\t";
                // line 9
                if (twig_template_get_attributes($this, (isset($context["invoice"]) ? $context["invoice"] : null), "project_tags")) {
                    // line 10
                    echo "\t\t\t\t\t\t<h3>Project Tags:</h3>
\t\t\t\t\t\t<div class=\"list-group\">
\t\t\t\t\t\t\t";
                    // line 12
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable(twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "project_tags"));
                    foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                        // line 13
                        echo "\t\t\t\t\t\t\t\t<div class=\"list-group-item\">";
                        echo (isset($context["tag"]) ? $context["tag"] : null);
                        echo "</div>
\t\t\t\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 15
                    echo "\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t\t\t";
                }
                // line 18
                echo "\t\t\t\t\t<h3>Description:</h3>
\t\t\t\t\t<p>";
                // line 19
                echo twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "project_description");
                echo "</p>
\t\t\t\t</div>
\t\t\t</td>
\t\t\t<td>";
                // line 22
                echo twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "project_status");
                echo "</td>
\t\t\t<td>";
                // line 23
                echo twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "project_date");
                echo "</td>
\t\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['project'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 27
            echo "<tr><td colspan=\"3\"><p align=\"center\">There are no active projects to show.</p></td></tr>
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
        return array (  90 => 27,  80 => 23,  76 => 22,  70 => 19,  67 => 18,  62 => 15,  49 => 12,  45 => 10,  43 => 9,  39 => 8,  34 => 6,  30 => 5,  26 => 3,  21 => 2,  19 => 1,  53 => 13,  51 => 22,  31 => 4,  28 => 3,);
    }
}
