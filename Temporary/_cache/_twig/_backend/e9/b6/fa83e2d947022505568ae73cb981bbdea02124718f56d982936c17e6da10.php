<?php

/* writers/list-group-item.html */
class __TwigTemplate_e9b6fa83e2d947022505568ae73cb981bbdea02124718f56d982936c17e6da10 extends Twig_Template
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
        if ((isset($context["OPT_INS"]) ? $context["OPT_INS"] : null)) {
            // line 2
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["OPT_INS"]) ? $context["OPT_INS"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["opt_in"]) {
                // line 3
                echo "\t    <div class=\"list-group-item\">";
                echo twig_template_get_attributes($this, (isset($context["opt_in"]) ? $context["opt_in"] : null), "title");
                echo " <button class=\"close\" type=\"button\" onclick=\"removeOptIn('";
                echo twig_template_get_attributes($this, (isset($context["opt_in"]) ? $context["opt_in"] : null), "_id");
                echo "');\">×</button></div>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['opt_in'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 6
            echo "\t<p align=\"center\">No Current Opt Ins</p>
";
        }
    }

    public function getTemplateName()
    {
        return "writers/list-group-item.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 6,  26 => 3,  21 => 2,  19 => 1,);
    }
}
