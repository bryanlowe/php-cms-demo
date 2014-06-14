<?php

/* invoices/current_projects.html */
class __TwigTemplate_86acf73eade96fb92f2b86e9cd57d5161faf2674fe8b181dd6dd454a604737e1 extends Twig_Template
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
        echo "<label>Project List</label>
<div class=\"panel panel-default\">
\t";
        // line 3
        if ((isset($context["SELECT_PROJECTS"]) ? $context["SELECT_PROJECTS"] : null)) {
            // line 4
            echo "\t\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["SELECT_PROJECTS"]) ? $context["SELECT_PROJECTS"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["project"]) {
                // line 5
                echo "\t\t\t<div class=\"list-group-item\">";
                echo twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "project_title");
                echo " <button class=\"close\" type=\"button\" onclick=\"removeProject('";
                echo twig_template_get_attributes($this, (isset($context["project"]) ? $context["project"] : null), "_id");
                echo "');\">×</button></div>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['project'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 7
            echo "\t";
        } else {
            // line 8
            echo "\t\t<p align=\"center\"><strong>No Projects</strong></p>
\t";
        }
        // line 10
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "invoices/current_projects.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  30 => 5,  25 => 4,  23 => 3,  39 => 7,  43 => 18,  33 => 10,  21 => 2,  41 => 7,  24 => 4,  19 => 1,  78 => 34,  74 => 32,  72 => 31,  63 => 24,  61 => 23,  56 => 20,  54 => 19,  50 => 17,  48 => 10,  44 => 8,  42 => 13,  31 => 4,  28 => 5,);
    }
}
