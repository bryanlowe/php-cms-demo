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
        echo "<h3>Client List</h3>
";
        // line 2
        if ((twig_length_filter($this->env, (isset($context["NONUSER_CLIENTS"]) ? $context["NONUSER_CLIENTS"] : null)) > 0)) {
            // line 3
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["NONUSER_CLIENTS"]) ? $context["NONUSER_CLIENTS"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["client"]) {
                // line 4
                echo "\t<span>
\t\t<a class=\"list-group-item\" href=\"javascript:clientToUserForm('";
                // line 5
                echo twig_template_get_attributes($this, (isset($context["client"]) ? $context["client"] : null), "_id");
                echo "');\">
\t\t   ";
                // line 6
                echo twig_template_get_attributes($this, (isset($context["client"]) ? $context["client"] : null), "client_name");
                echo " -- ";
                echo twig_template_get_attributes($this, (isset($context["client"]) ? $context["client"] : null), "company");
                echo "
\t\t</a>
\t</span>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['client'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 11
            echo "\t<h2 class=\"no-entries\" align=\"center\">No new clients</h2>
";
        }
        // line 13
        echo "<hr>
<h3>Writer List</h3>
";
        // line 15
        if ((twig_length_filter($this->env, (isset($context["NONUSER_WRITERS"]) ? $context["NONUSER_WRITERS"] : null)) > 0)) {
            // line 16
            echo "\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["NONUSER_WRITERS"]) ? $context["NONUSER_WRITERS"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["writer"]) {
                // line 17
                echo "\t<span>
\t\t<a class=\"list-group-item\" href=\"javascript:writerToUserForm('";
                // line 18
                echo twig_template_get_attributes($this, (isset($context["writer"]) ? $context["writer"] : null), "_id");
                echo "');\">
\t\t   ";
                // line 19
                echo twig_template_get_attributes($this, (isset($context["writer"]) ? $context["writer"] : null), "writer_name");
                echo "
\t\t</a>
\t</span>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['writer'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 24
            echo "\t<h2 class=\"no-entries\" align=\"center\">No new writers</h2>
";
        }
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
        return array (  82 => 24,  71 => 19,  67 => 18,  64 => 17,  59 => 16,  57 => 15,  53 => 13,  49 => 11,  36 => 6,  32 => 5,  29 => 4,  24 => 3,  22 => 2,  19 => 1,);
    }
}
