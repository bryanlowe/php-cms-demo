<?php

/* opt-in/list-group-item.html */
class __TwigTemplate_7b6365b4cfe8c7c2d40deae77f07396192c2747038736ba506c0a2512011eae0 extends Twig_Template
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
        if ((isset($context["WRITERS"]) ? $context["WRITERS"] : null)) {
            // line 2
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["WRITERS"]) ? $context["WRITERS"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["writer"]) {
                // line 3
                echo "\t    <div class=\"list-group-item\">";
                echo twig_template_get_attributes($this, (isset($context["writer"]) ? $context["writer"] : null), "writer_name");
                echo "</div>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['writer'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 6
            echo "\t<p align=\"center\">No writers in this opt-in</p>
";
        }
    }

    public function getTemplateName()
    {
        return "opt-in/list-group-item.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  36 => 6,  26 => 3,  21 => 2,  19 => 1,);
    }
}
