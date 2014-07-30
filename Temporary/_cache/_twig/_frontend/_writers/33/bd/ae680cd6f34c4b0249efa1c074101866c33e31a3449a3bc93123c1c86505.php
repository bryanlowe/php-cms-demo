<?php

/* projects/writer-list.html */
class __TwigTemplate_33bdae680cd6f34c4b0249efa1c074101866c33e31a3449a3bc93123c1c86505 extends Twig_Template
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
        if ((isset($context["WRITER_LIST_EXISTS"]) ? $context["WRITER_LIST_EXISTS"] : null)) {
            // line 2
            echo "\t<h2>Writer List</h2>
\t";
            // line 3
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["WRITER_LIST"]) ? $context["WRITER_LIST"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["writer"]) {
                // line 4
                echo "\t    <div class=\"list-group-item\">";
                echo twig_template_get_attributes($this, (isset($context["writer"]) ? $context["writer"] : null), "writer_name");
                echo " <button class=\"close\" type=\"button\" onclick=\"removeWriter('";
                echo twig_template_get_attributes($this, (isset($context["writer"]) ? $context["writer"] : null), "_id");
                echo "');\">×</button></div>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['writer'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 7
            echo "\t<div id=\"writer-list\" class=\"list-group\">
\t\t<p align=\"center\">No current writers assigned to this project.</p>
\t</div>
";
        }
    }

    public function getTemplateName()
    {
        return "projects/writer-list.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 7,  24 => 3,  40 => 7,  34 => 6,  30 => 5,  26 => 3,  21 => 2,  19 => 1,  200 => 149,  198 => 148,  105 => 57,  99 => 53,  97 => 52,  88 => 45,  86 => 44,  80 => 40,  78 => 39,  73 => 36,  69 => 34,  65 => 32,  63 => 31,  52 => 22,  50 => 13,  31 => 4,  28 => 4,);
    }
}
