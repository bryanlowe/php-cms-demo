<?php

/* orders/list-group-item.html */
class __TwigTemplate_85d307eca4e56b1b08a5abde81c6fed7d07134260f76ec111e33ccf2da1280e3 extends Twig_Template
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
        echo "<span id=\"order-entry-";
        echo twig_template_get_attributes($this, (isset($context["order"]) ? $context["order"] : null), "_id");
        echo "\">
\t<div class=\"list-group-item\">
\t\t";
        // line 3
        if ((twig_template_get_attributes($this, (isset($context["order"]) ? $context["order"] : null), "read") == 1)) {
            // line 4
            echo "\t\t<button class=\"close\" type=\"button\" onclick=\"deletePost('";
            echo twig_template_get_attributes($this, (isset($context["order"]) ? $context["order"] : null), "_id");
            echo "');\">×</button>
\t\t";
        } else {
            // line 6
            echo "\t\t<span class=\"badge\">";
            echo twig_template_get_attributes($this, (isset($context["order"]) ? $context["order"] : null), "date");
            echo "</span>
\t\t";
        }
        // line 8
        echo "\t\t<a id=\"order-link-";
        echo twig_template_get_attributes($this, (isset($context["order"]) ? $context["order"] : null), "_id");
        echo "\" href=\"javascript:showOrderDetails('";
        echo twig_template_get_attributes($this, (isset($context["order"]) ? $context["order"] : null), "_id");
        echo "', ";
        echo twig_template_get_attributes($this, (isset($context["order"]) ? $context["order"] : null), "read");
        echo ");\">\t   
\t\t   Order Request: ";
        // line 9
        echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["order"]) ? $context["order"] : null), "clients"), "client_name");
        echo " ";
        echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["order"]) ? $context["order"] : null), "clients"), "company");
        echo "
\t\t</a>
\t\t<div id=\"order-details-";
        // line 11
        echo twig_template_get_attributes($this, (isset($context["order"]) ? $context["order"] : null), "_id");
        echo "\" style=\"display: none;\">
\t\t\t";
        // line 12
        if (twig_template_get_attributes($this, (isset($context["order"]) ? $context["order"] : null), "project_tags")) {
            // line 13
            echo "\t\t\t\t<h3>Project Tags:</h3>
\t\t\t\t<div class=\"list-group input_container\">
\t\t\t\t\t";
            // line 15
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(twig_template_get_attributes($this, (isset($context["order"]) ? $context["order"] : null), "project_tags"));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 16
                echo "\t\t\t\t\t\t<div class=\"list-group-item\">";
                echo (isset($context["tag"]) ? $context["tag"] : null);
                echo "</div>
\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 18
            echo "\t\t\t\t</div>
\t\t\t\t<div class=\"clear\"><hr></div>
\t\t\t";
        }
        // line 21
        echo "\t\t\t<h3>Description:</h3>
\t\t\t<p>";
        // line 22
        echo twig_template_get_attributes($this, (isset($context["order"]) ? $context["order"] : null), "description");
        echo "</p>
\t\t\t<p align=\"right\"><i>-- ";
        // line 23
        echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["order"]) ? $context["order"] : null), "clients"), "client_name");
        echo " ";
        echo twig_template_get_attributes($this, twig_template_get_attributes($this, (isset($context["order"]) ? $context["order"] : null), "clients"), "company");
        echo "</i></p>
\t\t</div>
\t</div>
</span>";
    }

    public function getTemplateName()
    {
        return "orders/list-group-item.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 23,  86 => 22,  83 => 21,  78 => 18,  69 => 16,  65 => 15,  61 => 13,  59 => 12,  55 => 11,  48 => 9,  39 => 8,  33 => 6,  27 => 4,  25 => 3,  19 => 1,);
    }
}
