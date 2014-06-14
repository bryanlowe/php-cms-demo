<?php

/* projects/current_tags.html */
class __TwigTemplate_a3782f01c049b36b40b4f26f5b27d52afcbfced7812b9c83330e5f21c6949994 extends Twig_Template
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
        if ((isset($context["SELECT_TAGS"]) ? $context["SELECT_TAGS"] : null)) {
            // line 2
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["SELECT_TAGS"]) ? $context["SELECT_TAGS"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 3
                echo "\t\t<div class=\"list-group-item\">";
                echo (isset($context["tag"]) ? $context["tag"] : null);
                echo " <button class=\"close\" type=\"button\" onclick=\"removeProjectTag('";
                echo (isset($context["tag"]) ? $context["tag"] : null);
                echo "');\">×</button></div>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 6
            echo "\t<p align=\"center\"><strong>Currently No Tags Assigned</strong></p>
";
        }
    }

    public function getTemplateName()
    {
        return "projects/current_tags.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 6,  26 => 3,  21 => 2,  41 => 7,  24 => 4,  19 => 1,  63 => 24,  61 => 23,  54 => 19,  50 => 17,  48 => 16,  44 => 14,  42 => 13,  31 => 4,  28 => 5,);
    }
}
