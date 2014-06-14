<?php

/* projects/tag_select.html */
class __TwigTemplate_60c126e5312b49dfe1b6576ac007103b998e26f25fe904f1092e6e687738063f extends Twig_Template
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
        echo "<label for=\"project_tags\">Project Tags</label><br>
<select class=\"form-control\" name=\"project_tags\" id=\"project_tags\">
\t<option value=\"\">Please select a tag</option>
\t";
        // line 4
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["SELECT_TAGS"]) ? $context["SELECT_TAGS"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 5
            echo "\t    <option value=\"";
            echo (isset($context["tag"]) ? $context["tag"] : null);
            echo "\">";
            echo (isset($context["tag"]) ? $context["tag"] : null);
            echo "</option>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "</select>";
    }

    public function getTemplateName()
    {
        return "projects/tag_select.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 7,  28 => 5,  24 => 4,  19 => 1,);
    }
}
