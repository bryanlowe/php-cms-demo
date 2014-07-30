<?php

/* feedback/feedback-entry.html */
class __TwigTemplate_4e1c6f183aab026ab24194d3631e71b9920d586e50049a834af960c8ddb5acee extends Twig_Template
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
        if ((isset($context["FEEDBACK_ENTRIES"]) ? $context["FEEDBACK_ENTRIES"] : null)) {
            // line 2
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["FEEDBACK_ENTRIES"]) ? $context["FEEDBACK_ENTRIES"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["feedback"]) {
                // line 3
                echo "\t\t<tr>
\t\t\t<td>
\t\t\t\t<a id=\"feedback_";
                // line 5
                echo twig_template_get_attributes($this, (isset($context["feedback"]) ? $context["feedback"] : null), "_id");
                echo "\" class=\"toggleDesc\">";
                echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["feedback"]) ? $context["feedback"] : null), "projects"), "project_title");
                echo "</a>
\t\t\t\t<div id=\"details_";
                // line 6
                echo twig_template_get_attributes($this, (isset($context["feedback"]) ? $context["feedback"] : null), "_id");
                echo "\" class=\"hide\">";
                echo twig_template_get_attributes($this, (isset($context["feedback"]) ? $context["feedback"] : null), "description");
                echo "</div>
\t\t\t</td>
\t\t\t<td style=\"white-space: nowrap;\">";
                // line 8
                echo twig_template_get_attributes($this, (isset($context["feedback"]) ? $context["feedback"] : null), "date");
                echo "</td>
\t\t\t<td>";
                // line 9
                echo twig_template_get_attributes($this, (isset($context["feedback"]) ? $context["feedback"] : null), "rating");
                echo "</td>
\t\t\t<td>";
                // line 10
                echo twig_template_get_attributes($this, (isset($context["feedback"]) ? $context["feedback"] : null), "words_per_hour");
                echo "</td>
\t\t</tr>\t\t
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['feedback'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 14
            echo "<tr><td colspan=\"4\"><p align=\"center\">There are no recent feedback to show.</p></td></tr>
";
        }
    }

    public function getTemplateName()
    {
        return "feedback/feedback-entry.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 14,  51 => 10,  47 => 9,  43 => 8,  30 => 5,  26 => 3,  21 => 2,  39 => 7,  24 => 4,  19 => 1,  141 => 92,  127 => 80,  125 => 79,  105 => 61,  91 => 49,  89 => 48,  59 => 21,  55 => 19,  53 => 18,  48 => 15,  46 => 14,  36 => 6,  34 => 5,  31 => 4,  28 => 5,);
    }
}
