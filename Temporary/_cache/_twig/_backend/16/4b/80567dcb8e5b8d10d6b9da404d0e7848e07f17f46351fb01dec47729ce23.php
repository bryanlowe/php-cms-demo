<?php

/* users/list-group-item.html */
class __TwigTemplate_164b80567dcb8e5b8d10d6b9da404d0e7848e07f17f46351fb01dec47729ce23 extends Twig_Template
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
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["NONUSER_CLIENTS"]) ? $context["NONUSER_CLIENTS"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["client"]) {
            // line 2
            echo "<span>
\t<a class=\"list-group-item\" href=\"javascript:clientToUserForm('";
            // line 3
            echo twig_template_get_attributes($this, (isset($context["client"]) ? $context["client"] : null), "_id");
            echo "');\">
\t   ";
            // line 4
            echo twig_template_get_attributes($this, (isset($context["client"]) ? $context["client"] : null), "client_name");
            echo " -- ";
            echo twig_template_get_attributes($this, (isset($context["client"]) ? $context["client"] : null), "company");
            echo "
\t</a>
</span>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['client'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "users/list-group-item.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  30 => 4,  26 => 3,  23 => 2,  19 => 1,  85 => 43,  81 => 41,  78 => 40,  75 => 39,  73 => 38,  48 => 16,  44 => 14,  42 => 13,  31 => 4,  28 => 3,);
    }
}
